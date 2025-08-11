<?php

require_once __DIR__ . '/../services/AppointmentService.php';

class Appointment extends Controller
{
    private $appointmentService;

    public function __construct()
    {
        $db = new Database();
        $repository = new AppointmentRepository($db);
        $this->appointmentService = new AppointmentService($repository);
    }

    public function list()
    {
        $appointments = $this->appointmentService->listAppointments();
        $this->view('pages/appointmentInfo', ['Appointments' => $appointments]);
    }

    public function find($mode = 'check')
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $dob = trim($_POST['dob'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if (!$name || !$dob || !$phone) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        $appointment = $this->appointmentService->checkAppointment($name, $dob, $phone);

        if ($mode === 'check') {
            echo json_encode($appointment
                ? ['status' => 'exists', 'message' => 'You already have an appointment.', 'data' => $appointment]
                : ['status' => 'available', 'message' => 'No appointment found.']);
        } elseif ($mode === 'search') {
            echo json_encode($appointment
                ? ['status' => 'found', 'data' => $appointment]
                : ['status' => 'not_found']);
        }
    }

    public function deleteAjax()
    {
        header('Content-Type: application/json');
        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'Missing ID']);
            return;
        }
        $success = $this->appointmentService->deleteAppointment((int)$_POST['id']);
        echo json_encode(['success' => $success, 'message' => $success ? 'Deleted successfully!' : 'Failed to delete.']);
    }

    public function updateAjax()
    {
        header('Content-Type: application/json');

        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'Missing appointment ID']);
            return;
        }

        $id = (int)$_POST['id'];

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'dob' => $_POST['dob'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'address' => trim($_POST['address'] ?? ''),
            'preferred_date' => $_POST['preferredDate'] ?? '',
            'preferred_time' => $_POST['preferredTime'] ?? '',
            'appointment_type' => $_POST['appointmentType'] ?? '',
            'selectDoctor' => $_POST['selectDoctor'] ?? '',
            'reasonForAppointment' => trim($_POST['reasonforappointment'] ?? ''),
        ];

        try {
            $this->appointmentService->updateAppointment($id, $data);
            echo json_encode(['success' => true, 'message' => 'Appointment updated successfully!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred while updating the appointment.']);
        }
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('appointment/form');
            return;
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'dob' => $_POST['dob'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'preferred_date' => $_POST['preferredDate'] ?? '',
            'appointment_type' => $_POST['appointmentType'] ?? '',
            'preferred_time' => $_POST['preferredTime'] ?? '',
            'selectDoctor' => $_POST['selectDoctor'] ?? '',
            'reasonForAppointment' => $_POST['reasonforappointment'] ?? '',
        ];

        if (!empty($_FILES['photo']['name'])) {
            $photo = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], APPROOT . "/../public/uploads/" . basename($photo));
            $data['photo'] = $photo;
        } else {
            $data['photo'] = null;
        }

        $result = $this->appointmentService->createAppointment($data);

        if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            header('Content-Type: application/json');
            echo json_encode($result);
            return;
        }

        if ($result['success']) {
            redirect('pages/dashboard');
        } else {
            setMessage('error', $result['message']);
            redirect('appointment/form');
        }
    }
}
