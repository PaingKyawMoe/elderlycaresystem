<?php
require_once __DIR__ . '/../models/EmployeeModel.php';


class Employee extends Controller
{
    private $db;
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }
    // Original index method (keep for non-AJAX requests)
    public function index()
    {
        $employees = $this->employeeModel->getAllEmployees();
        $data = [
            'employees' => $employees
        ];
        $this->view('pages/emplist', $data);
    }

    // NEW: AJAX endpoint to get employees
    public function getEmployeesAjax()
    {
        // Set JSON header
        header('Content-Type: application/json');

        try {
            $employees = $this->employeeModel->getAllEmployees();

            if ($employees !== false) {
                echo json_encode([
                    'success' => true,
                    'data' => $employees,
                    'count' => count($employees)
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to fetch employees from database'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
        exit;
    }

    // NEW: AJAX endpoint to delete employee
    public function deleteAjax()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'success' => false,
                'message' => 'Employee ID is required'
            ]);
            exit;
        }

        try {
            $result = $this->employeeModel->deleteEmployee($id);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Employee deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to delete employee'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
        exit;
    }

    // Keep your existing methods...
    public function editAjax($id = null)
    {
        header('Content-Type: application/json');

        if ($_POST && isset($_POST['id'])) {
            $id = $_POST['id'];


            $data = [
                'name' => trim($_POST['name']),
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => trim($_POST['address']),
                'role' => $_POST['role'],
            ];


            $result = $this->db->update('employees', $id, $data);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Appointment updated successfully!',
                    'data' => $data
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update appointment.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
        exit;
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Data from form
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'role' => $_POST['role'] ?? '',  // doctor, caregiver, driver, staff
            ];

            // Assign data to model attributes
            foreach ($data as $key => $value) {
                $this->employeeModel->__set($key, $value);
            }
            // print_r($this->employeeModel);
            // die();

            $result = $this->employeeModel->save();

            if ($result) {
                setMessage('success', 'Employee added successfully!');
                redirect('pages/employee');
            } else {
                setMessage('error', 'Failed to add employee.');
                redirect('pages/employee');
            }
        }
        $this->view('employee/add');
    }
}
