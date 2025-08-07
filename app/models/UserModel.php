<?php
require_once 'BaseModel.php';
require_once __DIR__ . '/../interfaces/UserModelInterface.php';


class UserModel extends BaseModel implements UserModelInterface
{
    protected $table = 'users';

    public function save()
    {
        $columns = ['name', 'email', 'role_id', 'password'];
        $placeholders = array_map(fn($col) => ':' . $col, $columns);

        $sql = "INSERT INTO {$this->table} (" . implode(',', $columns) . ")
            VALUES (" . implode(',', $placeholders) . ")";

        $this->db->query($sql);

        // Bind values explicitly
        $this->db->bind(':name', $this->name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':role_id', $this->roleid);
        $this->db->bind(':password', $this->password);

        return $this->db->execute();
    }

    public function getAllUsers()
    {
        // $this->db->query("SELECT id, name, email, password FROM users");
        // return $this->db->resultSet();
        return $this->db->callProcedure('GetAllUsers');
    }

    // Delete user by ID
    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
        // $this->db->callProcedure('DeleteUserById', [$id]);
    }

    public function updateUser($data)
    {
        $this->db->query("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }
}
