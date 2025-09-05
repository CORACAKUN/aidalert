<div class="d-flex justify-content-between align-items-center mb-3">
  <h2><i class="fa fa-users"></i> Users</h2>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="fa fa-plus"></i> Add User
  </button>
</div>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Role</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="usersTableBody">
    <!-- JS will populate -->
  </tbody>
</table>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addUserForm" method="POST" action="api/users_add.php">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2"><label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="mb-2"><label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
          </div>
          <div class="mb-2"><label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <div class="mb-2"><label>Contact No</label>
            <input type="text" name="contact_no" class="form-control" required>
          </div>
          <div class="mb-2"><label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-2"><label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-2"><label>Role</label>
            <select name="role" class="form-control">
              <option value="resident">Resident</option>
              <option value="responder">Responder</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="mb-2"><label>Status</label>
            <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Modal (dynamic, filled by JS) -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editUserForm" method="POST" action="api/users_edit.php">
        <input type="hidden" name="user_id" id="edit_user_id">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2"><label>First Name</label>
            <input type="text" name="first_name" id="edit_first_name" class="form-control" required>
          </div>
          <div class="mb-2"><label>Middle Name</label>
            <input type="text" name="middle_name" id="edit_middle_name" class="form-control">
          </div>
          <div class="mb-2"><label>Last Name</label>
            <input type="text" name="last_name" id="edit_last_name" class="form-control" required>
          </div>
          <div class="mb-2"><label>Contact No</label>
            <input type="text" name="contact_no" id="edit_contact_no" class="form-control" required>
          </div>
          <div class="mb-2"><label>Email</label>
            <input type="email" name="email" id="edit_email" class="form-control" required>
          </div>
          <div class="mb-2"><label>Role</label>
            <select name="role" id="edit_role" class="form-control">
              <option value="resident">Resident</option>
              <option value="responder">Responder</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="mb-2"><label>Status</label>
            <select name="status" id="edit_status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
