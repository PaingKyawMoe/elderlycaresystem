<?php



interface UserModelInterface
{
    public function save();
    public function getAllUsers();
    public function deleteUser($id);
    public function updateUser($data);
}
