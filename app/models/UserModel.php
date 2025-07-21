<?php 

class UserModel
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;

     public function __construct() {
        $this->db = new Database(); // Use your custom wrapper
 // change credentials
    }

    
    public function getAllUsers() {
     $this->db->query("SELECT id, name, email ,password FROM users");
    return $this->db->resultSet();
    }

    

    

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

    public function setpassword($password)
    {
        $this->password = $password;
    }

    public function getpassword()
    {
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }

    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            'name'   => $this->getName(),
            'email'  => $this->getEmail(),
            'password'   => $this->getpassword()
        ];
    }
}