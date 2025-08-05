<?php
require_once __DIR__ . '/../models/EmployeeModel.php';


class Employee extends Controller
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Data from form
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'role' => $_POST['role'] ?? '',  // doctor, caregiver, driver, staff
            ];

            // Assign data to model attributes
            foreach ($data as $key => $value) {
                $this->employeeModel->__set($key, $value);
            }
            // print_r($this->employeeModel);
            // die();

            $result = $this->employeeModel->save();

            if ($result) {
                setMessage('success', 'Employee added successfully!');
                redirect('pages/dashboard'); 
            } else {
                setMessage('error', 'Failed to add employee.');
                redirect('pages/employee'); 
            }
        }
    }
}
