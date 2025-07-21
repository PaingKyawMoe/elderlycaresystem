<?php require_once APPROOT . '/views/inc/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Elderly Care System User List (Admin View with Edit)</title>

<style>
  @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap");

  body {
    font-family: "Roboto", sans-serif;
    margin: 0; padding: 0;
    background: #f4f7fa;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 30px 0;
    box-sizing: border-box;
  }

  .container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 1200px;
    width: 100%;
    padding: 15px 26px 0 0;
    box-sizing: border-box;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: 1px solid #eee;
  }

  header h1 {
    font-size: 2em;
    color: #333;
    margin-left: 36px;
  }

  .logout-btn {
    margin-right: 36px;
    text-decoration: none;
    color: #555;
    font-weight: bold;
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
  }

  .logout-btn:hover {
    background-color: #f0f0f0;
    color: #333;
  }

  .table-responsive {
    overflow-x: auto;
    margin: 30px 0;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 10px 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
    white-space: nowrap;
  }

  th {
    background: #f8f9fa;
    color: #555;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.9em;
  }

  tbody tr:nth-child(even) {
    background: #fdfefe;
  }

  tbody tr:hover {
    background: #f0f8ff;
  }

  td {
    color: #444;
  }

  td:nth-child(5) {
    font-family: "Courier New", monospace;
    color: #777;
    font-size: 0.8em;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  .action-buttons button {
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, transform 0.2s;
  }

  .delete-btn {
    background-color: #dc3545;
  }
  .delete-btn:hover {
    background-color: #c82333;
    transform: translateY(-2px);
  }

  .edit-btn {
    background-color: #28a745;
  }
  .edit-btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
  }

  /* Modal styles */
  .modal-overlay {
    position: fixed;
    top:0; left:0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    z-index: 1000;
  }
  .modal-overlay.active {
    opacity: 1;
    visibility: visible;
  }
  .modal-content {
    background: #fff;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    max-width: 500px;
    width: 90%;
    position: relative;
    transform: translateY(-20px);
    transition: transform 0.3s ease;
  }
  .modal-overlay.active .modal-content {
    transform: translateY(0);
  }
  .modal-content h2 {
    margin: 0 0 20px;
    text-align: center;
    color: #333;
  }
  .modal-form .form-group {
    margin-bottom: 15px;
  }
  .modal-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 700;
    color: #555;
  }
  .modal-form input[type="text"],
  .modal-form input[type="email"],
  .modal-form input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    box-sizing: border-box;
  }
  .modal-actions {
    margin-top: 25px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }
  .modal-actions button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s;
  }
  .cancel-btn {
    background-color: #6c757d;
    color: white;
  }
  .cancel-btn:hover {
    background-color: #5a6268;
  }
  .save-btn {
    background-color: #007bff;
    color: white;
  }
  .save-btn:hover {
    background-color: #0056b3;
  }
  .modal-close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 1.5em;
    color: #aaa;
    cursor: pointer;
    background: none;
    border: none;
  }
  .modal-close-btn:hover {
    color: #555;
  }

  /* Responsive */
  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: flex-start;
    }
    header h1 {
      font-size: 1.7em;
      margin-bottom: 10px;
    }
    .logout-btn {
      width: 100%;
      text-align: center;
      margin-right: 0;
    }
    th, td {
      padding: 10px 10px;
      font-size: 0.9em;
    }
    .action-buttons {
      gap: 5px;
    }
    .action-buttons button {
      padding: 6px 10px;
      font-size: 0.9em;
    }
  }
  @media (max-width: 480px) {
    header h1 {
      font-size: 1.5em;
    }
    th, td {
      font-size: 0.8em;
    }
    .action-buttons button {
      padding: 5px 8px;
      font-size: 0.8em;
    }
    .modal-content {
      padding: 20px;
    }
  }
</style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Elderly Care System Users (Admin View)</h1>
      <a href="pages/dashboard" class="logout-btn">Logout</a>
    </header>

    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          <?php foreach ($data['users'] as $user): ?>
            <tr>
              <td><?= htmlspecialchars($user->id) ?></td>
              <td><?= htmlspecialchars($user->name) ?></td>
              <td><?= htmlspecialchars($user->email) ?></td>
              <td><?= htmlspecialchars($user->password ?? '') ?></td>
              <td>
                <div class="action-buttons">
                  <button class="edit-btn" data-id="<?= $user->id ?>">Edit</button>
                  <button class="delete-btn" data-id="<?= $user->id ?>">Delete</button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal-overlay" id="editUserModal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <button class="modal-close-btn" id="closeModalBtn" aria-label="Close">&times;</button>
      <h2 id="modalTitle">Edit User</h2>
      <form id="editUserForm" class="modal-form" novalidate>
        <input type="hidden" id="editUserId" />
        <div class="form-group">
          <label for="editName">Name:</label>
          <input type="text" id="editName" name="name" required />
        </div>
        <div class="form-group">
          <label for="editEmail">Email:</label>
          <input type="email" id="editEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="editPassword">Password:</label>
          <input type="text" id="editPassword" name="password" required />
        </div>
        <div class="modal-actions">
          <button type="button" class="cancel-btn" id="cancelEditBtn">Cancel</button>
          <button type="submit" class="save-btn">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (() => {
      const users = <?= json_encode($data['users'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      let userList = [...users];

      const userTableBody = document.getElementById('userTableBody');
      const editUserModal = document.getElementById('editUserModal');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const cancelEditBtn = document.getElementById('cancelEditBtn');
      const editUserForm = document.getElementById('editUserForm');

      const editUserId = document.getElementById('editUserId');
      const editName = document.getElementById('editName');
      const editEmail = document.getElementById('editEmail');
      const editPassword = document.getElementById('editPassword');

      function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>"']/g, function (m) {
          return ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
          })[m];
        });
      }

      function renderUsers() {
        userTableBody.innerHTML = '';
        if (userList.length === 0) {
          userTableBody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No users found.</td></tr>`;
          return;
        }

        userList.forEach(user => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${user.id}</td>
            <td>${escapeHtml(user.name)}</td>
            <td>${escapeHtml(user.email)}</td>
            <td>${escapeHtml(user.password || '')}</td>
            <td>
              <div class="action-buttons">
                <button class="edit-btn" data-id="${user.id}">Edit</button>
                <button class="delete-btn" data-id="${user.id}">Delete</button>
              </div>
            </td>
          `;
          userTableBody.appendChild(tr);
        });
        attachEventListeners();
      }

      function openEditModal(user) {
        editUserId.value = user.id;
        editName.value = user.name || '';
        editEmail.value = user.email || '';
        editPassword.value = user.password || '';
        editUserModal.classList.add('active');
        editUserModal.setAttribute('aria-hidden', 'false');
      }

      function closeEditModal() {
        editUserModal.classList.remove('active');
        editUserModal.setAttribute('aria-hidden', 'true');
        editUserForm.reset();
      }

      function attachEventListeners() {
        document.querySelectorAll('.edit-btn').forEach(btn => {
          btn.onclick = () => {
            const id = parseInt(btn.dataset.id);
            const user = userList.find(u => u.id === id);
            if (user) openEditModal(user);
          };
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
          btn.onclick = () => {
            const id = parseInt(btn.dataset.id);
            if (confirm(`Are you sure you want to delete user ID ${id}?`)) {
              userList = userList.filter(u => u.id !== id);
              alert(`User ID ${id} deleted.`);
              renderUsers();
            }
          };
        });
      }

      closeModalBtn.onclick = closeEditModal;
      cancelEditBtn.onclick = closeEditModal;

      editUserForm.onsubmit = e => {
        e.preventDefault();

        const id = parseInt(editUserId.value);
        const name = editName.value.trim();
        const email = editEmail.value.trim();
        const password = editPassword.value.trim();

        if (!name || !email || !password) {
          alert("All fields must be filled!");
          return;
        }

        const duplicate = userList.some(u => u.email === email && u.id !== id);
        if (duplicate) {
          alert("Email already exists for another user!");
          return;
        }

        const index = userList.findIndex(u => u.id === id);
        if (index === -1) {
          alert("User not found.");
          closeEditModal();
          return;
        }

        userList[index] = { id, name, email, password };
        alert(`User ID ${id} updated successfully!`);
        closeEditModal();
        renderUsers();
      };

      editUserModal.onclick = e => {
        if (e.target === editUserModal) closeEditModal();
      };

      renderUsers();
    })();
  </script>
</body>
</html>
