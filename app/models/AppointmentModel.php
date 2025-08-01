<?php

class AppointmentModel
{
    private $db;
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

    public function __construct()
    {
        $this->db = new Database(); // You already have a Database class
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

    public function setdob($dob)
    {
        $this->dob = $dob;
    }

    public function getdob()
    {
        return $this->dob;
    }

    public function setphone($phone)
    {
        $this->phone = $phone;
    }
    public function getphone()
    {
        return $this->phone;
    }

    public function setaddress($address)
    {
        $this->address = $address;
    }
    public function getaddress()
    {
        return $this->address;
    }

    public function setgender($gender)
    {
        $this->gender = $gender;
    }
    public function getgender()
    {
        return $this->gender;
    }

    public function setpreferredDate($preferred_date)
    {
        $this->preferred_date = $preferred_date;
    }
    public function getpreferredDate()
    {
        return $this->preferred_date;
    }

    public function setappointmentType($appointment_type)
    {
        $this->appointment_type = $appointment_type;
    }
    public function getappointmentType()
    {
        return $this->appointment_type;
    }

    public function setpreferredTime($preferred_time)
    {
        $this->preferred_time = $preferred_time;
    }
    public function getpreferredTime()
    {
        return $this->preferred_time;
    }

    public function setselectDoctor($selectDoctor)
    {
        $this->selectDoctor = $selectDoctor;
    }
    public function getselectDoctor()
    {
        return $this->selectDoctor;
    }

    public function setreasonForAppointment($reasonForAppointment)
    {
        $this->reasonForAppointment = $reasonForAppointment;
    }
    public function getreasonForAppointment()
    {
        return $this->reasonForAppointment;
    }

    public function setphoto($photo)
    {
        $this->photo = $photo;
    }
    public function getphoto()
    {
        return $this->photo;
    }

    public function delete($id)
    {
        return $this->db->delete('appointments', $id);
    }

    // Update appointment
    public function update($id, $data)
    {
        return $this->db->update('appointments', $id, $data);
    }

    public function toArray()
    {
        return [
            'name'   => $this->getName(),
            'dob' => $this->getdob(),
            'phone' => $this->getphone(),
            'address' => $this->getaddress(),
            'gender' => $this->getgender(),
            'preferred_date' => $this->getpreferredDate(),
            'appointment_type' => $this->getappointmentType(),
            'preferred_time' => $this->getpreferredTime(),
            'selectDoctor' => $this->getselectDoctor(),
            'reasonforappointment' => $this->getreasonForAppointment(),
            'photo' => $this->getphoto(),
        ];
    }

    public function findAppointment($name, $dob, $phone)
    {
        $this->db->query("SELECT * FROM appointments WHERE name = :name AND dob = :dob AND phone = :phone");
        $this->db->bind(':name', $name);
        $this->db->bind(':dob', $dob);
        $this->db->bind(':phone', $phone);
        return $this->db->single(); // return single row or false
    }
}
