<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/emplist.css?v=<?= time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Employee Lists</h1>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" placeholder="Search employees..." id="searchInput">
                    <span class="search-icon"></span>
                </div>
                <button class="add-btn" onclick="window.location.href='<?= URLROOT; ?>/pages/employee'">Add New</button>
                <button class="add-btn" onclick="window.location.href='<?= URLROOT; ?>/Appointment/list'">Appointment</button>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stats-left">
                <div class="total-count" id="totalCount">
                    Total Employees: <strong>0</strong>
                </div>
                <div class="page-info" id="pageInfo">
                    Showing 0 - 0 of 0 entries
                </div>
            </div>
            <div class="filters">
                <select class="filter-select" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="doctor">Doctor</option>
                    <option value="caregiver">Caregiver</option>
                    <option value="driver">Driver</option>
                    <option value="staff">Staff</option>
                </select>
                <select class="page-size-select" id="pageSizeSelect">
                    <option value="5">5 per page</option>
                    <option value="10" selected>10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>

        <div class="content" id="content">
            <div class="loading">
                <div class="loading-spinner">⏳</div>
                <h3>Loading employees...</h3>
                <p>Please wait while we fetch the data.</p>
            </div>
        </div>
    </div>

    <!-- Alert Container (Fixed Position Overlay) -->
    <div id="alertContainer" class="alert-overlay"></div>

    <!-- Edit Employee Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Employee</h2>
                <button class="close" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm">
                    <input type="hidden" id="editEmployeeId" name="id">

                    <div class="form-group">
                        <label for="editName">Name *</label>
                        <input type="text" id="editName" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="editEmail">Email *</label>
                        <input type="email" id="editEmail" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="editPhone">Phone *</label>
                        <input type="tel" id="editPhone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="editRole">Role *</label>
                        <select id="editRole" name="role" required>
                            <option value="">Select Role</option>
                            <option value="doctor">Doctor</option>
                            <option value="caregiver">Caregiver</option>
                            <option value="driver">Driver</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editAddress">Address *</label>
                        <textarea id="editAddress" name="address" required></textarea>
                    </div>

                    <div class="modal-buttons">
                        <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
                        <button type="submit" class="btn-primary" id="saveEmployeeBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let allEmployees = [];
        let filteredEmployees = [];
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalPages = 1;
        const URLROOT = ''; // Set your URL root here

        // Load employees on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadEmployees();
        });

        // Load employees via AJAX
        function loadEmployees() {
            showLoading();

            fetch(`${URLROOT}/Employee/getEmployeesAjax`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        allEmployees = data.data || [];
                        filteredEmployees = [...allEmployees];
                        currentPage = 1; // Reset to first page
                        updatePagination();
                        displayCurrentPage();
                        updateStats();
                    } else {
                        showError(data.message || 'Failed to load employees');
                    }
                })
                .catch(error => {
                    console.error('Error loading employees:', error);
                    showError('Failed to connect to server. Please try again.');
                });
        }

        // Update pagination variables
        function updatePagination() {
            totalPages = Math.ceil(filteredEmployees.length / itemsPerPage);
            if (totalPages === 0) totalPages = 1;
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
        }

        // Get current page data
        function getCurrentPageData() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            return filteredEmployees.slice(startIndex, endIndex);
        }

        // Display current page employees
        function displayCurrentPage() {
            const content = document.getElementById('content');
            const currentPageData = getCurrentPageData();

            if (filteredEmployees.length === 0) {
                content.innerHTML = `
                    <div class="no-data">
                        <div class="no-data-icon">📋</div>
                        <h3>No employees found</h3>
                        <p>Start by adding your first employee to the system.</p>
                        <br>
                        <button class="add-btn" onclick="addEmployee()">Add First Employee</button>
                    </div>
                `;
                return;
            }

            // Generate table HTML for current page
            const tableHTML = `
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${currentPageData.map(employee => `
                                <tr>
                                    <td>${escapeHtml(employee.id)}</td>
                                    <td>${escapeHtml(employee.name)}</td>
                                    <td>
                                        <span class="role-badge role-${escapeHtml(employee.role)}">
                                            ${escapeHtml(employee.role)}
                                        </span>
                                    </td>
                                    <td>${escapeHtml(employee.email)}</td>
                                    <td>${escapeHtml(employee.phone)}</td>
                                    <td>${escapeHtml(employee.address.substring(0, 50))}...</td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn btn-edit" onclick="editEmployee(${employee.id})">Edit</button>
                                            <button class="btn btn-delete" onclick="deleteEmployee(${employee.id})">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;

            // Generate card HTML for mobile
            const cardHTML = `
                <div class="card-view">
                    ${currentPageData.map(employee => `
                        <div class="employee-card">
                            <div class="card-header">
                                <div class="card-name">${escapeHtml(employee.name)}</div>
                                <span class="role-badge role-${escapeHtml(employee.role)}">
                                    ${escapeHtml(employee.role)}
                                </span>
                            </div>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <div class="card-info-label">Email</div>
                                    <div class="card-info-value">${escapeHtml(employee.email)}</div>
                                </div>
                                <div class="card-info-item">
                                    <div class="card-info-label">Phone</div>
                                    <div class="card-info-value">${escapeHtml(employee.phone)}</div>
                                </div>
                                <div class="card-info-item card-address">
                                    <div class="card-info-label">Address</div>
                                    <div class="card-info-value">${escapeHtml(employee.address)}</div>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="btn btn-edit" onclick="editEmployee(${employee.id})">Edit</button>
                                <button class="btn btn-delete" onclick="deleteEmployee(${employee.id})">Delete</button>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;

            // Generate pagination HTML
            const paginationHTML = generatePagination();

            content.innerHTML = tableHTML + cardHTML + paginationHTML;
        }

        // Generate pagination controls
        function generatePagination() {
            if (totalPages <= 1) {
                return '';
            }

            let pagination = `
                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing ${((currentPage - 1) * itemsPerPage) + 1} to ${Math.min(currentPage * itemsPerPage, filteredEmployees.length)} of ${filteredEmployees.length} entries
                    </div>
                    <div class="pagination">
                        <button onclick="goToPage(1)" ${currentPage === 1 ? 'disabled' : ''}>First</button>
                        <button onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>
            `;

            // Generate page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                pagination += `<button onclick="goToPage(${i})" ${i === currentPage ? 'class="active"' : ''}>${i}</button>`;
            }

            pagination += `
                        <button onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>
                        <button onclick="goToPage(${totalPages})" ${currentPage === totalPages ? 'disabled' : ''}>Last</button>
                    </div>
                </div>
            `;

            return pagination;
        }

        // Go to specific page
        function goToPage(page) {
            if (page >= 1 && page <= totalPages && page !== currentPage) {
                currentPage = page;
                displayCurrentPage();
                updateStats();
            }
        }

        // Update statistics
        function updateStats() {
            const totalCount = document.getElementById('totalCount');
            const pageInfo = document.getElementById('pageInfo');

            totalCount.innerHTML = `Total Employees: <strong>${allEmployees.length}</strong>`;

            const start = ((currentPage - 1) * itemsPerPage) + 1;
            const end = Math.min(currentPage * itemsPerPage, filteredEmployees.length);

            if (filteredEmployees.length === 0) {
                pageInfo.innerHTML = 'No entries found';
            } else {
                pageInfo.innerHTML = `Showing ${start} - ${end} of ${filteredEmployees.length} entries`;
            }
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            filterEmployees(searchTerm, document.getElementById('roleFilter').value);
        });

        // Role filter functionality
        document.getElementById('roleFilter').addEventListener('change', function() {
            const selectedRole = this.value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filterEmployees(searchTerm, selectedRole);
        });

        // Page size change functionality
        document.getElementById('pageSizeSelect').addEventListener('change', function() {
            itemsPerPage = parseInt(this.value);
            currentPage = 1; // Reset to first page
            updatePagination();
            displayCurrentPage();
            updateStats();
        });

        // Filter employees based on search and role
        function filterEmployees(searchTerm = '', roleFilter = '') {
            filteredEmployees = allEmployees.filter(employee => {
                const matchesSearch = !searchTerm ||
                    employee.name.toLowerCase().includes(searchTerm) ||
                    employee.email.toLowerCase().includes(searchTerm) ||
                    employee.phone.toLowerCase().includes(searchTerm) ||
                    employee.address.toLowerCase().includes(searchTerm) ||
                    employee.role.toLowerCase().includes(searchTerm);

                const matchesRole = !roleFilter || employee.role.toLowerCase() === roleFilter.toLowerCase();

                return matchesSearch && matchesRole;
            });

            currentPage = 1; // Reset to first page when filtering
            updatePagination();
            displayCurrentPage();
            updateStats();
        }

        // Delete employee
        function deleteEmployee(id) {
            if (!confirm('Are you sure you want to delete this employee?')) {
                return;
            }

            fetch(`${URLROOT}/Employee/deleteAjax`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Employee deleted successfully!', 'success');
                        loadEmployees(); // Reload the list
                    } else {
                        showAlert(data.message || 'Failed to delete employee', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error deleting employee:', error);
                    showAlert('Failed to delete employee', 'error');
                });
        }

        // Edit employee function
        function editEmployee(id) {
            // Find the employee in our current data
            const employee = allEmployees.find(emp => emp.id == id);

            if (!employee) {
                showAlert('Employee not found', 'error');
                return;
            }

            // Populate the edit form
            document.getElementById('editEmployeeId').value = employee.id;
            document.getElementById('editName').value = employee.name;
            document.getElementById('editEmail').value = employee.email;
            document.getElementById('editPhone').value = employee.phone;
            document.getElementById('editRole').value = employee.role;
            document.getElementById('editAddress').value = employee.address;

            // Show the modal
            document.getElementById('editModal').style.display = 'block';
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('editEmployeeForm').reset();
        }

        // Handle edit form submission
        document.getElementById('editEmployeeForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const saveBtn = document.getElementById('saveEmployeeBtn');
            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving...';

            const formData = new FormData(this);
            const data = {
                id: formData.get('id'),
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                role: formData.get('role'),
                address: formData.get('address')
            };

            fetch(`${URLROOT}/Employee/editAjax`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showAlert('Employee updated successfully!', 'success');
                        closeEditModal();
                        loadEmployees(); // Reload the list to show updated data
                    } else {
                        showAlert(result.message || 'Failed to update employee', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error updating employee:', error);
                    showAlert('Failed to update employee', 'error');
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.textContent = 'Save Changes';
                });
        });

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }

        // Add employee function
        function addEmployee() {
            window.location.href = `${URLROOT}/Employee/add`;
        }

        // Show loading state
        function showLoading() {
            const content = document.getElementById('content');
            content.innerHTML = `
                <div class="loading">
                    <div class="loading-spinner">⏳</div>
                    <h3>Loading employees...</h3>
                    <p>Please wait while we fetch the data.</p>
                </div>
            `;
        }

        // Show error state
        function showError(message) {
            const content = document.getElementById('content');
            content.innerHTML = `
                <div class="error">
                    <h3>Error Loading Data</h3>
                    <p>${escapeHtml(message)}</p>
                    <br>
                    <button class="add-btn" onclick="loadEmployees()">Try Again</button>
                </div>
            `;
        }

        // Show alert messages as flexible overlay
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');

            // Create alert element
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;

            // Create message span
            const messageSpan = document.createElement('span');
            messageSpan.className = 'alert-message';
            messageSpan.textContent = message;

            // Create close button
            const closeBtn = document.createElement('button');
            closeBtn.className = 'alert-close';
            closeBtn.innerHTML = '&times;';
            closeBtn.setAttribute('aria-label', 'Close alert');
            closeBtn.onclick = function() {
                removeAlert(alert);
            };

            // Append elements
            alert.appendChild(messageSpan);
            alert.appendChild(closeBtn);

            // Add to container
            alertContainer.appendChild(alert);

            // Auto-remove alert after 4 seconds
            setTimeout(() => {
                removeAlert(alert);
            }, 4000);
        }

        // Remove alert with smooth animation
        function removeAlert(alert) {
            if (alert && alert.parentNode) {
                alert.style.animation = 'slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 400);
            }
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            if (text === null || text === undefined) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
</body>

</html>