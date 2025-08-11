<?php
require_once __DIR__ . '/../services/EmployeeService.php';
require_once __DIR__ . '/../repositories/EmployeeRepository.php';

class Employee extends Controller
{
    private EmployeeService $service;

    public function __construct()
    {
        $repo = new EmployeeRepository();
        $this->service = new EmployeeService($repo);
    }

    public function index()
    {
        $employees = $this->service->getAllEmployees();
        $this->view('pages/emplist', ['employees' => $employees]);
    }

    public function checkEmailAjax()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'] ?? '';
        $excludeId = $input['excludeId'] ?? null;

        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email is required']);
            exit;
        }

        try {
            $exists = $this->service->checkEmailExists($email, $excludeId);
            echo json_encode(['success' => true, 'exists' => $exists]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function getEmployeesAjax()
    {
        header('Content-Type: application/json');

        try {
            $employees = $this->service->getAllEmployees();
            echo json_encode([
                'success' => true,
                'data' => $employees,
                'count' => count($employees)
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function deleteAjax()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required']);
            exit;
        }

        try {
            $result = $this->service->deleteEmployee($id);
            echo json_encode($result
                ? ['success' => true, 'message' => 'Employee deleted successfully']
                : ['success' => false, 'message' => 'Failed to delete employee']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function getEmployeeAjax($id = null)
    {
        header('Content-Type: application/json');

        if (!$id) {
            $input = json_decode(file_get_contents('php://input'), true);
            $id = $input['id'] ?? null;
        }

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required']);
            exit;
        }

        try {
            $employee = $this->service->getEmployeeById($id);
            echo json_encode($employee
                ? ['success' => true, 'data' => $employee]
                : ['success' => false, 'message' => 'Employee not found']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function editAjax()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required']);
            exit;
        }

        $data = [
            'name' => trim($input['name'] ?? ''),
            'email' => $input['email'] ?? '',
            'phone' => $input['phone'] ?? '',
            'address' => trim($input['address'] ?? ''),
            'role' => $input['role'] ?? ''
        ];

        try {
            $updated = $this->service->updateEmployee($id, $data);
            echo json_encode($updated
                ? ['success' => true, 'message' => 'Employee updated successfully!', 'data' => $data]
                : ['success' => false, 'message' => 'Failed to update employee.']);
        } catch (InvalidArgumentException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit;
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'role' => $_POST['role'] ?? ''
            ];

            try {
                $created = $this->service->createEmployee($data);

                if ($created) {
                    setMessage('success', 'Employee added successfully!');
                    redirect('pages/employee');
                } else {
                    setMessage('error', 'Failed to add employee.');
                    redirect('pages/employee');
                }
            } catch (InvalidArgumentException $e) {
                $this->view('employee/add', ['error' => $e->getMessage()]);
                return;
            } catch (Exception $e) {
                $this->view('employee/add', ['error' => 'Database error: ' . $e->getMessage()]);
                return;
            }
        }

        $this->view('employee/add');
    }
}
