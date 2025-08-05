<?php
require_once 'BaseModel.php';

class EmployeeModel extends BaseModel
{
    protected $table = 'employees'; // DB table name

    public function __construct($data = [])
    {
        parent::__construct($data);
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
