<?php

class EmployeeController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('EmployeeModel');
        $this->db = new Database();
    }

    // Show the employee list view
    public function index()
    {
        // Usually, you'd load the view and pass data if needed
        $this->view('pages/employee');
    }

    // AJAX: Get all employees as JSON
    public function getAll()
    {
        header('Content-Type: application/json');

        try {
            $employeeModel = $this->model('EmployeeModel');
            $employees = $employeeModel->getAll();

            echo json_encode([
                'success' => true,
                'data' => $employees,
                'count' => count($employees)
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch employees: ' . $e->getMessage()
            ]);
        }

        exit;
    }

    // AJAX: Create new employee
    public function store()
    {
        if (ob_get_level()) {
            ob_clean();
        }


        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        // Validate required fields
        $requiredFields = ['name', 'email', 'phone', 'address', 'employee_type'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field] ?? ''))) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing required fields: ' . implode(', ', $missingFields)
            ]);
            exit;
        }

        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'phone' => trim($_POST['phone']),
            'address' => trim($_POST['address']),
            'employee_type' => trim($_POST['employee_type']),
        ];

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email format'
            ]);
            exit;
        }

        try {
            $employeeModel = $this->model('EmployeeModel');
            $id = $employeeModel->create($data);

            echo json_encode([
                'success' => true,
                'message' => 'Employee created successfully',
                'id' => $id
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }

    // AJAX: Get employee by ID
    public function getById()
    {
        header('Content-Type: application/json');

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required']);
            exit;
        }

        try {
            $employeeModel = $this->model('EmployeeModel');
            $employee = $employeeModel->getById($id);

            echo json_encode([
                'success' => true,
                'data' => $employee
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }

    // AJAX: Update employee by ID
    public function update()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required for update']);
            exit;
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'employee_type' => trim($_POST['employee_type'] ?? ''),
        ];

        try {
            $employeeModel = $this->model('EmployeeModel');
            $employeeModel->update($id, $data);

            echo json_encode([
                'success' => true,
                'message' => 'Employee updated successfully'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }

    // AJAX: Delete employee by ID
    public function delete()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required for deletion']);
            exit;
        }

        try {
            $employeeModel = $this->model('EmployeeModel');
            $employeeModel->delete($id);

            echo json_encode([
                'success' => true,
                'message' => 'Employee deleted successfully'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }

    // AJAX: Get employees by type
    public function getByType()
    {
        header('Content-Type: application/json');

        $type = $_GET['employee_type'] ?? null;

        if (!$type) {
            echo json_encode(['success' => false, 'message' => 'Employee type is required']);
            exit;
        }

        try {
            $employeeModel = $this->model('EmployeeModel');
            $employees = $employeeModel->getByType($type);

            echo json_encode([
                'success' => true,
                'data' => $employees,
                'count' => count($employees)
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }
}
