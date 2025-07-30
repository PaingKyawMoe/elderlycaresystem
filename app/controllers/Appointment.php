<?php

class Appointment extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('AppointmentModel');
        $this->db = new Database();
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $dob = trim($_POST['dob']);
            $phone = trim($_POST['phone']);
            if (empty($name) || empty($dob) || empty($phone)) {
                echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
                return;
            }

            if (!method_exists($this->model('AppointmentModel'), 'findAppointment')) {
                echo json_encode(['status' => 'error', 'message' => 'Method findAppointment not found']);
                return;
            }

            try {
                $appointment = $this->model('AppointmentModel')->findAppointment($name, $dob, $phone);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . $e->getMessage()]);
                return;
            }

            if ($appointment) {
                echo json_encode([
                    'status' => 'found',
                    'data' => $appointment
                ]);
            } else {
                echo json_encode([
                    'status' => 'not_found'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }
    }



    public function appointmentInfo()
    {
        // Load the appointment database model
        $appointmentModel = $this->model('AppointmentModel');

        // Get all appointments
        $appointments = $appointmentModel->getAllAppointments();

        // Pass to the view
        $data = [
            'appointments' => $appointments
        ];

        $this->view('pages/appointmentInfo', $data);
    }

    // public function index()
    // {
    //     echo "This is the Appointment index page.";
    // }

    // AJAX Delete method - returns JSON response
    public function deleteAjax()
    {
        // Set JSON response header
        header('Content-Type: application/json');

        if ($_POST && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Use your existing database delete method
            $result = $this->db->delete('appointments', $id);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Appointment deleted successfully!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to delete appointment.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
        exit; // Important: stop execution after JSON response
    }

    // AJAX Update method - returns JSON response
    public function updateAjax()
    {
        // Set JSON response header
        header('Content-Type: application/json');

        if ($_POST && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Prepare data array (matching your database column names)
            $data = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'dob' => $_POST['dob'],
                'gender' => $_POST['gender'],
                'address' => trim($_POST['address']),
                'preferred_date' => $_POST['preferredDate'],
                'preferred_time' => $_POST['preferredTime'],
                'appointment_type' => $_POST['appointmentType'],
                'selectDoctor' => $_POST['selectDoctor'],
                'reasonForAppointment' => trim($_POST['reasonforappointment'])
            ];

            // Use your existing database update method
            $result = $this->db->update('appointments', $id, $data);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Appointment updated successfully!',
                    'data' => $data
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update appointment.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
        exit; // Important: stop execution after JSON response
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $dob = $_POST['dob'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $preferred_date = $_POST['preferredDate'] ?? '';
            $appointment_type = $_POST['appointmentType'] ?? '';
            $preferred_time = $_POST['preferredTime'] ?? '';
            $selectDoctor = $_POST['selectDoctor'] ?? '';
            $reasonForAppointment = $_POST['reasonforappointment'] ?? '';

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
            $appointment->setpreferredDate($preferred_date);
            $appointment->setappointmentType($appointment_type);
            $appointment->setpreferredTime($preferred_time);
            $appointment->setselectDoctor($selectDoctor);
            $appointment->setreasonForAppointment($reasonForAppointment);
            $appointment->setphoto($photo);

            $data = $appointment->toArray();


            $saved = $this->db->create('appointments', $data);
            if ($saved) {
                setMessage('success', 'Appointment submitted!');
                redirect('pages/dashboard');
            } else {
                setMessage('error', 'Something went wrong.');
                redirect('appointment/form');
            }
        } else {
            redirect('appointment/form');
        }
    }
}
