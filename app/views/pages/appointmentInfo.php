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
                <button class="btn btn-primary" onclick="openAddModal()">
                    <i class="fas fa-plus"></i>
                    New Appointment
                </button>
                <a href="<?= URLROOT ?>/pages/dashboard" class="btn logout-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
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
                            <th>Patient Info</th>
                            <th>Date & Time</th>
                            <th>Type</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentTableBody">
                        <!-- Table content will be populated by JavaScript -->
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
                <form id="appointmentForm">
                    <input type="hidden" id="appointmentId" />

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="patientName">Patient Name</label>
                            <input type="text" id="patientName" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientPhone">Phone Number</label>
                            <input type="tel" id="patientPhone" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentDate">Appointment Date</label>
                            <input type="date" id="appointmentDate" class="form-input" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentTime">Preferred Time</label>
                            <select id="appointmentTime" class="form-select" required>
                                <option value="">Select Time</option>
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="evening">Evening</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="appointmentType">Appointment Type</label>
                            <select id="appointmentType" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="consultation">Consultation</option>
                                <option value="checkup">Checkup</option>
                                <option value="followup">Follow-up</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="selectDoctor">Select Doctor</label>
                            <select id="selectDoctor" class="form-select" required>
                                <option value="">Choose Doctor</option>
                                <option value="dr-smith">Dr. Smith</option>
                                <option value="dr-jones">Dr. Jones</option>
                                <option value="dr-davis">Dr. Davis</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientGender">Gender</label>
                            <select id="patientGender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="patientAddress">Address</label>
                            <input type="text" id="patientAddress" class="form-input" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="reasonForAppointment">Reason for Appointment</label>
                        <textarea id="reasonForAppointment" class="form-textarea" rows="4" placeholder="Describe the reason for this appointment..."></textarea>
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

    <script>
        (() => {
            // Sample data - replace with actual data from PHP
            const appointments = <?= json_encode($data['appointments'] ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
            let appointmentList = [...appointments];
            let filteredAppointments = [...appointments];
            let currentPage = 1;
            const appointmentsPerPage = 10;

            // DOM elements
            const modal = document.getElementById('appointmentModal');
            const closeBtn = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
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
            const reasonForAppointment = document.getElementById('reasonForAppointment');

            let isEditMode = false;

            function renderStats() {
                const stats = {
                    total: appointmentList.length,
                    consultation: appointmentList.filter(a => a.appointmentType === 'consultation').length,
                    checkup: appointmentList.filter(a => a.appointmentType === 'checkup').length,
                    followup: appointmentList.filter(a => a.appointmentType === 'followup').length
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
              <td colspan="8">
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
              <td class="appointment-id">#${appointment.id}</td>
              <td>
                <div class="patient-info">
                  <div class="patient-name">${escapeHTML(appointment.name)}</div>
                  <div class="patient-contact">
                    <i class="fas fa-phone"></i> ${escapeHTML(appointment.phone)}
                    ${appointment.address ? `<br><i class="fas fa-map-marker-alt"></i> ${escapeHTML(appointment.address)}` : ''}
                  </div>
                </div>
              </td>
              <td>
                <div class="time-info">
                  <div class="appointment-date">${formatDate(appointment.preferredDate)}</div>
                  <div class="appointment-time">
                    <i class="fas fa-clock"></i> ${appointment.preferredTime}
                  </div>
                </div>
              </td>
              <td>
                <span class="appointment-badge badge-${appointment.appointmentType}">
                  <i class="fas fa-${getTypeIcon(appointment.appointmentType)}"></i>
                  ${appointment.appointmentType}
                </span>
              </td>
              <td>
                <div class="doctor-info">
                  <i class="fas fa-user-md"></i> ${appointment.selectDoctor}
                </div>
              </td>
              <td>
                <div class="reason-cell" title="${escapeHTML(appointment.reasonForAppointment)}">
                  ${truncateText(appointment.reasonForAppointment, 30)}
                </div>
              </td>
              <td>
                ${appointment.photo ? 
                  `<img src="${URLROOT}/uploads/${appointment.photo}" alt="Patient" class="photo-thumbnail" onclick="viewPhoto('${appointment.photo}')">` :
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

                attachEventListeners();
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

                paginationContainer.innerHTML = paginationHTML;
            }

            function changePage(page) {
                const totalPages = getTotalPages();
                if (page >= 1 && page <= totalPages && page !== currentPage) {
                    currentPage = page;
                    renderTable();
                    document.querySelector('.table-container').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
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
                        appointment.reasonForAppointment.toLowerCase().includes(searchTerm) ||
                        appointment.id.toString().includes(searchTerm);

                    const matchesType = !typeFilterValue || appointment.appointmentType === typeFilterValue;
                    const matchesDoctor = !doctorFilterValue || appointment.selectDoctor === doctorFilterValue;

                    return matchesSearch && matchesType && matchesDoctor;
                });

                currentPage = 1;
                renderTable();
                renderStats();
            }

            function populateDoctorFilter() {
                const doctors = [...new Set(appointmentList.map(a => a.selectDoctor))].filter(Boolean);
                doctorFilter.innerHTML = '<option value="">All Doctors</option>' +
                    doctors.map(doctor => `<option value="${doctor}">${doctor}</option>`).join('');
            }

            // Make changePage globally available
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
                if (appointment && confirm(`Are you sure you want to delete the appointment for "${appointment.name}"?\n\nThis action cannot be undone.`)) {
                    fetch(`<?= URLROOT ?>/appointments/delete/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(response => {
                            if (response.status === 'success') {
                                appointmentList = appointmentList.filter(a => a.id != id);
                                filterAppointments();
                                showNotification('Appointment deleted successfully!', 'success');
                            } else {
                                showNotification('Failed to delete appointment: ' + response.message, 'error');
                            }
                        })
                        .catch(err => {
                            console.error('Delete error:', err);
                            showNotification('Error deleting appointment. Please try again.', 'error');
                        });
                }
            }

            function openAddModal() {
                openModal(null, true);
            }

            function openModal(appointment, editMode) {
                isEditMode = editMode;

                if (appointment) {
                    appointmentId.value = appointment.id;
                    patientName.value = appointment.name;
                    patientPhone.value = appointment.phone;
                    appointmentDate.value = appointment.preferredDate;
                    appointmentTime.value = appointment.preferredTime;
                    appointmentType.value = appointment.appointmentType;
                    selectDoctor.value = appointment.selectDoctor;
                    patientGender.value = appointment.gender;
                    patientAddress.value = appointment.address || '';
                    reasonForAppointment.value = appointment.reasonForAppointment || '';

                    modalTitle.textContent = editMode ? 'Edit Appointment' : 'View Appointment';
                    saveBtn.textContent = editMode ? 'Save Changes' : 'Close';
                    saveBtn.innerHTML = editMode ? '<i class="fas fa-save"></i> Save Changes' : '<i class="fas fa-times"></i> Close';
                } else {
                    form.reset();
                    appointmentId.value = '';
                    modalTitle.textContent = 'New Appointment';
                    saveBtn.innerHTML = '<i class="fas fa-plus"></i> Create Appointment';
                }

                // Disable/enable form fields based on mode
                const formElements = form.querySelectorAll('input, select, textarea');
                formElements.forEach(element => {
                    element.disabled = appointment && !editMode;
                });

                modal.classList.add('active');
                patientName.focus();
            }

            function closeModal() {
                modal.classList.remove('active');
                form.reset();
                isEditMode = false;
            }

            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          padding: 16px 24px;
          background: ${type === 'success' ? 'var(--success-color)' : type === 'error' ? 'var(--danger-color)' : 'var(--primary-color)'};
          color: white;
          border-radius: var(--radius-md);
          box-shadow: var(--shadow-lg);
          z-index: 9999;
          font-weight: 500;
          max-width: 300px;
          animation: slideIn 0.3s ease;
        `;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease forwards';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            function viewPhoto(photoName) {
                const photoModal = document.createElement('div');
                photoModal.className = 'modal-overlay';
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
              <img src="${URLROOT}/uploads/${photoName}" alt="Patient Photo" style="max-width: 100%; height: auto; border-radius: var(--radius-md);">
            </div>
          </div>
        `;

                photoModal.addEventListener('click', (e) => {
                    if (e.target === photoModal) {
                        photoModal.remove();
                    }
                });

                document.body.appendChild(photoModal);
                setTimeout(() => photoModal.classList.add('active'), 10);
            }

            // Form submission
            form.onsubmit = (e) => {
                e.preventDefault();

                if (!isEditMode && appointmentId.value) {
                    // View mode - just close modal
                    closeModal();
                    return;
                }

                const appointmentData = {
                    id: appointmentId.value,
                    name: patientName.value.trim(),
                    phone: patientPhone.value.trim(),
                    preferredDate: appointmentDate.value,
                    preferredTime: appointmentTime.value,
                    appointmentType: appointmentType.value,
                    selectDoctor: selectDoctor.value,
                    gender: patientGender.value,
                    address: patientAddress.value.trim(),
                    reasonForAppointment: reasonForAppointment.value.trim()
                };

                if (!appointmentData.name || !appointmentData.phone || !appointmentData.preferredDate ||
                    !appointmentData.preferredTime || !appointmentData.appointmentType || !appointmentData.selectDoctor) {
                    showNotification('Please fill in all required fields.', 'error');
                    return;
                }

                const url = appointmentData.id ?
                    `<?= URLROOT ?>/appointments/update` :
                    `<?= URLROOT ?>/appointments/create`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(appointmentData)
                    })
                    .then(res => res.json())
                    .then(response => {
                        if (response.status === 'success') {
                            if (appointmentData.id) {
                                // Update existing appointment
                                const index = appointmentList.findIndex(a => a.id == appointmentData.id);
                                if (index !== -1) {
                                    appointmentList[index] = {
                                        ...appointmentList[index],
                                        ...appointmentData
                                    };
                                }
                                showNotification('Appointment updated successfully!', 'success');
                            } else {
                                // Add new appointment
                                appointmentData.id = response.id || Date.now(); // Use server ID or timestamp
                                appointmentList.push(appointmentData);
                                showNotification('Appointment created successfully!', 'success');
                            }

                            filterAppointments();
                            populateDoctorFilter();
                            closeModal();
                        } else {
                            showNotification('Failed to save appointment: ' + response.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Save error:', err);
                        showNotification('Error saving appointment. Please try again.', 'error');
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

            modal.onclick = (e) => {
                if (e.target === modal) closeModal();
            };

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });

            // Make functions globally available
            window.viewAppointment = viewAppointment;
            window.editAppointment = editAppointment;
            window.deleteAppointment = deleteAppointment;
            window.openAddModal = openAddModal;
            window.viewPhoto = viewPhoto;

            // Add CSS animations
            const style = document.createElement('style');
            style.textContent = `
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

        @keyframes slideOut {
          from {
            transform: translateX(0);
            opacity: 1;
          }
          to {
            transform: translateX(100%);
            opacity: 0;
          }
        }

        .fade-in {
          animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
          from { opacity: 0; transform: translateY(10px); }
          to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 640px) {
          .stats-container {
            grid-template-columns: 1fr;
          }
          
          .table-header {
            flex-direction: column;
            align-items: stretch;
          }
          
          .search-container {
            flex-direction: column;
          }
          
          .search-input, .filter-select {
            width: 100%;
          }
        }
      `;
            document.head.appendChild(style);

            // Initialize the page
            populateDoctorFilter();
            renderStats();
            renderTable();
            attachEventListeners();

            // Auto-refresh functionality (optional)
            let autoRefreshInterval;

            function startAutoRefresh(intervalMs = 300000) { // 5 minutes
                autoRefreshInterval = setInterval(() => {
                    if (!modal.classList.contains('active')) {
                        fetch(`<?= URLROOT ?>/appointments/list`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.appointments && Array.isArray(data.appointments)) {
                                    appointmentList = data.appointments;
                                    filterAppointments();
                                    populateDoctorFilter();
                                }
                            })
                            .catch(err => console.warn('Auto-refresh failed:', err));
                    }
                }, intervalMs);
            }

            function stopAutoRefresh() {
                if (autoRefreshInterval) {
                    clearInterval(autoRefreshInterval);
                    autoRefreshInterval = null;
                }
            }

            // Uncomment to enable auto-refresh
            // startAutoRefresh();

            // Cleanup on page unload
            window.addEventListener('beforeunload', () => {
                stopAutoRefresh();
            });

        })();
    </script>
</body>

</html>