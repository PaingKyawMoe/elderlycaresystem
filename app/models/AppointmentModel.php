<?php

class AppointmentModel
{
    private $db;

    // All properties remain private
    private $id;
    private $name;
    private $dob;
    private $phone;
    private $address;
    private $gender;
    private $preferred_date;
    private $appointment_type;
    private $preferred_time;
    private $selectDoctor;
    private $reasonForAppointment;
    private $photo;

    
    public function __construct(array $data = [])
    {
        $this->db = new Database();

        foreach ($data as $key => $value) {
           
            $this->__set($key, $value);
        }
    }

    // Magic setter
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception("Property '$name' does not exist on " . __CLASS__);
        }
    }

    // Magic getter
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Property '$name' does not exist on " . __CLASS__);
    }

    public function delete($id)
    {
        return $this->db->delete('appointments', $id);
    }

    public function update($id, $data)
    {
        return $this->db->update('appointments', $id, $data);
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'preferred_date' => $this->preferred_date,
            'appointment_type' => $this->appointment_type,
            'preferred_time' => $this->preferred_time,
            'selectDoctor' => $this->selectDoctor,
            'reasonForAppointment' => $this->reasonForAppointment,
            'photo' => $this->photo,
        ];
    }

    public function findAppointment($name, $dob, $phone)
    {
        $this->db->query("SELECT * FROM appointments WHERE name = :name AND dob = :dob AND phone = :phone");
        $this->db->bind(':name', $name);
        $this->db->bind(':dob', $dob);
        $this->db->bind(':phone', $phone);
        return $this->db->single();
    }
}
