<?php

class EmployeeModel
{
    private $db;
    private $id;
    private $employee_id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $address;
    private $role;
    private $department_id;
    private $hire_date;
    private $salary;
    private $emergency_contact;
    private $emergency_phone;
    private $qualifications;
    private $notes;
    private $status;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmployeeId($employee_id)
    {
        $this->employee_id = $employee_id;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    public function setHireDate($hire_date)
    {
        $this->hire_date = $hire_date;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function setEmergencyContact($emergency_contact)
    {
        $this->emergency_contact = $emergency_contact;
    }

    public function setEmergencyPhone($emergency_phone)
    {
        $this->emergency_phone = $emergency_phone;
    }

    public function setQualifications($qualifications)
    {
        $this->qualifications = $qualifications;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getDepartmentId()
    {
        return $this->department_id;
    }

    public function getHireDate()
    {
        return $this->hire_date;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getEmergencyContact()
    {
        return $this->emergency_contact;
    }

    public function getEmergencyPhone()
    {
        return $this->emergency_phone;
    }

    public function getQualifications()
    {
        return $this->qualifications;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Database operations
    public function getAllEmployees()
    {
        $this->db->query("
            SELECT e.*, d.department_name 
            FROM employees e 
            LEFT JOIN departments d ON e.department_id = d.id 
            ORDER BY e.created_at DESC
        ");
        return $this->db->resultSet();
    }

    public function getEmployeeById($id)
    {
        return $this->db->getById('employees', $id);
    }

    public function getEmployeesByDepartment($departmentId)
    {
        return $this->db->columnFilter('employees', 'department_id', $departmentId);
    }

    public function getEmployeesByRole($role)
    {
        return $this->db->columnFilter('employees', 'role', $role);
    }

    public function getAllDepartments()
    {
        return $this->db->readAll('departments');
    }

    public function searchEmployees($searchTerm)
    {
        $this->db->query("
            SELECT e.*, d.department_name 
            FROM employees e 
            LEFT JOIN departments d ON e.department_id = d.id 
            WHERE e.first_name LIKE :search 
            OR e.last_name LIKE :search 
            OR e.email LIKE :search 
            OR e.employee_id LIKE :search 
            OR d.department_name LIKE :search
            ORDER BY e.first_name, e.last_name
        ");
        $this->db->bind(':search', '%' . $searchTerm . '%');
        return $this->db->resultSet();
    }

    public function getEmployeeStats()
    {
        $stats = [];

        // Total employees
        $this->db->query("SELECT COUNT(*) as total FROM employees WHERE status = 'active'");
        $stats['total'] = $this->db->single()['total'];

        // By department
        $this->db->query("
            SELECT d.department_name, COUNT(e.id) as count 
            FROM departments d 
            LEFT JOIN employees e ON d.id = e.department_id AND e.status = 'active'
            GROUP BY d.id, d.department_name
        ");
        $stats['by_department'] = $this->db->resultSet();

        // By role
        $this->db->query("
            SELECT role, COUNT(*) as count 
            FROM employees 
            WHERE status = 'active' 
            GROUP BY role
        ");
        $stats['by_role'] = $this->db->resultSet();

        return $stats;
    }

    public function generateEmployeeId()
    {
        $prefix = 'EMP';
        $year = date('Y');

        // Get the last employee ID for current year
        $this->db->query("SELECT employee_id FROM employees WHERE employee_id LIKE :pattern ORDER BY id DESC LIMIT 1");
        $this->db->bind(':pattern', $prefix . $year . '%');
        $result = $this->db->single();

        if ($result) {
            $lastNumber = (int)substr($result['employee_id'], -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . $year . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function updateStatus($employeeId, $status)
    {
        $allowedStatuses = ['active', 'inactive', 'on_leave', 'terminated'];
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }

        $updateData = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->update('employees', $employeeId, $updateData);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'employee_id' => $this->getEmployeeId(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'role' => $this->getRole(),
            'department_id' => $this->getDepartmentId(),
            'hire_date' => $this->getHireDate(),
            'salary' => $this->getSalary(),
            'emergency_contact' => $this->getEmergencyContact(),
            'emergency_phone' => $this->getEmergencyPhone(),
            'qualifications' => $this->getQualifications(),
            'notes' => $this->getNotes(),
            'status' => $this->getStatus(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
}
