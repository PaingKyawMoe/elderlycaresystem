<?php

class Appointment extends Controller
{
     private $db;
    
    public function __construct()
    {
        $this->model('AppointmentModel');
    
        $this->db = new Database();
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name']?? '';
            $dob = $_POST['dob']?? '';
            $phone = $_POST['phone']?? '';
            $address = $_POST['address']?? '';
            $gender = $_POST['gender']?? '';
            $preferredDate = $_POST['preferredDate']?? '';
            $appointmentType = $_POST['appointmentType']?? '';
            $preferredTime = $_POST['preferredTime']?? '';
            $selectDoctor = $_POST['selectDoctor']?? '';
            $reasonForAppointment = $_POST['reasonForAppointment']?? '';
            
            // For file upload
            $photo = $_FILES['photo']['name'];
            $tmp_name = $_FILES['photo']['tmp_name'];
            $target = APPROOT . "/../public/uploads/" . basename($photo);
            move_uploaded_file($tmp_name, $target);
            // Create model object
           $appointment = new AppointmentModel();
            $appointment->setName($name);
            $appointment->setdob($dob);
            $appointment->setphone($phone);
            $appointment->setaddress($address);
            $appointment->setgender($gender);
            $appointment->setpreferredDate($preferredDate);
            $appointment->setappointmentType($appointmentType);
            $appointment->setpreferredTime($preferredTime);
            $appointment->setselectDoctor($selectDoctor);
            $appointment->setreasonForAppointment($reasonForAppointment);
            $appointment->setphoto($photo);

            $data = $appointment->toArray();
            

            $saved = $this->db->create('appointments', $data);
            if ($saved) {
                setMessage('success', 'Appointment submitted!');
                redirect('dash');
            } else {
                setMessage('error', 'Something went wrong.');
                redirect('appointment/form');
            }
        } else {
            redirect('appointment/form');
        }
    }
}
