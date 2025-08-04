<?php

require_once 'EmployeeModel.php';

class EmployeeController
{
    private $model;
    private $response;

    public function __construct()
    {
        $this->model = new EmployeeModel();
        $this->response = [
            'success' => false,
            'message' => '',
            'data' => []
        ];
    }

    /**
     * Handle employee creation
     */
    public function create()
    {
        try {
            // Check if request is POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Invalid request method");
            }

            // Get POST data
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'staff_type' => $_POST['staff_type'] ?? ''
            ];

            // Validate email format
            if (!$this->model->validateEmail($data['email'])) {
                throw new Exception("Invalid email format");
            }

            // Validate phone format
            if (!$this->model->validatePhone($data['phone'])) {
                throw new Exception("Invalid phone number format");
            }

            // Add employee
            $result = $this->model->addEmployee($data);

            $this->response = [
                'success' => true,
                'message' => $result['message'],
                'data' => ['employee_id' => $result['employee_id']]
            ];

            // Redirect on success
            $this->redirect('add_employee.php?success=1');
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];

            // Store error in session for display
            session_start();
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['form_data'] = $_POST;

            $this->redirect('add_employee.php?error=1');
        }
    }

    /**
     * Handle employee listing
     */
    public function index()
    {
        try {
            $employees = $this->model->getAllEmployees();

            $this->response = [
                'success' => true,
                'message' => 'Employees retrieved successfully',
                'data' => $employees
            ];
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->response;
    }

    /**
     * Handle employee update
     */
    public function update($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Invalid request method");
            }

            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'staff_type' => $_POST['staff_type'] ?? ''
            ];

            // Remove empty values
            $data = array_filter($data, function ($value) {
                return $value !== '';
            });

            if (!empty($data['email']) && !$this->model->validateEmail($data['email'])) {
                throw new Exception("Invalid email format");
            }

            if (!empty($data['phone']) && !$this->model->validatePhone($data['phone'])) {
                throw new Exception("Invalid phone number format");
            }

            $result = $this->model->updateEmployee($id, $data);

            $this->response = [
                'success' => true,
                'message' => $result['message'],
                'data' => []
            ];
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->response;
    }

    /**
     * Handle employee deletion
     */
    public function delete($id)
    {
        try {
            $result = $this->model->deleteEmployee($id);

            $this->response = [
                'success' => true,
                'message' => $result['message'],
                'data' => []
            ];
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->response;
    }

    /**
     * Get employee by ID
     */
    public function show($id)
    {
        try {
            $employee = $this->model->getEmployeeById($id);

            if (empty($employee)) {
                throw new Exception("Employee not found");
            }

            $this->response = [
                'success' => true,
                'message' => 'Employee retrieved successfully',
                'data' => $employee
            ];
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->response;
    }

    /**
     * Get employees by staff type
     */
    public function getByType($staffType)
    {
        try {
            $employees = $this->model->getEmployeesByType($staffType);

            $this->response = [
                'success' => true,
                'message' => 'Employees retrieved successfully',
                'data' => $employees
            ];
        } catch (Exception $e) {
            $this->response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->response;
    }

    /**
     * Handle AJAX requests
     */
    public function handleAjax()
    {
        header('Content-Type: application/json');

        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? 0;

        switch ($action) {
            case 'create':
                $this->create();
                break;

            case 'update':
                $result = $this->update($id);
                echo json_encode($result);
                break;

            case 'delete':
                $result = $this->delete($id);
                echo json_encode($result);
                break;

            case 'show':
                $result = $this->show($id);
                echo json_encode($result);
                break;

            case 'list':
                $result = $this->index();
                echo json_encode($result);
                break;

            case 'by-type':
                $staffType = $_GET['staff_type'] ?? '';
                $result = $this->getByType($staffType);
                echo json_encode($result);
                break;

            default:
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid action',
                    'data' => []
                ]);
        }

        exit;
    }

    /**
     * Get staff types for form
     */
    public function getStaffTypes()
    {
        return $this->model->getStaffTypes();
    }

    /**
     * Redirect helper
     */
    private function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    /**
     * Get response
     */
    public function getResponse()
    {
        return $this->response;
    }
}

// Handle direct AJAX requests
if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    $controller = new EmployeeController();
    $controller->handleAjax();
}
