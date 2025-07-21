<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User List | Elderly Care System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
  <style>
    /* === Base Styles === */
    body {
      font-family: "Roboto", sans-serif;
      margin: 0;
      padding: 30px 0;
      background-color: #f4f7fa;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      box-sizing: border-box;
    }

    .container {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 1200px;
      width: 100%;
      padding: 0 26px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
      border-bottom: 1px solid #eee;
    }

    header h1 {
      font-size: 2em;
      color: #333;
    }

    .logout-btn {
      padding: 8px 15px;
      text-decoration: none;
      color: #555;
      font-weight: bold;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }

    .logout-btn:hover {
      background-color: #f0f0f0;
      color: #333;
    }

    /* === Table Styles === */
    .table-responsive {
      overflow-x: auto;
      overflow-y: auto;
      margin: 20px 0;
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
      background-color: #f8f9fa;
      color: #555;
      text-transform: uppercase;
      font-weight: 700;
      font-size: 0.9em;
    }

    tbody tr:nth-child(even) {
      background-color: #fdfefe;
    }

    tbody tr:hover {
      background-color: #f0f8ff;
    }

    td:nth-child(4) {
      font-family: monospace;
      font-size: 0.8em;
      color: #777;
      max-width: 150px;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
    }

    .action-buttons button {
      padding: 8px 12px;
      font-size: 1em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      color: #fff;
      transition: background-color 0.3s, transform 0.2s;
    }

    .edit-btn {
      background-color: #28a745;
    }

    .edit-btn:hover {
      background-color: #218838;
      transform: translateY(-2px);
    }

    .delete-btn {
      background-color: #dc3545;
    }

    .delete-btn:hover {
      background-color: #c82333;
      transform: translateY(-2px);
    }

    /* === Modal === */
    .modal-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      visibility: hidden;
      opacity: 0;
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .modal-overlay.active {
      visibility: visible;
      opacity: 1;
    }

    .modal-content {
      background: #fff;
      border-radius: 8px;
      padding: 30px;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      transform: translateY(-20px);
      transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
      transform: translateY(0);
    }

    .modal-content h2 {
      margin-bottom: 20px;
      text-align: center;
    }

    .modal-close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 1.5em;
      background: none;
      border: none;
      color: #aaa;
      cursor: pointer;
    }

    .modal-close-btn:hover {
      color: #555;
    }

    .modal-form .form-group {
      margin-bottom: 15px;
    }

    .modal-form label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    .modal-form input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    .cancel-btn {
      background-color: #6c757d;
    }

    .save-btn {
      background-color: #007bff;
    }

    .cancel-btn:hover {
      background-color: #5a6268;
    }

    .save-btn:hover {
      background-color: #0056b3;
    }

    /* === Responsive === */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }

      .logout-btn {
        width: 100%;
        text-align: center;
      }

      th, td {
        padding: 10px;
        font-size: 0.9em;
      }

      .action-buttons button {
        padding: 6px 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Elderly Care System Users</h1>
      <a href="<?= URLROOT ?>/pages/dashboard" class="logout-btn">Logout</a>
    </header>

    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
      </table>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal-overlay" id="editUserModal">
    <div class="modal-content">
      <button class="modal-close-btn" id="closeModalBtn">&times;</button>
      <h2>Edit User</h2>
      <form id="editUserForm" class="modal-form">
        <input type="hidden" id="editUserId" />
        <div class="form-group">
          <label for="editName">Name:</label>
          <input type="text" id="editName" required />
        </div>
        <div class="form-group">
          <label for="editEmail">Email:</label>
          <input type="email" id="editEmail" required />
        </div>
        <div class="form-group">
          <label for="editPassword">Password:</label>
          <input type="text" id="editPassword" required />
        </div>
        <div class="modal-actions">
          <button type="button" class="cancel-btn" id="cancelEditBtn">Cancel</button>
          <button type="submit" class="save-btn">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (() => {
      const users = <?= json_encode($data['users'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      let userList = [...users];

      const modal = document.getElementById('editUserModal');
      const closeBtn = document.getElementById('closeModalBtn');
      const cancelBtn = document.getElementById('cancelEditBtn');
      const form = document.getElementById('editUserForm');
      const tbody = document.getElementById('userTableBody');

      const userId = document.getElementById('editUserId');
      const name = document.getElementById('editName');
      const email = document.getElementById('editEmail');
      const password = document.getElementById('editPassword');

      function renderTable() {
        tbody.innerHTML = userList.length ? userList.map(user => `
          <tr>
            <td>${user.id}</td>
            <td>${escapeHTML(user.name)}</td>
            <td>${escapeHTML(user.email)}</td>
            <td>${escapeHTML(user.password || '')}</td>
            <td>
              <div class="action-buttons">
                <button class="edit-btn" data-id="${user.id}">Edit</button>
                <button class="delete-btn" data-id="${user.id}">Delete</button>
              </div>
            </td>
          </tr>`).join('') : `<tr><td colspan="5" style="text-align:center;">No users found.</td></tr>`;
        attachListeners();
      }

      function attachListeners() {
        document.querySelectorAll('.edit-btn').forEach(btn => {
          btn.onclick = () => {
            const user = userList.find(u => u.id == btn.dataset.id);
            if (user) openModal(user);
          };
        });
        document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.onclick = () => {
    const id = +btn.dataset.id;

    if (confirm(`Are you sure you want to delete user ID ${id}?`)) {
      // Call PHP backend via POST
      fetch(`<?= URLROOT ?>/users/delete/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(response => {
        if (response.status === 'success') {
          // Remove from JS array
          userList = userList.filter(u => u.id !== id);
          renderTable();
          alert("✅ User deleted from database and page.");
        } else {
          alert("❌ Failed to delete: " + response.message);
        }
      })
      .catch(err => {
        alert("❌ Error: " + err);
      });
    }
  };
});

      }

      function openModal(user) {
        userId.value = user.id;
        name.value = user.name;
        email.value = user.email;
        password.value = user.password || '';
        modal.classList.add('active');
      }

      function closeModal() {
        modal.classList.remove('active');
        form.reset();
      }

      form.onsubmit = e => {
  e.preventDefault();

  const updated = {
    id: +userId.value,
    name: name.value.trim(),
    email: email.value.trim(),
    password: password.value.trim()
  };

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
      alert("✅ User updated in database and UI.");
      closeModal();
    } else {
      alert("❌ Failed to update: " + response.message);
    }
  })
  .catch(err => {
    alert("❌ Error updating: " + err);
  });
};


      function escapeHTML(str) {
        return str?.replace(/[&<>"']/g, m => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[m])) || '';
      }

      closeBtn.onclick = closeModal;
      cancelBtn.onclick = closeModal;
      modal.onclick = e => { if (e.target === modal) closeModal(); };

      renderTable();
    })();
  </script>
</body>
</html>
