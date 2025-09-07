<h2><i class="fa fa-ambulance"></i> Responders</h2>
<p>This will list MDRRMO responders.</p>

<table class="table table-bordered mt-3">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Responder ID</th>
      <th>Name</th>
      <th>Contact No</th>
      <th>Email</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody id="respondersTable"></tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $.ajax({
        url: "api/get_responders.php", // adjust path if needed
        method: "GET",
        dataType: "json",
        success: function(data) {
            let rows = "";
            if(data.length > 0){
                data.forEach(function(responder){
                    // Badge style for status
                    let statusBadge = responder.status === "active"
                        ? `<span class="badge bg-success rounded-pill px-3 py-2">Active</span>`
                        : `<span class="badge bg-danger rounded-pill px-3 py-2">Inactive</span>`;

                    rows += `
                        <tr>
                            <td>${responder.user_id}</td>
                            <td>${responder.responder_id ?? ''}</td>
                            <td>${responder.first_name} ${responder.last_name}</td>
                            <td>${responder.contact_no}</td>
                            <td>${responder.email}</td>
                            <td>${statusBadge}</td>
                        </tr>
                    `;
                });
            } else {
                rows = `<tr><td colspan="6" class="text-center">No responders found</td></tr>`;
            }
            $("#respondersTable").html(rows);
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", error);
        }
    });
});
</script>
