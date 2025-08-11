<?php
require_once APPROOT . '/models/Activity.php';

class Activities extends Controller
{
    private $activityModel;

    public function __construct()
    {
        $this->activityModel = new Activity();
    }

    // Show list + Add form or Edit form if $id provided
    public function index($id = null)
    {
        $activities = $this->activityModel->getAll();
        $data = ['activities' => $activities];

        if ($id) {
            $editActivity = $this->activityModel->getById($id);
            if ($editActivity) {
                $data['editActivity'] = $editActivity;
            }
        }

        $this->view('pages/activities', $data);
    }

    public function elderlyView()
    {
        $activities = $this->activityModel->getAll();
        $data = ['activities' => $activities];
        $this->view('pages/activitiespublic', $data);
    }


    // Handle POST from Add form
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize your inputs here (optional but recommended)

            // Handle photo upload
            $photoName = '';
            if (!empty($_FILES['photo']['name'])) {
                $photoName = $this->uploadPhoto($_FILES['photo']);
                if (!$photoName) {

                    redirect('activities');
                    return;
                }
            }

            $data = [
                'activity_name' => $_POST['activity_name'],
                'category' => $_POST['category'],
                'photo' => $photoName,
                'time' => $_POST['time'],
                'participants' => $_POST['participants'],
                'location' => $_POST['location'],
            ];

            if ($this->activityModel->create($data)) {

                redirect('activities');
            } else {

                redirect('activities');
            }
        }
    }

    // Handle POST from Edit form
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Existing photo from hidden field
            $existingPhoto = $_POST['existing_photo'] ?? '';

            $photoName = $existingPhoto;

            // If new photo uploaded, replace old photo
            if (!empty($_FILES['photo']['name'])) {
                $photoName = $this->uploadPhoto($_FILES['photo']);
                if (!$photoName) {

                    redirect('activities/index/' . $id);
                    return;
                }
                // Optionally, delete old photo file from server here
                if ($existingPhoto && file_exists('uploads/' . $existingPhoto)) {
                    unlink('uploads/' . $existingPhoto);
                }
            }

            $data = [
                'activity_name' => $_POST['activity_name'],
                'category' => $_POST['category'],
                'photo' => $photoName,
                'time' => $_POST['time'],
                'participants' => $_POST['participants'],
                'location' => $_POST['location'],
            ];

            if ($this->activityModel->update($id, $data)) {

                redirect('activities');
            } else {

                redirect('activities/index/' . $id);
            }
        }
    }

    public function delete($id)
    {
        $activity = $this->activityModel->getById($id);
        if ($activity && $this->activityModel->delete($id)) {
            // Delete photo file if exists
            if (!empty($activity['photo']) && file_exists('uploads/' . $activity['photo'])) {
                unlink('uploads/' . $activity['photo']);
            }

            redirect('activities');
        } else {

            redirect('activities');
        }
    }

    private function uploadPhoto($file)
    {
        $targetDir = 'uploads/';
        $fileName = basename($file['name']);
        $targetFilePath = $targetDir . time() . '_' . $fileName;
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file types
        $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return basename($targetFilePath);
            }
        }
        return false;
    }
}
