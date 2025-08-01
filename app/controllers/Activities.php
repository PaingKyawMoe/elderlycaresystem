<?php

class Activities extends Controller
{
    private $activityModel;

    public function __construct()
    {
        $this->activityModel = $this->model('Activity');
    }

    /**
     * Display activities index page (public view)
     */
    public function index()
    {
        try {
            $activities = $this->activityModel->getActiveActivities();

            $data = [
                'title' => 'Activities - Elder Care System',
                'activities' => $activities,
                'stats' => $this->activityModel->getActivityStats()
            ];

            $this->view('activities/index', $data);
        } catch (Exception $e) {
            error_log("Error in Activities index: " . $e->getMessage());
            $this->view('activities/index', [
                'title' => 'Activities - Elder Care System',
                'activities' => [],
                'error' => 'Unable to load activities at this time.'
            ]);
        }
    }

    /**
     * Display admin activities page
     */
    public function admin()
    {
        // TODO: Uncomment authentication when session management is ready
        if (!$this->isLoggedIn() || !$this->isAdmin()) {
            redirect('users/login');
            return;
        }

        try {
            $activities = $this->activityModel->getAllActivities();
            $stats = $this->activityModel->getActivityStats();

            $data = [
                'title' => 'Activities Admin - Elder Care System',
                'activities' => $activities,
                'stats' => $stats
            ];

            $this->view('activities/admin', $data);
        } catch (Exception $e) {
            error_log("Error in Activities admin: " . $e->getMessage());
            $this->view('activities/admin', [
                'title' => 'Activities Admin - Elder Care System',
                'activities' => [],
                'error' => 'Unable to load activities data.'
            ]);
        }
    }

    public function create()
    {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        try {
            // Sanitize and validate input
            $data = [
                'title' => $this->sanitizeInput($_POST['title'] ?? ''),
                'description' => $this->sanitizeInput($_POST['description'] ?? ''),
                'category' => $_POST['category'] ?? '',
                'time' => $_POST['time'] ?? '',
                'duration' => $_POST['duration'] ?? '',
                'status' => $_POST['status'] ?? 'active',
                'image' => $this->sanitizeInput($_POST['image'] ?? '')
            ];

            // Additional validation
            if (
                empty($data['title']) || empty($data['description']) || empty($data['category']) ||
                empty($data['time']) || empty($data['duration'])
            ) {
                $this->jsonResponse(['success' => false, 'message' => 'All required fields must be filled']);
                return;
            }

            // Check for duplicate title
            if ($this->activityModel->titleExists($data['title'])) {
                $this->jsonResponse(['success' => false, 'message' => 'An activity with this title already exists']);
                return;
            }

            // Create activity
            $activityId = $this->activityModel->createActivity($data);

            if ($activityId) {
                $this->jsonResponse([
                    'success' => true,
                    'message' => 'Activity created successfully',
                    'id' => $activityId
                ]);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Failed to create activity']);
            }
        } catch (Exception $e) {
            error_log("Error creating activity: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'An error occurred while creating the activity']);
        }
    }


    public function update()
    {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        try {
            $activityId = $_POST['id'] ?? '';

            if (empty($activityId)) {
                $this->jsonResponse(['success' => false, 'message' => 'Activity ID is required']);
                return;
            }

            // Sanitize and validate input
            $data = [
                'title' => $this->sanitizeInput($_POST['title'] ?? ''),
                'description' => $this->sanitizeInput($_POST['description'] ?? ''),
                'category' => $_POST['category'] ?? '',
                'time' => $_POST['time'] ?? '',
                'duration' => $_POST['duration'] ?? '',
                'status' => $_POST['status'] ?? 'active',
                'image' => $this->sanitizeInput($_POST['image'] ?? '')
            ];

            // Additional validation
            if (
                empty($data['title']) || empty($data['description']) || empty($data['category']) ||
                empty($data['time']) || empty($data['duration'])
            ) {
                $this->jsonResponse(['success' => false, 'message' => 'All required fields must be filled']);
                return;
            }

            // Check for duplicate title (excluding current activity)
            if ($this->activityModel->titleExists($data['title'], $activityId)) {
                $this->jsonResponse(['success' => false, 'message' => 'An activity with this title already exists']);
                return;
            }

            // Update activity
            $success = $this->activityModel->updateActivity($activityId, $data);

            if ($success) {
                $this->jsonResponse(['success' => true, 'message' => 'Activity updated successfully']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Failed to update activity']);
            }
        } catch (Exception $e) {
            error_log("Error updating activity: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'An error occurred while updating the activity']);
        }
    }


    public function delete()
    {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        try {
            $activityId = $_POST['id'] ?? '';

            if (empty($activityId)) {
                $this->jsonResponse(['success' => false, 'message' => 'Activity ID is required']);
                return;
            }

            // Delete activity
            $success = $this->activityModel->deleteActivity($activityId);

            if ($success) {
                $this->jsonResponse(['success' => true, 'message' => 'Activity deleted successfully']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Failed to delete activity']);
            }
        } catch (Exception $e) {
            error_log("Error deleting activity: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'An error occurred while deleting the activity']);
        }
    }


    public function getAll()
    {

        try {
            $activities = $this->activityModel->getAllActivities();
            $this->jsonResponse(['success' => true, 'activities' => $activities]);
        } catch (Exception $e) {
            error_log("Error getting all activities: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'Failed to retrieve activities']);
        }
    }


    public function getById($id = null)
    {
        if (empty($id)) {
            $this->jsonResponse(['success' => false, 'message' => 'Activity ID is required']);
            return;
        }

        try {
            $activity = $this->activityModel->getActivityById($id);

            if ($activity) {
                $this->jsonResponse(['success' => true, 'activity' => $activity]);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Activity not found']);
            }
        } catch (Exception $e) {
            error_log("Error getting activity by ID: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'Failed to retrieve activity']);
        }
    }


    public function search()
    {
        try {
            $searchTerm = $_GET['search'] ?? '';
            $category = $_GET['category'] ?? '';
            $status = $_GET['status'] ?? '';

            $activities = $this->activityModel->searchActivities($searchTerm, $category, $status);
            $this->jsonResponse(['success' => true, 'activities' => $activities]);
        } catch (Exception $e) {
            error_log("Error searching activities: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'Search failed']);
        }
    }


    public function toggleStatus()
    {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        try {
            $activityId = $_POST['id'] ?? '';

            if (empty($activityId)) {
                $this->jsonResponse(['success' => false, 'message' => 'Activity ID is required']);
                return;
            }

            $success = $this->activityModel->toggleActivityStatus($activityId);

            if ($success) {
                $activity = $this->activityModel->getActivityById($activityId);
                $this->jsonResponse([
                    'success' => true,
                    'message' => 'Activity status updated successfully',
                    'newStatus' => $activity['status']
                ]);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Failed to update activity status']);
            }
        } catch (Exception $e) {
            error_log("Error toggling activity status: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'An error occurred while updating status']);
        }
    }


    public function getStats()
    {
        try {
            $stats = $this->activityModel->getActivityStats();
            $this->jsonResponse(['success' => true, 'stats' => $stats]);
        } catch (Exception $e) {
            error_log("Error getting activity stats: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'message' => 'Failed to retrieve statistics']);
        }
    }


    public function category($category = null)
    {
        if (empty($category)) {
            redirect('activities');
            return;
        }

        try {
            $activities = $this->activityModel->getActivitiesByCategory($category);

            $data = [
                'title' => ucfirst($category) . ' Activities - Elder Care System',
                'activities' => $activities,
                'category' => $category,
                'stats' => $this->activityModel->getActivityStats()
            ];

            $this->view('activities/category', $data);
        } catch (Exception $e) {
            error_log("Error getting activities by category: " . $e->getMessage());
            redirect('activities');
        }
    }


    public function show($id = null)
    {
        if (empty($id)) {
            redirect('activities');
            return;
        }

        try {
            $activity = $this->activityModel->getActivityById($id);

            if (!$activity || $activity['status'] !== 'active') {
                redirect('activities');
                return;
            }

            $data = [
                'title' => $activity['title'] . ' - Elder Care System',
                'activity' => $activity
            ];

            $this->view('activities/show', $data);
        } catch (Exception $e) {
            error_log("Error showing activity: " . $e->getMessage());
            redirect('activities');
        }
    }


    private function isLoggedIn()
    {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    private function isAdmin()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin';
    }


    private function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }


    private function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
