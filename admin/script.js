$(function () {
  console.log("Dashboard JS loaded.");

  // Load users by default
  $("#content").load("users.php", function () {
    fetchUsers();
  });

  // Sidebar navigation
  $(document).on("click", ".nav-link", function (e) {
    e.preventDefault();
    const page = $(this).attr("href");
    $("#content").load(page, function () {
      if (page === "users.php") fetchUsers();
    });
  });

  // Fetch & display users
  function fetchUsers() {
    $.ajax({
      url: "api/users_list.php",
      method: "GET",
      dataType: "json",
      success: function (data) {
        console.log("Raw API response:", data);

        if (!Array.isArray(data)) {
          console.error("Expected an array, got:", typeof data, data);
          return;
        }

        let rows = "";
        data.forEach(u => {
          rows += `
            <tr>
              <td>${u.user_id}</td>
              <td>${u.first_name} ${u.last_name}</td>
              <td>${u.contact_no}</td>
              <td>${u.email}</td>
              <td><span class="badge bg-info">${u.role}</span></td>
              <td>
                ${u.status === "active"
                  ? '<span class="badge bg-success">Active</span>'
                  : '<span class="badge bg-secondary">Inactive</span>'}
              </td>
              <td>
                <button class="btn btn-sm btn-warning btn-edit" data-user='${JSON.stringify(u)}'>
                  <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="${u.user_id}">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>`;
        });
        $("#usersTableBody").html(rows);
      },
      error: function (xhr, status, err) {
        console.error("AJAX error:", status, err, xhr.responseText);
      }
    });
  }


  // Add user
  $(document).on("submit", "#addUserForm", function (e) {
    e.preventDefault();
    $.post("api/users_add.php", $(this).serialize(), function (res) {
      if (res.ok) {
        bootstrap.Modal.getInstance(document.getElementById("addUserModal")).hide();
        fetchUsers();
        alert("✅ User added successfully!");
      } else {
        alert(res.message || "❌ Add failed");
      }
    }, "json");
  });


  // Populate edit modal
  $(document).on("click", ".btn-edit", function () {
    const user = $(this).data("user");
    $("#edit_user_id").val(user.user_id);
    $("#edit_first_name").val(user.first_name);
    $("#edit_middle_name").val(user.middle_name);
    $("#edit_last_name").val(user.last_name);
    $("#edit_contact_no").val(user.contact_no);
    $("#edit_email").val(user.email);
    $("#edit_role").val(user.role);
    $("#edit_status").val(user.status);
    new bootstrap.Modal(document.getElementById("editUserModal")).show();
  });

  // Edit user submit
  $(document).on("submit", "#editUserForm", function (e) {
    e.preventDefault();
    $.post("api/users_edit.php", $(this).serialize(), function (res) {
      if (res.ok) {
        bootstrap.Modal.getInstance(document.getElementById("editUserModal")).hide();
        fetchUsers();
      } else {
        alert(res.message || "Update failed");
      }
    }, "json");
  });

  // Delete user
  $(document).on("click", ".btn-delete", function () {
    const id = $(this).data("id");
    if (!confirm("Delete this user?")) return;
    $.getJSON("api/users_delete.php", { id }, function (res) {
      if (res.ok) {
        fetchUsers();
        alert("🗑️ User deleted successfully!");
      } else {
        alert(res.message || "❌ Delete failed");
      }
    });
  });

});
