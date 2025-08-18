<?php

require_once __DIR__ . '/../services/AppointmentService.php';

class Appointment extends Controller
{
    private $appointmentService;
    private $uploadDir;

    public function __construct()
    {
        $db = new Database();
        $repository = new AppointmentRepository($db);
        $this->appointmentService = new AppointmentService($repository);

        // Store uploads OUTSIDE public web root if possible
        $this->uploadDir = realpath(APPROOT . '/../public/uploads');
        if ($this->uploadDir === false) {
            throw new Exception("Upload directory not found");
        }
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

        $name  = trim($_POST['name'] ?? '');
        $dob   = trim($_POST['dob'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        // Basic validation (avoid URL tampering / missing fields)
        if ($name === '' || $dob === '' || $phone === '' || !preg_match('/^\d{10,15}$/', $phone)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
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

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($id === false) {
            echo json_encode(['success' => false, 'message' => 'Invalid ID']);
            return;
        }

        $success = $this->appointmentService->deleteAppointment($id);
        echo json_encode(['success' => $success, 'message' => $success ? 'Deleted successfully!' : 'Failed to delete.']);
    }

    public function updateAjax()
    {
        header('Content-Type: application/json');

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($id === false) {
            echo json_encode(['success' => false, 'message' => 'Invalid appointment ID']);
            return;
        }

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
            'name' => trim($_POST['name'] ?? ''),
            'dob' => $_POST['dob'] ?? '',
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'gender' => $_POST['gender'] ?? '',
            'preferred_date' => $_POST['preferredDate'] ?? '',
            'appointment_type' => $_POST['appointmentType'] ?? '',
            'preferred_time' => $_POST['preferredTime'] ?? '',
            'selectDoctor' => $_POST['selectDoctor'] ?? '',
            'reasonForAppointment' => trim($_POST['reasonforappointment'] ?? ''),
        ];

        $data['photo'] = null;

        if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['photo']['tmp_name'];
            $origName = $_FILES['photo']['name'];

            // Size limit (2MB)
            if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
                setMessage('error', 'File too large.');
                redirect('appointment/form');
                return;
            }

            // Check MIME using Fileinfo
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($tmpName);
            $allowed = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png'
            ];

            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            if (!array_key_exists($ext, $allowed) || $allowed[$ext] !== $mime) {
                setMessage('error', 'Invalid file type.');
                redirect('appointment/form');
                return;
            }

            // Generate safe random name
            $safeName = bin2hex(random_bytes(16)) . '.' . $ext;
            $target = $this->uploadDir . DIRECTORY_SEPARATOR . $safeName;

            // Prevent directory traversal
            $realTarget = realpath(dirname($target));
            if ($realTarget === false || strpos($realTarget, $this->uploadDir) !== 0) {
                setMessage('error', 'Invalid upload path.');
                redirect('appointment/form');
                return;
            }

            if (!move_uploaded_file($tmpName, $target)) {
                setMessage('error', 'Failed to save file.');
                redirect('appointment/form');
                return;
            }

            chmod($target, 0600); // owner only
            $data['photo'] = $safeName;
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
