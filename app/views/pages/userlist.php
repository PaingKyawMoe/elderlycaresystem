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
        <i class="fas fa-users-cog header-icon"></i>
        <span class="header-title">Elderly Care System</span>
      </h1>
      <a href="<?= URLROOT ?>/pages/dashboard" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        Logout
      </a>
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
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (() => {
      const users = <?= json_encode($data['users'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      let userList = [...users];
      let currentPage = 1;
      const usersPerPage = 10;

      // DOM elements
      const modal = document.getElementById('editUserModal');
      const closeBtn = document.getElementById('closeModalBtn');
      const cancelBtn = document.getElementById('cancelEditBtn');
      const form = document.getElementById('editUserForm');
      const tbody = document.getElementById('userTableBody');
      const paginationInfo = document.getElementById('paginationInfo');
      const paginationContainer = document.getElementById('pagination');

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
                  <button class="btn btn-edit" data-id="${user.id}">
                    <i class="fas fa-edit"></i>
                    Edit
                  </button>
                  <button class="btn btn-delete" data-id="${user.id}">
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
          // Scroll to top of table
          document.querySelector('.table-container').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      }

      // Make changePage globally available
      window.changePage = changePage;

      function attachEventListeners() {
        // Edit buttons
        document.querySelectorAll('.btn-edit').forEach(btn => {
          btn.onclick = (e) => {
            e.preventDefault();
            const user = userList.find(u => u.id == btn.dataset.id);
            if (user) openModal(user);
          };
        });

        // Delete buttons
        document.querySelectorAll('.btn-delete').forEach(btn => {
          btn.onclick = (e) => {
            e.preventDefault();
            const id = +btn.dataset.id;
            const user = userList.find(u => u.id === id);

            if (user && confirm(`Are you sure you want to delete "${user.name}"?\n\nThis action cannot be undone.`)) {
              deleteUser(id);
            }
          };
        });
      }

      function deleteUser(id) {
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

      // Form submission
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
      `;
      document.head.appendChild(style);

      // Initialize the table
      renderTable();

      // Add loading state for better UX
      function showLoading(button) {
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        button.disabled = true;
        return () => {
          button.innerHTML = originalContent;
          button.disabled = false;
        };
      }

      // Enhanced error handling
      window.addEventListener('unhandledrejection', (event) => {
        console.error('Unhandled promise rejection:', event.reason);
        showNotification('An unexpected error occurred. Please refresh the page.', 'error');
      });

      // Auto-refresh functionality (optional)
      let autoRefreshInterval;

      function startAutoRefresh(intervalMs = 300000) { // 5 minutes
        autoRefreshInterval = setInterval(() => {
          // Only refresh if modal is not open
          if (!modal.classList.contains('active')) {
            fetch(`<?= URLROOT ?>/users/list`)
              .then(res => res.json())
              .then(data => {
                if (data.users && Array.isArray(data.users)) {
                  userList = data.users;
                  renderTable();
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

      // Add search functionality (if needed)
      function addSearchFilter() {
        const searchContainer = document.querySelector('.table-header');
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Search users...';
        searchInput.className = 'form-input';
        searchInput.style.marginTop = '12px';
        searchInput.style.maxWidth = '300px';

        let searchTimeout;
        searchInput.addEventListener('input', (e) => {
          clearTimeout(searchTimeout);
          searchTimeout = setTimeout(() => {
            const searchTerm = e.target.value.toLowerCase().trim();
            if (searchTerm === '') {
              userList = [...users];
            } else {
              userList = users.filter(user =>
                user.name.toLowerCase().includes(searchTerm) ||
                user.email.toLowerCase().includes(searchTerm) ||
                user.id.toString().includes(searchTerm)
              );
            }
            currentPage = 1;
            renderTable();
          }, 300);
        });

        searchContainer.appendChild(searchInput);
      }

      // Uncomment to add search functionality
      // addSearchFilter();

    })();
  </script>
</body>

</html>