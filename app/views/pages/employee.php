<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        form {
            max-width: 600px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input,
        select {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        #message {
            margin-top: 20px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .loading {
            color: #007bff;
        }
    </style>
</head>

<body>

    <h2>Add New Employee</h2>

    <forma action="POST" id="employeeForm">
        <label for="name">Name</label>
        <input type="text" name="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" required>

        <label for="address">Address</label>
        <input type="text" name="address" required>

        <label for="employee_type">Employee Type</label>
        <select name="employee_type" required>
            <option value="">Select type</option>
            <option value="doctor">Doctor</option>
            <option value="caregiver">Caregiver</option>
            <option value="cleaning_staff">Cleaning Staff</option>
            <option value="driver">Driver</option>
        </select>

        <button type="submit" id="submitBtn">Add Employee</button>
        </form>

        <div id="message"></div>

        <script>
            document.getElementById('employeeForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const messageDiv = document.getElementById('message');

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.textContent = 'Adding...';
                messageDiv.textContent = 'Processing...';
                messageDiv.className = 'loading';

                const formData = new FormData(this);

                try {
                    // Replace with your actual URL - you might need to adjust this
                    const response = await fetch('/employee/store', {
                        method: 'POST',
                        body: formData
                    });

                    // Check if response is ok
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Debug: Log the raw response text
                    const responseText = await response.text();
                    console.log('Raw response:', responseText);

                    const result = JSON.parse(responseText);

                    // Fix: Check for 'success' property instead of 'status'
                    if (result.success === true) {
                        messageDiv.textContent = result.message;
                        messageDiv.className = 'success';
                        this.reset();
                    } else {
                        messageDiv.textContent = result.message || 'Failed to add employee.';
                        messageDiv.className = 'error';
                    }
                } catch (error) {
                    messageDiv.textContent = 'Network error: ' + error.message;
                    messageDiv.className = 'error';
                    console.error('Fetch Error:', error);
                } finally {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Add Employee';
                }
            });
        </script>

</body>

</html>