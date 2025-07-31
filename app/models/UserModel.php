<?php

class UserModel
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;
    private $roleid;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRoleid($id)
    {
        $this->roleid = $id;
    }

    // Getters
    public function getRoleid()
    {
        return $this->roleid;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT id, name, email, password FROM users");
        return $this->db->resultSet();
    }

    // Delete user by ID
    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
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

    // Convert object to array
    public function toArray()
    {
        return [
            'id'       => $this->getId(),
            'name'     => $this->getName(),
            'email'    => $this->getEmail(),
            'password' => $this->getPassword(),
            'role_id' => $this->getRoleid()
        ];
    }
}
