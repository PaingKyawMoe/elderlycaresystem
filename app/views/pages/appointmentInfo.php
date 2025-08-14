<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Appointments | Elderly Care System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/info.css?v=<?= time(); ?>">

</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-calendar-check header-icon"></i>
                <span class="header-title">Appointment Management</span>
            </h1>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Users/userlist'">
                    ViewUsers
                </button>
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Donations/donationDash'">
                    DonationData
                </button>
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Activities/index'">
                    ActivitiesData
                </button>
                <a href="<?= URLROOT ?>/Auth/logout" class="btn logout-btn">
                    Logout
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container" id="statsContainer">
            <!-- Stats will be populated by JavaScript -->
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">All Appointments</h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search appointments..." id="searchInput">
                    <select class="filter-select" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="consultation">Consultation</option>
                        <option value="checkup">Checkup</option>
                        <option value="followup">Follow-up</option>
                    </select>
                    <select class="filter-select" id="doctorFilter">
                        <option value="">All Doctors</option>
                    </select>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Date Of Birth</th>
                            <th>Phone Contact</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Date & Time</th>
                            <th>Type</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentTableBody">
                        <?php if (!empty($data['appointmentData'])): ?>
                            <?php foreach ($data['appointmentData'] as $appointment): ?>
                                <tr>
                                    <td class="appointment-id"><?= $appointment['id'] ?></td>
                                    <td>
                                        <div class="patient-info">
                                            <div class="patient-name"><?= htmlspecialchars($appointment['name']) ?></div>
                                        </div>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($appointment['dob'])) ?></td>
                                    <td>
                                        <div class="patient-contact">
                                            <i class="fas fa-phone"></i> <?= htmlspecialchars($appointment['phone']) ?>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($appointment['address'] ?? 'N/A') ?></td>
                                    <td><?= ucfirst($appointment['gender']) ?></td>
                                    <td>
                                        <div class="time-info">
                                            <div class="appointment-date"><?= date('M d, Y', strtotime($appointment['preferred_date'])) ?></div>
                                            <div class="appointment-time">
                                                <i class="fas fa-clock"></i> <?= ucfirst($appointment['preferred_time']) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="appointment-badge badge-<?= $appointment['appointment_type'] ?>">
                                            <i class="fas fa-<?= $appointment['appointment_type'] == 'consultation' ? 'user-md' : ($appointment['appointment_type'] == 'checkup' ? 'heartbeat' : 'redo') ?>"></i>
                                            <?= ucfirst($appointment['appointment_type']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="doctor-info">
                                            <i class="fas fa-user-md"></i> <?= htmlspecialchars($appointment['selectDoctor']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="reason-cell" title="<?= htmlspecialchars($appointment['reasonForAppointment'] ?? '') ?>">
                                            <?= htmlspecialchars(strlen($appointment['reasonForAppointment'] ?? '') > 30 ? substr($appointment['reasonForAppointment'], 0, 30) . '...' : ($appointment['reasonForAppointment'] ?? 'N/A')) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($appointment['photo'])): ?>
                                            <img src="<?= URLROOT ?>/uploads/<?= $appointment['photo'] ?>"
                                                alt="Patient Photo"
                                                class="photo-thumbnail"
                                                onclick="viewPhoto('<?= $appointment['photo'] ?>')"
                                                onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'50\' height=\'50\' viewBox=\'0 0 50 50\'%3E%3Crect width=\'50\' height=\'50\' fill=\'%23f3f4f6\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%239ca3af\' font-family=\'Arial\' font-size=\'20\'%3E👤%3C/text%3E%3C/svg%3E';">
                                        <?php else: ?>
                                            <div class="photo-placeholder"><i class="fas fa-user"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-small btn-view" onclick="viewAppointment(<?= $appointment['id'] ?>)">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </button>
                                            <button class="btn btn-small btn-edit" onclick="editAppointment(<?= $appointment['id'] ?>)">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-small btn-delete" onclick="deleteAppointment(<?= $appointment['id'] ?>)">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-times"></i>
                                        <h3>No appointments found</h3>
                                        <p>There are no appointments to display.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info" id="paginationInfo">
                    Loading appointments...
                </div>
                <div class="pagination" id="pagination">
                    <!-- Pagination buttons will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit/View Modal -->
    <div class="modal-overlay" id="appointmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Appointment Details</h2>
                <button class="modal-close" id="closeModalBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="appointmentForm" method="POST" action="<?= URLROOT ?>/Appointment/update">
                    <input type="hidden" id="appointmentId" name="id" />

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="patientName">Patient Name</label>
                            <input type="text" id="patientName" name="name" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientPhone">Phone Number</label>
                            <input type="tel" id="patientPhone" name="phone" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientDOB">Date of Birth</label>
                            <input type="date" id="patientDOB" name="dob" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientGender">Gender</label>
                            <select id="patientGender" name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentDate">Appointment Date</label>
                            <input type="date" id="appointmentDate" name="preferredDate" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentTime">Preferred Time</label>
                            <select id="appointmentTime" name="preferredTime" class="form-select" required>
                                <option value="">Select Time</option>
                                <option value="morning">Morning (8 AM - 11 AM)</option>
                                <option value="afternoon">Afternoon (11 AM - 2 PM)</option>
                                <option value="evening">Evening (2 PM - 5 PM)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentType">Appointment Type</label>
                            <select id="appointmentType" name="appointmentType" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="consultation">Consultation</option>
                                <option value="checkup">Checkup</option>
                                <option value="followup">Follow-up</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="selectDoctor">Select Doctor</label>
                            <select id="selectDoctor" name="selectDoctor" class="form-select" required>
                                <option value="">Choose Doctor</option>
                                <option value="Dr. Paing">Dr. Paing</option>
                                <option value="Dr. Kyaw">Dr. Kyaw</option>
                                <option value="Dr. Moe">Dr. Moe</option>
                                <option value="Dr. Phyoe">Dr. Phyoe</option>
                                <option value="Dr. Mya">Dr. Mya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="patientAddress">Address</label>
                        <input type="text" id="patientAddress" name="address" class="form-input" />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="reasonForAppointment">Reason for Appointment</label>
                        <textarea id="reasonForAppointment" name="reasonforappointment" class="form-textarea" rows="4" placeholder="Describe the reason for this appointment..."></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" id="cancelBtn">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="saveBtn" form="appointmentForm">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px;"></i>
                    <h2 class="modal-title">Confirm Delete</h2>
                </div>
                <button class="modal-close" id="closeDeleteModalBtn" style="color: white;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body" style="padding: 30px; text-align: center;">
                <div style="margin-bottom: 20px;">
                    <i class="fas fa-trash-alt" style="font-size: 48px; color: #ef4444; margin-bottom: 15px;"></i>
                    <h3 style="margin-bottom: 10px; color: #1f2937;">Delete Appointment</h3>
                    <p style="color: #6b7280; margin-bottom: 15px;">Are you sure you want to delete the appointment for:</p>
                    <p style="font-weight: bold; color: #1f2937; font-size: 18px;" id="deletePatientName"></p>
                </div>
                <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; text-align: left; border-radius: 6px;">
                    <p style="color: #7f1d1d; margin: 0; font-weight: 500;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                        This action cannot be undone and will permanently remove all appointment data.
                    </p>
                </div>
            </div>

            <div class="modal-actions" style="justify-content: center; gap: 15px;">
                <button type="button" class="btn btn-secondary" id="cancelDeleteBtn" style="min-width: 120px;">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="button" class="btn" id="confirmDeleteBtn" style="background: #ef4444; color: white; min-width: 120px;">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Success/Error Message Container -->
    <div id="messageContainer" class="message-container"></div>

    <script>
        // Define URLROOT for JavaScript if not already defined
        const URLROOT = '<?= URLROOT ?>';

        (() => {
            // Get appointments data from PHP
            const rawAppointments = <?= json_encode($data['Appointments'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

            // Initialize appointment list with the PHP data
            let appointmentList = [...rawAppointments];
            let filteredAppointments = [...appointmentList];
            let currentPage = 1;
            const appointmentsPerPage = 10;

            // DOM elements
            const modal = document.getElementById('appointmentModal');
            const deleteModal = document.getElementById('deleteModal');
            const closeBtn = document.getElementById('closeModalBtn');
            const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const deletePatientName = document.getElementById('deletePatientName');
            const form = document.getElementById('appointmentForm');
            const tbody = document.getElementById('appointmentTableBody');
            const paginationInfo = document.getElementById('paginationInfo');
            const paginationContainer = document.getElementById('pagination');
            const searchInput = document.getElementById('searchInput');
            const typeFilter = document.getElementById('typeFilter');
            const doctorFilter = document.getElementById('doctorFilter');
            const statsContainer = document.getElementById('statsContainer');
            const modalTitle = document.getElementById('modalTitle');
            const saveBtn = document.getElementById('saveBtn');

            let appointmentToDelete = null;

            // Form elements
            const appointmentId = document.getElementById('appointmentId');
            const patientName = document.getElementById('patientName');
            const patientPhone = document.getElementById('patientPhone');
            const appointmentDate = document.getElementById('appointmentDate');
            const appointmentTime = document.getElementById('appointmentTime');
            const appointmentType = document.getElementById('appointmentType');
            const selectDoctor = document.getElementById('selectDoctor');
            const patientGender = document.getElementById('patientGender');
            const patientAddress = document.getElementById('patientAddress');
            const patientDOB = document.getElementById('patientDOB');
            const reasonForAppointment = document.getElementById('reasonForAppointment');

            let isEditMode = false;

            function renderStats() {
                const stats = {
                    total: appointmentList.length,
                    consultation: appointmentList.filter(a => a.appointment_type === 'consultation').length,
                    checkup: appointmentList.filter(a => a.appointment_type === 'checkup').length,
                    followup: appointmentList.filter(a => a.appointment_type === 'followup').length
                };

                statsContainer.innerHTML = `
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon total">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <div class="stat-value">${stats.total}</div>
                                <div class="stat-label">Total Appointments</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon consultation">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div>
                                <div class="stat-value">${stats.consultation}</div>
                                <div class="stat-label">Consultations</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon checkup">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div>
                                <div class="stat-value">${stats.checkup}</div>
                                <div class="stat-label">Check-ups</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon followup">
                                <i class="fas fa-redo"></i>
                            </div>
                            <div>
                                <div class="stat-value">${stats.followup}</div>
                                <div class="stat-label">Follow-ups</div>
                            </div>
                        </div>
                    </div>
                `;
            }

            function getTotalPages() {
                return Math.ceil(filteredAppointments.length / appointmentsPerPage);
            }

            function getCurrentPageAppointments() {
                const startIndex = (currentPage - 1) * appointmentsPerPage;
                const endIndex = startIndex + appointmentsPerPage;
                return filteredAppointments.slice(startIndex, endIndex);
            }

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }

            function renderTable() {
                const currentAppointments = getCurrentPageAppointments();

                if (currentAppointments.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="12">
                                <div class="empty-state">
                                    <i class="fas fa-calendar-times"></i>
                                    <h3>No appointments found</h3>
                                    <p>There are no appointments matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    tbody.innerHTML = currentAppointments.map(appointment => `
                        <tr>
                            <td class="appointment-id">${appointment.id}</td>
                            <td>
                                <div class="patient-info">
                                    <div class="patient-name">${escapeHTML(appointment.name)}</div>
                                </div>
                            </td>
                            <td>${formatDate(appointment.dob)}</td>
                            <td>
                                <div class="patient-contact">
                                    <i class="fas fa-phone"></i> ${escapeHTML(appointment.phone)}
                                </div>
                            </td>
                            <td>${escapeHTML(appointment.address || 'N/A')}</td>
                            <td>${appointment.gender ? appointment.gender.charAt(0).toUpperCase() + appointment.gender.slice(1) : 'N/A'}</td>
                            <td>
                                <div class="time-info">
                                    <div class="appointment-date">${formatDate(appointment.preferred_date)}</div>
                                    <div class="appointment-time">
                                        <i class="fas fa-clock"></i> ${appointment.preferred_time ? appointment.preferred_time.charAt(0).toUpperCase() + appointment.preferred_time.slice(1) : 'N/A'}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="appointment-badge badge-${appointment.appointment_type}">
                                    <i class="fas fa-${getTypeIcon(appointment.appointment_type)}"></i>
                                    ${appointment.appointment_type ? appointment.appointment_type.charAt(0).toUpperCase() + appointment.appointment_type.slice(1) : 'N/A'}
                                </span>
                            </td>
                            <td>
                                <div class="doctor-info">
                                    <i class="fas fa-user-md"></i> ${escapeHTML(appointment.selectDoctor || 'N/A')}
                                </div>
                            </td>
                            <td>
                                <div class="reason-cell" title="${escapeHTML(appointment.reasonForAppointment || '')}">
                                    ${truncateText(appointment.reasonForAppointment || 'No reason provided', 30)}
                                </div>
                            </td>
                            <td>
                                ${appointment.photo ? 
                                    `<img src="${URLROOT}/uploads/${appointment.photo}" 
                                         alt="Patient Photo" 
                                         class="photo-thumbnail" 
                                         onclick="viewPhoto('${appointment.photo}')"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\\'photo-placeholder\\'><i class=\\'fas fa-user\\'></i></div>';">` :
                                    `<div class="photo-placeholder"><i class="fas fa-user"></i></div>`
                                }
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-small btn-view" onclick="viewAppointment(${appointment.id})">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </button>
                                    <button class="btn btn-small btn-edit" onclick="editAppointment(${appointment.id})">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-small btn-delete" onclick="deleteAppointment(${appointment.id})">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `).join('');
                }

                updatePagination();
            }

            function getTypeIcon(type) {
                const icons = {
                    'consultation': 'user-md',
                    'checkup': 'heartbeat',
                    'followup': 'redo'
                };
                return icons[type] || 'calendar';
            }

            function truncateText(text, maxLength) {
                if (!text) return '';
                if (text.length <= maxLength) return escapeHTML(text);
                return escapeHTML(text.substring(0, maxLength)) + '...';
            }

            function updatePagination() {
                const totalPages = getTotalPages();
                const startIndex = (currentPage - 1) * appointmentsPerPage + 1;
                const endIndex = Math.min(currentPage * appointmentsPerPage, filteredAppointments.length);

                // Update pagination info
                paginationInfo.textContent = filteredAppointments.length === 0 ?
                    'No appointments found' :
                    `Showing ${startIndex}-${endIndex} of ${filteredAppointments.length} appointments`;

                // Generate pagination buttons
                let paginationHTML = '';

                if (totalPages > 0) {
                    // Previous button
                    paginationHTML += `
                        <button class="pagination-btn pagination-nav ${currentPage === 1 ? 'disabled' : ''}" 
                                onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    `;

                    // Page numbers
                    const maxVisiblePages = 5;
                    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                    if (endPage - startPage + 1 < maxVisiblePages) {
                        startPage = Math.max(1, endPage - maxVisiblePages + 1);
                    }

                    if (startPage > 1) {
                        paginationHTML += `<button class="pagination-btn" onclick="changePage(1)">1</button>`;
                        if (startPage > 2) {
                            paginationHTML += `<span class="pagination-dots">...</span>`;
                        }
                    }

                    for (let i = startPage; i <= endPage; i++) {
                        paginationHTML += `
                            <button class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                                    onclick="changePage(${i})">${i}</button>
                        `;
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            paginationHTML += `<span class="pagination-dots">...</span>`;
                        }
                        paginationHTML += `<button class="pagination-btn" onclick="changePage(${totalPages})">${totalPages}</button>`;
                    }

                    // Next button
                    paginationHTML += `
                        <button class="pagination-btn pagination-nav ${currentPage === totalPages ? 'disabled' : ''}" 
                                onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    `;
                }

                paginationContainer.innerHTML = paginationHTML;
            }

            function changePage(page) {
                const totalPages = getTotalPages();
                if (page >= 1 && page <= totalPages && page !== currentPage) {
                    currentPage = page;
                    renderTable();
                }
            }

            function filterAppointments() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const typeFilterValue = typeFilter.value;
                const doctorFilterValue = doctorFilter.value;

                filteredAppointments = appointmentList.filter(appointment => {
                    const matchesSearch = !searchTerm ||
                        appointment.name.toLowerCase().includes(searchTerm) ||
                        appointment.phone.includes(searchTerm) ||
                        (appointment.reasonForAppointment && appointment.reasonForAppointment.toLowerCase().includes(searchTerm)) ||
                        appointment.id.toString().includes(searchTerm);

                    const matchesType = !typeFilterValue || appointment.appointment_type === typeFilterValue;
                    const matchesDoctor = !doctorFilterValue || appointment.selectDoctor === doctorFilterValue;

                    return matchesSearch && matchesType && matchesDoctor;
                });

                currentPage = 1;
                renderTable();
            }

            function populateDoctorFilter() {
                const doctors = [...new Set(appointmentList.map(a => a.selectDoctor))].filter(Boolean);
                doctorFilter.innerHTML = '<option value="">All Doctors</option>' +
                    doctors.map(doctor => `<option value="${doctor}">${doctor}</option>`).join('');
            }

            // Make functions globally available
            window.changePage = changePage;

            function attachEventListeners() {
                // Search functionality
                let searchTimeout;
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(filterAppointments, 300);
                });

                typeFilter.addEventListener('change', filterAppointments);
                doctorFilter.addEventListener('change', filterAppointments);
            }

            function viewAppointment(id) {
                const appointment = appointmentList.find(a => a.id == id);
                if (appointment) {
                    openModal(appointment, false);
                }
            }

            function editAppointment(id) {
                const appointment = appointmentList.find(a => a.id == id);
                if (appointment) {
                    openModal(appointment, true);
                }
            }

            function deleteAppointment(id) {
                const appointment = appointmentList.find(a => a.id == id);
                if (appointment) {
                    // Store appointment data for deletion
                    appointmentToDelete = appointment;

                    // Set patient name in the delete modal
                    deletePatientName.textContent = appointment.name;

                    // Show custom delete confirmation modal
                    deleteModal.classList.add('active');
                }
            }

            function confirmDelete() {
                if (appointmentToDelete) {
                    const id = appointmentToDelete.id;

                    // Show loading state on delete button
                    confirmDeleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                    confirmDeleteBtn.disabled = true;

                    // Use AJAX to delete without page refresh
                    fetch(`${URLROOT}/Appointment/deleteAjax`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove from local array and update UI
                                appointmentList = appointmentList.filter(a => a.id != id);
                                filteredAppointments = filteredAppointments.filter(a => a.id != id);
                                renderTable();
                                renderStats();
                                closeDeleteModal();
                                showMessage('Appointment deleted successfully!', 'success');
                            } else {
                                showMessage(data.message || 'Failed to delete appointment.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showMessage('An error occurred while deleting the appointment.', 'error');
                        })
                        .finally(() => {
                            // Reset delete button state
                            confirmDeleteBtn.innerHTML = '<i class="fas fa-trash"></i> Delete';
                            confirmDeleteBtn.disabled = false;
                        });
                }
            }

            function closeDeleteModal() {
                deleteModal.classList.remove('active');
                appointmentToDelete = null;
            }

            function openModal(appointment, editMode) {
                isEditMode = editMode;

                if (appointment) {
                    appointmentId.value = appointment.id;
                    patientName.value = appointment.name;
                    patientPhone.value = appointment.phone;
                    appointmentDate.value = appointment.preferred_date;
                    appointmentTime.value = appointment.preferred_time;
                    appointmentType.value = appointment.appointment_type;
                    selectDoctor.value = appointment.selectDoctor;
                    patientGender.value = appointment.gender;
                    patientAddress.value = appointment.address || '';
                    patientDOB.value = appointment.dob || '';
                    reasonForAppointment.value = appointment.reasonForAppointment || '';

                    modalTitle.textContent = editMode ? 'Edit Appointment' : 'View Appointment';
                    saveBtn.style.display = editMode ? 'inline-block' : 'none';
                    saveBtn.innerHTML = editMode ? '<i class="fas fa-save"></i> Save Changes' : '';
                } else {
                    form.reset();
                    appointmentId.value = '';
                    modalTitle.textContent = 'New Appointment';
                    saveBtn.style.display = 'inline-block';
                    saveBtn.innerHTML = '<i class="fas fa-plus"></i> Create Appointment';
                }

                // Disable/enable form fields based on mode
                const formElements = form.querySelectorAll('input, select, textarea');
                formElements.forEach(element => {
                    element.disabled = appointment && !editMode;
                });

                modal.classList.add('active');
                if (editMode || !appointment) {
                    patientName.focus();
                }
            }

            function closeModal() {
                modal.classList.remove('active');
                form.reset();
                isEditMode = false;
            }

            function showMessage(message, type = 'info') {
                const messageContainer = document.getElementById('messageContainer');
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${type}`;
                messageDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()" class="message-close">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                messageContainer.appendChild(messageDiv);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (messageDiv.parentElement) {
                        messageDiv.remove();
                    }
                }, 5000);
            }

            function viewPhoto(photoName) {
                const photoModal = document.createElement('div');
                photoModal.className = 'modal-overlay active';
                photoModal.style.zIndex = '1001';
                photoModal.innerHTML = `
                    <div class="modal-content" style="max-width: 800px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Patient Photo</h2>
                            <button class="modal-close" onclick="this.closest('.modal-overlay').remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <img src="${URLROOT}/uploads/${photoName}" 
                                 alt="Patient Photo" 
                                 style="max-width: 100%; height: auto; border-radius: var(--border-radius);"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\\'http://www.w3.org/2000/svg\\' width=\\'400\\' height=\\'300\\' viewBox=\\'0 0 400 300\\'%3E%3Crect width=\\'400\\' height=\\'300\\' fill=\\'%23f3f4f6\\'/%3E%3Ctext x=\\'50%25\\' y=\\'50%25\\' text-anchor=\\'middle\\' dy=\\'.3em\\' fill=\\'%239ca3af\\' font-family=\\'Arial\\' font-size=\\'20\\'%3EImage not found%3C/text%3E%3C/svg%3E';">
                        </div>
                    </div>
                `;

                photoModal.addEventListener('click', (e) => {
                    if (e.target === photoModal) {
                        photoModal.remove();
                    }
                });

                document.body.appendChild(photoModal);
            }

            // Form submission - handles both edit and create with AJAX
            form.onsubmit = (e) => {
                e.preventDefault();

                if (!isEditMode && appointmentId.value) {
                    // View mode - just close modal
                    closeModal();
                    return;
                }

                // Validate required fields
                const requiredFields = ['name', 'phone', 'dob', 'gender', 'preferredDate', 'preferredTime', 'appointmentType', 'selectDoctor'];
                const missingFields = requiredFields.filter(field => !form.elements[field].value.trim());

                if (missingFields.length > 0) {
                    showMessage('Please fill in all required fields.', 'error');
                    return;
                }

                // Show loading state
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                saveBtn.disabled = true;

                // Prepare form data
                const formData = new FormData(form);

                // Use AJAX to update without page refresh
                fetch(`${URLROOT}/Appointment/updateAjax`, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update local array
                            const updatedData = {
                                id: appointmentId.value,
                                name: patientName.value.trim(),
                                phone: patientPhone.value.trim(),
                                dob: patientDOB.value,
                                gender: patientGender.value,
                                address: patientAddress.value.trim(),
                                preferred_date: appointmentDate.value,
                                preferred_time: appointmentTime.value,
                                appointment_type: appointmentType.value,
                                selectDoctor: selectDoctor.value,
                                reasonForAppointment: reasonForAppointment.value.trim()
                            };

                            const index = appointmentList.findIndex(a => a.id == appointmentId.value);
                            if (index !== -1) {
                                appointmentList[index] = {
                                    ...appointmentList[index],
                                    ...updatedData
                                };
                            }

                            // Update filtered appointments
                            const filteredIndex = filteredAppointments.findIndex(a => a.id == appointmentId.value);
                            if (filteredIndex !== -1) {
                                filteredAppointments[filteredIndex] = {
                                    ...filteredAppointments[filteredIndex],
                                    ...updatedData
                                };
                            }

                            renderTable();
                            renderStats();
                            closeModal();
                            showMessage('Appointment updated successfully!', 'success');
                        } else {
                            showMessage(data.message || 'Failed to update appointment.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showMessage('An error occurred while updating the appointment.', 'error');
                    })
                    .finally(() => {
                        // Reset button state
                        saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
                        saveBtn.disabled = false;
                    });
            };

            function escapeHTML(str) {
                if (!str) return '';
                return str.replace(/[&<>"']/g, (match) => {
                    const escapeMap = {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#39;'
                    };
                    return escapeMap[match];
                });
            }

            // Event listeners
            closeBtn.onclick = closeModal;
            cancelBtn.onclick = closeModal;
            closeDeleteModalBtn.onclick = closeDeleteModal;
            cancelDeleteBtn.onclick = closeDeleteModal;
            confirmDeleteBtn.onclick = confirmDelete;

            modal.onclick = (e) => {
                if (e.target === modal) closeModal();
            };

            deleteModal.onclick = (e) => {
                if (e.target === deleteModal) closeDeleteModal();
            };

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (modal.classList.contains('active')) {
                        closeModal();
                    }
                    if (deleteModal.classList.contains('active')) {
                        closeDeleteModal();
                    }
                }
            });

            // Make functions globally available
            window.viewAppointment = viewAppointment;
            window.editAppointment = editAppointment;
            window.deleteAppointment = deleteAppointment;
            window.viewPhoto = viewPhoto;

            // Initialize the page
            populateDoctorFilter();
            renderStats();
            renderTable();
            attachEventListeners();

            // Check for success/error messages from PHP (if any)
            <?php if (isset($_SESSION['success_message'])): ?>
                showMessage('<?= $_SESSION['success_message'] ?>', 'success');
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                showMessage('<?= $_SESSION['error_message'] ?>', 'error');
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

        })();
    </script>

    <style>
        /* Message styles */
        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .message {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-out;
        }

        .message.success {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            color: #047857;
        }

        .message.error {
            background: #fee2e2;
            border-left: 4px solid #1b84fcff;
            color: #dc2626;
        }

        .message.info {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            color: #1d4ed8;
        }

        .message-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 2px;
            margin-left: auto;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .message-close:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>

</body>

</html>