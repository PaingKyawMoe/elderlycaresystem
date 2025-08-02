<?php

class Activity
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get all activities using readAll function
     */
    public function getAllActivities()
    {
        try {
            $activities = $this->db->readAll('activities');

            // Debug logging
            error_log("getAllActivities() returned " . count($activities) . " activities");
            if (!empty($activities)) {
                error_log("Sample activity: " . json_encode($activities[0]));
            }

            // Sort by created_at DESC
            usort($activities, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return $activities;
        } catch (Exception $e) {
            error_log("Error getting all activities: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get all activities and filter active ones using readAll
     */
    public function getActiveActivities()
    {
        try {
            // Get all activities using readAll
            $allActivities = $this->db->readAll('activities');

            // Filter only active activities
            $activeActivities = array_filter($allActivities, function ($activity) {
                return $activity['status'] === 'active';
            });

            // Sort by time ASC
            usort($activeActivities, function ($a, $b) {
                return strtotime($a['time']) - strtotime($b['time']);
            });

            return array_values($activeActivities); // Re-index array
        } catch (Exception $e) {
            error_log("Error getting active activities: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get activities by category using readAll
     */
    public function getActivitiesByCategory($category)
    {
        try {
            // Get all activities using readAll
            $allActivities = $this->db->readAll('activities');

            // Filter by category
            $categoryActivities = array_filter($allActivities, function ($activity) use ($category) {
                return $activity['category'] === $category;
            });

            // Sort by time ASC
            usort($categoryActivities, function ($a, $b) {
                return strtotime($a['time']) - strtotime($b['time']);
            });

            return array_values($categoryActivities);
        } catch (Exception $e) {
            error_log("Error getting activities by category: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get activities by status using readAll
     */
    public function getActivitiesByStatus($status)
    {
        try {
            // Get all activities using readAll
            $allActivities = $this->db->readAll('activities');

            // Filter by status
            $statusActivities = array_filter($allActivities, function ($activity) use ($status) {
                return $activity['status'] === $status;
            });

            // Sort by created_at DESC
            usort($statusActivities, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return array_values($statusActivities);
        } catch (Exception $e) {
            error_log("Error getting activities by status: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get activities grouped by category using readAll
     */
    public function getActivitiesGroupedByCategory()
    {
        try {
            // Get all active activities using readAll
            $activeActivities = $this->getActiveActivities();

            // Group activities by category
            $grouped = [];
            foreach ($activeActivities as $activity) {
                $grouped[$activity['category']][] = $activity;
            }

            return $grouped;
        } catch (Exception $e) {
            error_log("Error getting grouped activities: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get featured activities using readAll
     */
    public function getFeaturedActivities($limit = 3)
    {
        try {
            // Get all active activities
            $activeActivities = $this->getActiveActivities();

            // Get the most recent ones (featured)
            $featured = array_slice($activeActivities, 0, $limit);

            return $featured;
        } catch (Exception $e) {
            error_log("Error getting featured activities: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get activities by time of day using readAll
     */
    public function getActivitiesByTimeOfDay()
    {
        try {
            // Get all active activities
            $activeActivities = $this->getActiveActivities();

            // Group by time period
            $grouped = [
                'Morning' => [],
                'Afternoon' => [],
                'Evening' => []
            ];

            foreach ($activeActivities as $activity) {
                $hour = (int)date('H', strtotime($activity['time']));

                if ($hour >= 6 && $hour < 12) {
                    $grouped['Morning'][] = $activity;
                } elseif ($hour >= 12 && $hour < 18) {
                    $grouped['Afternoon'][] = $activity;
                } else {
                    $grouped['Evening'][] = $activity;
                }
            }

            return $grouped;
        } catch (Exception $e) {
            error_log("Error getting activities by time: " . $e->getMessage());
            return ['Morning' => [], 'Afternoon' => [], 'Evening' => []];
        }
    }

    /**
     * Get activity statistics using readAll
     */
    public function getActivityStats()
    {
        try {
            // Get all activities using readAll
            $allActivities = $this->db->readAll('activities');

            $stats = [
                'total' => count($allActivities),
                'active' => 0,
                'inactive' => 0,
                'categories' => 0,
                'category_breakdown' => []
            ];

            $categories = [];
            $categoryCount = [];

            foreach ($allActivities as $activity) {
                // Count by status
                if ($activity['status'] === 'active') {
                    $stats['active']++;
                } elseif ($activity['status'] === 'inactive') {
                    $stats['inactive']++;
                }

                // Count categories
                $category = $activity['category'];
                if (!in_array($category, $categories)) {
                    $categories[] = $category;
                }

                if (!isset($categoryCount[$category])) {
                    $categoryCount[$category] = 0;
                }
                $categoryCount[$category]++;
            }

            $stats['categories'] = count($categories);

            // Format category breakdown
            foreach ($categoryCount as $category => $count) {
                $stats['category_breakdown'][] = [
                    'category' => $category,
                    'count' => $count
                ];
            }

            return $stats;
        } catch (Exception $e) {
            error_log("Error getting activity stats: " . $e->getMessage());
            return [
                'total' => 0,
                'active' => 0,
                'inactive' => 0,
                'categories' => 0,
                'category_breakdown' => []
            ];
        }
    }

    /**
     * Get category statistics using readAll
     */
    public function getCategoryStats()
    {
        try {
            // Get all active activities
            $activeActivities = $this->getActiveActivities();

            $categoryCount = [];

            foreach ($activeActivities as $activity) {
                $category = $activity['category'];
                if (!isset($categoryCount[$category])) {
                    $categoryCount[$category] = 0;
                }
                $categoryCount[$category]++;
            }

            // Convert to array format
            $categoryStats = [];
            foreach ($categoryCount as $category => $count) {
                $categoryStats[] = [
                    'category' => $category,
                    'count' => $count
                ];
            }

            // Sort by count (highest first)
            usort($categoryStats, function ($a, $b) {
                return $b['count'] - $a['count'];
            });

            return $categoryStats;
        } catch (Exception $e) {
            error_log("Error getting category stats: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Search activities using readAll
     */
    public function searchPublicActivities($searchTerm, $category = null)
    {
        try {
            // Get all active activities
            $activeActivities = $this->getActiveActivities();

            // Filter by search term and category
            $searchResults = array_filter($activeActivities, function ($activity) use ($searchTerm, $category) {
                $matchesSearch = true;
                $matchesCategory = true;

                // Check search term
                if (!empty($searchTerm)) {
                    $searchLower = strtolower($searchTerm);
                    $titleMatch = strpos(strtolower($activity['title']), $searchLower) !== false;
                    $descMatch = strpos(strtolower($activity['description']), $searchLower) !== false;
                    $matchesSearch = $titleMatch || $descMatch;
                }

                // Check category
                if (!empty($category)) {
                    $matchesCategory = $activity['category'] === $category;
                }

                return $matchesSearch && $matchesCategory;
            });

            return array_values($searchResults);
        } catch (Exception $e) {
            error_log("Error searching public activities: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Check if activity title exists using readAll
     */
    public function titleExists($title, $excludeId = null)
    {
        try {
            // Get all activities using readAll
            $allActivities = $this->db->readAll('activities');

            foreach ($allActivities as $activity) {
                if ($activity['title'] === $title) {
                    // If excluding an ID, skip that activity
                    if ($excludeId && $activity['id'] == $excludeId) {
                        continue;
                    }
                    return true;
                }
            }

            return false;
        } catch (Exception $e) {
            error_log("Error checking title existence: " . $e->getMessage());
            return false;
        }
    }

    // Keep your existing methods that use specific queries
    // (getActivityById, createActivity, updateActivity, deleteActivity, toggleActivityStatus)
    // These are better with direct SQL queries for performance

    /**
     * Get activity by ID (keep existing method using getById)
     */
    public function getActivityById($id)
    {
        try {
            return $this->db->getById('activities', $id);
        } catch (Exception $e) {
            error_log("Error getting activity by ID: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Create new activity (keep existing method)
     */
    public function createActivity($data)
    {
        try {
            // Validate required fields
            $requiredFields = ['title', 'description', 'category', 'time', 'duration'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    throw new Exception("Field {$field} is required");
                }
            }

            // Validate category
            $validCategories = ['Physical', 'Mental', 'Social', 'Creative'];
            if (!in_array($data['category'], $validCategories)) {
                throw new Exception("Invalid category");
            }

            // Validate status
            $validStatuses = ['active', 'inactive'];
            if (isset($data['status']) && !in_array($data['status'], $validStatuses)) {
                throw new Exception("Invalid status");
            }

            // Validate duration
            if ($data['duration'] < 15 || $data['duration'] > 240) {
                throw new Exception("Duration must be between 15 and 240 minutes");
            }

            // Validate time format
            if (!$this->isValidTime($data['time'])) {
                throw new Exception("Invalid time format");
            }

            // Prepare data for insertion
            $activityData = [
                'title' => trim($data['title']),
                'description' => trim($data['description']),
                'category' => $data['category'],
                'time' => $data['time'],
                'duration' => (int)$data['duration'],
                'status' => $data['status'] ?? 'active'
            ];

            // Add image if provided and valid
            if (!empty($data['image']) && $this->isValidUrl($data['image'])) {
                $activityData['image'] = trim($data['image']);
            }

            return $this->db->create('activities', $activityData);
        } catch (Exception $e) {
            error_log("Error creating activity: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update activity (keep existing method)
     */
    public function updateActivity($id, $data)
    {
        try {
            // Check if activity exists
            $existingActivity = $this->getActivityById($id);
            if (!$existingActivity) {
                throw new Exception("Activity not found");
            }

            // Validate required fields
            $requiredFields = ['title', 'description', 'category', 'time', 'duration'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    throw new Exception("Field {$field} is required");
                }
            }

            // Validate category
            $validCategories = ['Physical', 'Mental', 'Social', 'Creative'];
            if (!in_array($data['category'], $validCategories)) {
                throw new Exception("Invalid category");
            }

            // Validate status
            $validStatuses = ['active', 'inactive'];
            if (isset($data['status']) && !in_array($data['status'], $validStatuses)) {
                throw new Exception("Invalid status");
            }

            // Validate duration
            if ($data['duration'] < 15 || $data['duration'] > 240) {
                throw new Exception("Duration must be between 15 and 240 minutes");
            }

            // Validate time format
            if (!$this->isValidTime($data['time'])) {
                throw new Exception("Invalid time format");
            }

            // Prepare data for update
            $activityData = [
                'title' => trim($data['title']),
                'description' => trim($data['description']),
                'category' => $data['category'],
                'time' => $data['time'],
                'duration' => (int)$data['duration'],
                'status' => $data['status'] ?? 'active'
            ];

            // Add image if provided and valid, or set to null if empty
            if (!empty($data['image'])) {
                if ($this->isValidUrl($data['image'])) {
                    $activityData['image'] = trim($data['image']);
                } else {
                    throw new Exception("Invalid image URL");
                }
            } else {
                $activityData['image'] = null;
            }

            return $this->db->update('activities', $id, $activityData);
        } catch (Exception $e) {
            error_log("Error updating activity: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete activity (keep existing method)
     */
    public function deleteActivity($id)
    {
        try {
            // Check if activity exists
            $existingActivity = $this->getActivityById($id);
            if (!$existingActivity) {
                throw new Exception("Activity not found");
            }

            return $this->db->delete('activities', $id);
        } catch (Exception $e) {
            error_log("Error deleting activity: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Toggle activity status (keep existing method)
     */
    public function toggleActivityStatus($id)
    {
        try {
            $activity = $this->getActivityById($id);
            if (!$activity) {
                throw new Exception("Activity not found");
            }

            $newStatus = $activity['status'] === 'active' ? 'inactive' : 'active';

            $sql = "UPDATE activities SET status = :status WHERE id = :id";
            $this->db->query($sql);
            $this->db->bind(':status', $newStatus);
            $this->db->bind(':id', $id);

            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error toggling activity status: " . $e->getMessage());
            return false;
        }
    }

    private function isValidTime($time)
    {
        return preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $time);
    }

    private function isValidUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
