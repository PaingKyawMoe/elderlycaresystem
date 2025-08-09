<?php
class Activity
{
    private $db;
    private $table = 'activities';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        return $this->db->readAll($this->table);
    }

    public function getById($id)
    {
        return $this->db->getById($this->table, $id);
    }

    public function create($data)
    {
        // $data should be assoc array with keys matching column names
        return $this->db->create($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $id, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, $id);
    }
}
