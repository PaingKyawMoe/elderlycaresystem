<?php
require_once 'BaseModel.php';

class EmployeeModel extends BaseModel
{
    protected $table = 'employees';

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function getAllEmployees()
    {
        return $this->db->callProcedure('GetAllEmployees');
    }

    public function getEmployeeById($id)
    {
        return $this->db->getById($this->table, $id);
    }

    public function updateEmployee($id, $data)
    {

        return $this->db->update($this->table, $id, $data);
    }

    public function deleteEmployee($id)
    {

        return $this->db->delete($this->table, $id);
    }


    public function emailExists($email, $excludeId = null)
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email";


        if ($excludeId) {
            $sql .= " AND id != :excludeId";
        }

        $this->db->query($sql);
        $this->db->bind(':email', $email);

        if ($excludeId) {
            $this->db->bind(':excludeId', $excludeId);
        }

        $result = $this->db->single();
        return $result !== false;
    }

    public function save()
    {
        $columns = ['name', 'email', 'phone', 'address', 'role'];
        $placeholders = array_map(fn($col) => ':' . $col, $columns);

        $sql = "INSERT INTO {$this->table} (" . implode(',', $columns) . ")
            VALUES (" . implode(',', $placeholders) . ")";

        $this->db->query($sql);

        $this->db->bind(':name', $this->name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':phone', $this->phone);
        $this->db->bind(':address', $this->address);
        $this->db->bind(':role', $this->role);

        return $this->db->execute();
    }
}
