<?php

require_once 'Database.php';

class EmployeeModel
{
    private $db;
    private $table = 'employees';

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Add new employee
     */
    public function addEmployee($data)
    {
        // Validate required fields
        $requiredFields = ['name', 'email', 'phone', 'address', 'staff_type'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Field {$field} is required");
            }
        }

        // Validate staff type
        $validStaffTypes = ['doctor', 'caregiver', 'driver', 'cleaner'];
        if (!in_array(strtolower($data['staff_type']), $validStaffTypes)) {
            throw new Exception("Invalid staff type");
        }

        // Check if email already exists
        if ($this->emailExists($data['email'])) {
            throw new Exception("Email already exists");
        }

        // Prepare data for insertion
        $employeeData = [
            'name' => $this->sanitizeInput($data['name']),
            'email' => $this->sanitizeInput($data['email']),
            'phone' => $this->sanitizeInput($data['phone']),
            'address' => $this->sanitizeInput($data['address']),
            'staff_type' => strtolower($this->sanitizeInput($data['staff_type'])),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->create($this->table, $employeeData);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Employee added successfully',
                'employee_id' => $result
            ];
        } else {
            throw new Exception("Failed to add employee");
        }
    }

    /**
     * Get all employees
     */
    public function getAllEmployees()
    {
        return $this->db->readAll($this->table);
    }

    /**
     * Get employee by ID
     */
    public function getEmployeeById($id)
    {
        return $this->db->getById($this->table, $id);
    }

    /**
     * Get employees by staff type
     */
    public function getEmployeesByType($staffType)
    {
        return $this->db->columnFilter($this->table, 'staff_type', strtolower($staffType));
    }

    /**
     * Update employee
     */
    public function updateEmployee($id, $data)
    {
        // Remove empty fields
        $data = array_filter($data, function ($value) {
            return $value !== '' && $value !== null;
        });

        if (empty($data)) {
            throw new Exception("No data to update");
        }

        // Add updated timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Sanitize data
        foreach ($data as $key => $value) {
            $data[$key] = $this->sanitizeInput($value);
        }

        $result = $this->db->update($this->table, $id, $data);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Employee updated successfully'
            ];
        } else {
            throw new Exception("Failed to update employee");
        }
    }

    /**
     * Delete employee
     */
    public function deleteEmployee($id)
    {
        $result = $this->db->delete($this->table, $id);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Employee deleted successfully'
            ];
        } else {
            throw new Exception("Failed to delete employee");
        }
    }

    /**
     * Check if email exists
     */
    private function emailExists($email)
    {
        $result = $this->db->getByEmail($this->table, $email);
        return !empty($result);
    }

    /**
     * Sanitize input data
     */
    private function sanitizeInput($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    /**
     * Get staff types
     */
    public function getStaffTypes()
    {
        return [
            'doctor' => 'Doctor',
            'caregiver' => 'Caregiver',
            'driver' => 'Driver',
            'cleaner' => 'Cleaner'
        ];
    }

    /**
     * Validate phone number
     */
    public function validatePhone($phone)
    {
        // Basic phone validation - adjust regex based on your requirements
        return preg_match('/^[\+]?[1-9][\d]{0,15}$/', $phone);
    }

    /**
     * Validate email
     */
    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
