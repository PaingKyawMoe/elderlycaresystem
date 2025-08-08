<?php

require_once 'BaseModel.php';

class AppointmentModel extends BaseModel
{
    public function readAll()
    {
        // $this->db->query("SELECT id, name, email, password FROM users");
        // return $this->db->resultSet();
        return $this->db->callProcedure('GetAllAppointments');
    }

    public function findAppointment($name, $dob, $phone)
    {
        $this->db->query("SELECT * FROM appointments WHERE name = :name AND dob = :dob AND phone = :phone");
        $this->db->bind(':name', $name);
        $this->db->bind(':dob', $dob);
        $this->db->bind(':phone', $phone);
        return $this->db->single();
    }

    public function update($id, $data)
    {
        return $this->db->update('appointments', $id, $data);
    }

    public function delete($id)
    {
        return $this->db->delete('appointments', $id);
    }
}
