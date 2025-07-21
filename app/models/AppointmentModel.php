<?php 

class AppointmentModel
{
    private $id;
    private $name;
    private $dob;
    private $phone;
    private $address;
    private $gender;
    private $preferredDate;
    private $appointmentType;
    private $preferredTime;
    private $selectDoctor;
    private $reasonForAppointment;
    private $photo;

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

    public function setphone($phone){
        $this->phone = $phone;
    }
    public function getphone(){
        return $this->phone;
    }

    public function setaddress($address){
        $this->address = $address;
    }
    public function getaddress(){
        return $this->address;
    }

    public function setgender($gender){
        $this->gender = $gender;
    }
    public function getgender(){
        return $this->gender;
    }

    public function setpreferredDate($preferredDate){
        $this->preferredDate = $preferredDate;
    }
    public function getpreferredDate(){
        return $this->preferredDate;
    }

      public function setappointmentType($appointmentType){
        $this->appointmentType = $appointmentType;
    }
    public function getappointmentType(){
        return $this->appointmentType;
    }

      public function setpreferredTime($preferredTime){
        $this->preferredTime = $preferredTime;
    }
    public function getpreferredTime(){
        return $this->preferredTime;
    }
    
      public function setselectDoctor($selectDoctor){
        $this->selectDoctor = $selectDoctor;
    }
    public function getselectDoctor(){
        return $this->selectDoctor;
    }

      public function setreasonForAppointment($reasonForAppointment){
        $this->reasonForAppointment = $reasonForAppointment;
    }
    public function getreasonForAppointment(){
        return $this->reasonForAppointment;
    }

      public function setphoto($photo){
        $this->photo = $photo;
    }
    public function getphoto(){
        return $this->photo;
    }

    public function toArray()
{
    return [
        'name'   => $this->getName(),
        'dob' => $this->getdob(),
        'phone' => $this->getphone(),
        'address' => $this->getaddress(),
        'gender' => $this->getgender(),
        'preferredDate' => $this->getpreferredDate(),
        'appointmentType' => $this->getappointmentType(),
        'preferredTime' => $this->getpreferredTime(),
        'selectDoctor' => $this->getselectDoctor(),
        'reasonForAppointment' => $this->getreasonForAppointment(),
        'photo' => $this->getphoto(),
    ];
}

}