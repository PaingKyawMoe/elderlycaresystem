<?php

class Employees extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('EmployeeModel');
        $this->db = new Database();
    }

    public function index()
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->getAllEmployees();
        $stats = $employeeModel->getEmployeeStats();

        $this->view('employees/index', [
            'employees' => $employees,
            'stats' => $stats
        ]);
    }

    public function add()
    {
        $employeeModel = new EmployeeModel();
        $departments = $employeeModel->getAllDepartments();
        $roles = $this->getAvailableRoles();

        $this->view('employees/add', [
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first_name = $_POST['first_name'] ?? '';
            $last_name = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $role = $_POST['role'] ?? '';
            $department_id = $_POST['department_id'] ?? '';
            $hire_date = $_POST['hire_date'] ?? date('Y-m-d');
            $salary = $_POST['salary'] ?? 0;
            $emergency_contact = $_POST['emergency_contact'] ?? '';
            $emergency_phone = $_POST['emergency_phone'] ?? '';
            $qualifications = $_POST['qualifications'] ?? '';
            $notes = $_POST['notes'] ?? '';
            $status = $_POST['status'] ?? 'active';

            // Validate required fields
            $required = ['first_name', 'last_name', 'email', 'phone', 'role', 'department_id'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    setMessage('error', ucfirst(str_replace('_', ' ', $field)) . ' is required');
                    redirect('employees/add');
                    return;
                }
            }

            // Check if email already exists
            $existingEmployee = $this->db->getByEmail('employees', $email);
            if ($existingEmployee) {
                setMessage('error', 'Email already exists');
                redirect('employees/add');
                return;
            }

            $employee = new EmployeeModel();
            $employee->setEmployeeId($employee->generateEmployeeId());
            $employee->setFirstName(trim($first_name));
            $employee->setLastName(trim($last_name));
            $employee->setEmail(trim(strtolower($email)));
            $employee->setPhone(trim($phone));
            $employee->setAddress($address);
            $employee->setRole($role);
            $employee->setDepartmentId($department_id);
            $employee->setHireDate($hire_date);
            $employee->setSalary($salary);
            $employee->setEmergencyContact($emergency_contact);
            $employee->setEmergencyPhone($emergency_phone);
            $employee->setQualifications($qualifications);
            $employee->setNotes($notes);
            $employee->setStatus($status);

            $data = $employee->toArray();

            $saved = $this->db->create('employees', $data);

            if ($saved) {
                setMessage('success', 'Employee added successfully');
                redirect('employees/index');
            } else {
                setMessage('error', 'Failed to add employee');
                redirect('employees/add');
            }
        } else {
            redirect('employees/add');
        }
    }

    public function show($id)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->getEmployeeById($id);

        if (!$employee) {
            setMessage('error', 'Employee not found');
            redirect('employees/index');
            return;
        }

        $this->view('employees/show', ['employee' => $employee]);
    }

    public function edit($id)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->getEmployeeById($id);

        if (!$employee) {
            setMessage('error', 'Employee not found');
            redirect('employees/index');
            return;
        }

        $departments = $employeeModel->getAllDepartments();
        $roles = $this->getAvailableRoles();

        $this->view('employees/edit', [
            'employee' => $employee,
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employeeModel = new EmployeeModel();
            $existingEmployee = $employeeModel->getEmployeeById($id);

            if (!$existingEmployee) {
                setMessage('error', 'Employee not found');
                redirect('employees/index');
                return;
            }

            // Remove sensitive fields that shouldn't be updated
            unset($_POST['employee_id'], $_POST['created_at']);
            $_POST['updated_at'] = date('Y-m-d H:i:s');

            $result = $this->db->update('employees', $id, $_POST);

            if ($result) {
                setMessage('success', 'Employee updated successfully');
            } else {
                setMessage('error', 'Failed to update employee');
            }

            redirect('employees/show/' . $id);
        } else {
            redirect('employees/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->getEmployeeById($id);

        if (!$employee) {
            setMessage('error', 'Employee not found');
            redirect('employees/index');
            return;
        }

        // Soft delete - set status to inactive
        $updateData = [
            'status' => 'inactive',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->update('employees', $id, $updateData);

        if ($result) {
            setMessage('success', 'Employee deactivated successfully');
        } else {
            setMessage('error', 'Failed to deactivate employee');
        }

        redirect('employees/index');
    }

    public function search()
    {
        $searchTerm = $_GET['search'] ?? '';
        $employees = [];

        if (!empty($searchTerm)) {
            $employeeModel = new EmployeeModel();
            $employees = $employeeModel->searchEmployees($searchTerm);
        }

        $this->view('employees/search', [
            'employees' => $employees,
            'searchTerm' => $searchTerm
        ]);
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            $employeeId = $input['employee_id'];
            $status = $input['status'];

            $allowedStatuses = ['active', 'inactive', 'on_leave', 'terminated'];
            if (!in_array($status, $allowedStatuses)) {
                echo json_encode(['success' => false, 'message' => 'Invalid status']);
                return;
            }

            $employeeModel = new EmployeeModel();
            $result = $employeeModel->updateStatus($employeeId, $status);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database update failed']);
            }
        }
    }

    public function getByDepartment()
    {
        if (!isset($_GET['department_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Department ID required']);
            exit;
        }

        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->getEmployeesByDepartment($_GET['department_id']);

        header('Content-Type: application/json');
        echo json_encode($employees);
        exit;
    }

    public function getByRole()
    {
        if (!isset($_GET['role'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Role required']);
            exit;
        }

        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->getEmployeesByRole($_GET['role']);

        header('Content-Type: application/json');
        echo json_encode($employees);
        exit;
    }

    private function getAvailableRoles()
    {
        return [
            'doctor' => 'Doctor',
            'nurse' => 'Nurse',
            'caregiver' => 'Caregiver',
            'physiotherapist' => 'Physiotherapist',
            'occupational_therapist' => 'Occupational Therapist',
            'social_worker' => 'Social Worker',
            'nutritionist' => 'Nutritionist',
            'administrator' => 'Administrator',
            'receptionist' => 'Receptionist',
            'maintenance' => 'Maintenance Staff',
            'security' => 'Security',
            'housekeeper' => 'Housekeeper',
            'driver' => 'Driver',
            'volunteer_coordinator' => 'Volunteer Coordinator',
            'activities_coordinator' => 'Activities Coordinator'
        ];
    }
}
