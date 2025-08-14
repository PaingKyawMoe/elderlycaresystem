<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User List | Elderly Care System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/userlist.css?v=<?= time(); ?>">

</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h1>
        <i class="fas fa-calendar-check header-icon"></i>
        <span class="header-title">Register Users</span>
      </h1>
      <div class="header-actions">
        <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Appointment/list'">
          AppointmentData
        </button>
        <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Donations/donationDash'">
          DonationData
        </button>
        <a href="<?= URLROOT ?>/Auth/logout" class="btn logout-btn">
          Logout
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="userTableBody">
            <!-- Table content will be populated by JavaScript -->
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination-container">
        <div class="pagination-info" id="paginationInfo">
          Showing 1-10 of 50 users
        </div>
        <div class="pagination" id="pagination">
          <!-- Pagination buttons will be populated by JavaScript -->
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal-overlay" id="editUserModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Edit User</h2>
        <button class="modal-close" id="closeModalBtn">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="editUserForm">
        <input type="hidden" id="editUserId" />

        <div class="form-group">
          <label class="form-label" for="editName">Full Name</label>
          <input type="text" id="editName" class="form-input" required />
        </div>

        <div class="form-group">
          <label class="form-label" for="editEmail">Email Address</label>
          <input type="email" id="editEmail" class="form-input" required />
        </div>

        <div class="form-group">
          <label class="form-label" for="editPassword">Password</label>
          <input type="text" id="editPassword" class="form-input" required />
        </div>

        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelEditBtn">
            <i class="fas fa-times"></i>
            Cancel
          </button>
          <button type="submit" class="btn btn-primary" id="saveUserBtn">
            <i class="fas fa-save"></i>
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal-overlay" id="deleteUserModal">
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
          <i class="fas fa-user-times" style="font-size: 48px; color: #ef4444; margin-bottom: 15px;"></i>
          <h3 style="margin-bottom: 10px; color: #1f2937;">Delete User</h3>
          <p style="color: #6b7280; margin-bottom: 15px;">Are you sure you want to delete this user:</p>
          <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 15px; border-radius: 8px; margin: 15px 0;">
            <p style="font-weight: bold; color: #1f2937; font-size: 18px; margin: 0;" id="deleteUserName"></p>
            <p style="color: #6b7280; margin: 5px 0 0 0; font-size: 14px;" id="deleteUserEmail"></p>
          </div>
        </div>
        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; text-align: left; border-radius: 6px;">
          <p style="color: #7f1d1d; margin: 0; font-weight: 500;">
            <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
            This action cannot be undone and will permanently remove all user data including their appointments and history.
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
          Delete User
        </button>
      </div>
    </div>
  </div>

  <!-- Success/Error Message Container -->
  <div id="messageContainer" class="message-container"></div>

  <script>
    (() => {
      const users = <?= json_encode($data['users'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      let userList = [...users];
      let currentPage = 1;
      const usersPerPage = 10;
      let userToDelete = null;

      // DOM elements
      const modal = document.getElementById('editUserModal');
      const deleteModal = document.getElementById('deleteUserModal');
      const closeBtn = document.getElementById('closeModalBtn');
      const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
      const cancelBtn = document.getElementById('cancelEditBtn');
      const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const deleteUserName = document.getElementById('deleteUserName');
      const deleteUserEmail = document.getElementById('deleteUserEmail');
      const form = document.getElementById('editUserForm');
      const tbody = document.getElementById('userTableBody');
      const paginationInfo = document.getElementById('paginationInfo');
      const paginationContainer = document.getElementById('pagination');
      const saveUserBtn = document.getElementById('saveUserBtn');

      const userId = document.getElementById('editUserId');
      const name = document.getElementById('editName');
      const email = document.getElementById('editEmail');
      const password = document.getElementById('editPassword');

      function getTotalPages() {
        return Math.ceil(userList.length / usersPerPage);
      }

      function getCurrentPageUsers() {
        const startIndex = (currentPage - 1) * usersPerPage;
        const endIndex = startIndex + usersPerPage;
        return userList.slice(startIndex, endIndex);
      }

      function renderTable() {
        const currentUsers = getCurrentPageUsers();

        if (currentUsers.length === 0) {
          tbody.innerHTML = `
            <tr>
              <td colspan="4">
                <div class="empty-state">
                  <i class="fas fa-user-slash"></i>
                  <h3>No users found</h3>
                  <p>There are no users to display at the moment.</p>
                </div>
              </td>
            </tr>
          `;
        } else {
          tbody.innerHTML = currentUsers.map(user => `
            <tr>
              <td class="user-id">${user.id}</td>
              <td class="user-name">${escapeHTML(user.name)}</td>
              <td class="user-email">${escapeHTML(user.email)}</td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-edit" onclick="editUser(${user.id})">
                    <i class="fas fa-edit"></i>
                    Edit
                  </button>
                  <button class="btn btn-delete" onclick="deleteUser(${user.id})">
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

      function updatePagination() {
        const totalPages = getTotalPages();
        const startIndex = (currentPage - 1) * usersPerPage + 1;
        const endIndex = Math.min(currentPage * usersPerPage, userList.length);

        // Update pagination info
        paginationInfo.textContent = userList.length === 0 ?
          'No users found' :
          `Showing ${startIndex}-${endIndex} of ${userList.length} users`;

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
          // Scroll to top of table
          document.querySelector('.table-container').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      }

      // Make functions globally available
      window.changePage = changePage;

      function editUser(id) {
        const user = userList.find(u => u.id == id);
        if (user) openModal(user);
      }

      function deleteUser(id) {
        const user = userList.find(u => u.id == id);
        if (user) {
          // Store user data for deletion
          userToDelete = user;

          // Set user details in the delete modal
          deleteUserName.textContent = user.name;
          deleteUserEmail.textContent = user.email;

          // Show custom delete confirmation modal
          deleteModal.classList.add('active');
        }
      }

      function confirmDelete() {
        if (userToDelete) {
          const id = userToDelete.id;

          closeDeleteModal();


          fetch(`<?= URLROOT ?>/users/delete/${id}`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              }
            })
            .then(res => res.json())
            .then(response => {
              if (response.status === 'success') {
                userList = userList.filter(u => u.id !== id);

                // Adjust current page if necessary
                const totalPages = getTotalPages();
                if (currentPage > totalPages && totalPages > 0) {
                  currentPage = totalPages;
                }

                renderTable();

                // Show success message
                showNotification('User deleted successfully!', 'success');
              } else {
                showNotification('Failed to delete user: ' + response.message, 'error');
              }
            })
            .catch(err => {
              console.error('Delete error:', err);
              showNotification('Error deleting user. Please try again.', 'error');
            });
        }
      }

      function closeDeleteModal() {
        deleteModal.classList.remove('active');
        userToDelete = null;
      }

      // Make functions globally available
      window.editUser = editUser;
      window.deleteUser = deleteUser;

      function openModal(user) {
        userId.value = user.id;
        name.value = user.name;
        email.value = user.email;
        password.value = user.password || '';
        modal.classList.add('active');
        name.focus();
      }

      function closeModal() {
        modal.classList.remove('active');
        form.reset();
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

      // Form submission - keep exactly as your original
      form.onsubmit = (e) => {
        e.preventDefault();

        const updated = {
          id: +userId.value,
          name: name.value.trim(),
          email: email.value.trim(),
          password: password.value.trim()
        };

        if (!updated.name || !updated.email || !updated.password) {
          showNotification('Please fill in all fields.', 'error');
          return;
        }

        fetch(`<?= URLROOT ?>/users/update`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(updated)
          })
          .then(res => res.json())
          .then(response => {
            if (response.status === 'success') {
              const index = userList.findIndex(u => u.id === updated.id);
              if (index !== -1) {
                userList[index] = updated;
                renderTable();
              }
              showNotification('User updated successfully!', 'success');
              closeModal();
            } else {
              showNotification('Failed to update user: ' + response.message, 'error');
            }
          })
          .catch(err => {
            console.error('Update error:', err);
            showNotification('Error updating user. Please try again.', 'error');
          });
      };

      function showNotification(message, type = 'info') {
        // Simple notification - you can enhance this with a proper notification system
        const notification = document.createElement('div');
        notification.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          padding: 16px 24px;
          background: ${type === 'success' ? 'var(--success-color)' : type === 'error' ? 'var(--danger-color)' : 'var(--primary-color)'};
          color: white;
          border-radius: 8px;
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

      // Initialize the table
      renderTable();

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
      border-left: 4px solid #ef4444;
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

    /* Enhanced modal styles for better user experience */
    .modal-overlay.active {
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .modal-content {
      animation: scaleIn 0.3s ease;
    }

    @keyframes scaleIn {
      from {
        transform: scale(0.9);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>

</body>

</html>