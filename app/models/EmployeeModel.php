<?php

class EmployeeModel
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $phone;
    private $address;
    private $employee_type;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getters and Setters

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function setEmployeeType($employee_type)
    {
        $this->employee_type = $employee_type;
    }
    public function getEmployeeType()
    {
        return $this->employee_type;
    }

    // Convert the current object state to an associative array for DB operations
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'employee_type' => $this->getEmployeeType(),
        ];
    }

    // CRUD Operations

    // Create new employee
  
    

    // Get all employees
    public function getAll()
    {
        $employees = $this->db->readAll('employees');
        return $employees;
    }

    // Get employee by ID
    public function getById($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid employee ID");
        }
        $employee = $this->db->getById('employees', $id);
        if (!$employee) {
            throw new Exception("Employee not found");
        }
        return $employee;
    }

    // Update employee data by ID
    public function update($id, $data)
    {
        $this->setName($data['name'] ?? '');
        $this->setEmail($data['email'] ?? '');
        $this->setPhone($data['phone'] ?? '');
        $this->setAddress($data['address'] ?? '');
        $this->setEmployeeType($data['employee_type'] ?? '');

        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid employee ID");
        }

        // Check if employee exists
        $existing = $this->getById($id);

        // Check email uniqueness for update
        $existingEmail = $this->db->getByEmail('employees', $this->getEmail());
        if ($existingEmail && $existingEmail['id'] != $id) {
            throw new Exception("Another employee with this email already exists");
        }

        $result = $this->db->update('employees', $id, $this->toArray());

        if ($result === false) {
            throw new Exception("Failed to update employee");
        }

        return true;
    }

    // Delete employee by ID
    public function delete($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid employee ID");
        }
        $existing = $this->getById($id);
        $result = $this->db->delete('employees', $id);
        if ($result === false) {
            throw new Exception("Failed to delete employee");
        }
        return true;
    }

    // Get employees by employee_type
    public function getByType($employee_type)
    {
        $employees = $this->db->columnFilter('employees', 'employee_type', $employee_type);
        return $employees;
    }
}
