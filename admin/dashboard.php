<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body { overflow-x: hidden; }
    .sidebar {
      height: 100vh;
      width: 220px;
      position: fixed;
      top: 0; left: 0;
      background: #343a40;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 12px;
      text-decoration: none;
      transition: 0.3s;
    }
    .sidebar a:hover { background: #495057; }
    .content { margin-left: 220px; padding: 20px; }
  </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center text-white"><i class="fa fa-shield-alt"></i> AidAlert</h4>
  <a href="reports.php" class="nav-link"><i class="fa fa-bell"></i> Emergency Reports</a>
  <a href="users.php" class="nav-link"><i class="fa fa-users"></i> Users</a>
  <a href="responders.php" class="nav-link"><i class="fa fa-ambulance"></i> Responders</a>
  <a href="settings.php" class="nav-link"><i class="fa fa-cogs"></i> Settings</a>
  <a href="../logout.php" class="text-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content Area -->
<div class="content" id="content">
  <p>Loading reports...</p>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="maps.js"></script>
<script>
  $(document).ready(function () {
    // Auto-load reports.php when dashboard first opens
    $("#content").load("reports.php", function () {
        // Initialize the map immediately
        var map = L.map('map').setView([12.7036661, 123.9080896], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Load Bulan’s boundary GeoJSON
        $.getJSON("geojson/bulan_boundary.geojson", function (data) {
            var bulanBoundary = L.geoJSON(data, {
                style: {
                    color: "red",
                    weight: 2,
                    fillColor: "orange",
                    fillOpacity: 0.3
                }
            }).addTo(map);

            map.fitBounds(bulanBoundary.getBounds());
        });

        setTimeout(function () {
            map.invalidateSize();
        }, 200);
    });
});

</script>
</body>
</html>
