// $(document).on("click", "a.nav-link", function (e) {
//     e.preventDefault();
//     var page = $(this).attr("href");

//     $("#content").load(page, function () {
//         if (page.includes("reports.php")) {
//             // Initialize map once reports.php is loaded
//             var map = L.map('map').setView([12.7036661, 123.9080896], 12);

//             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                 maxZoom: 19,
//                 attribution: '© OpenStreetMap contributors'
//             }).addTo(map);

//             // Load real boundary GeoJSON
//             $.getJSON("geojson/bulan_boundary.geojson", function(data) {
//                 var bulanBoundary = L.geoJSON(data, {
//                     style: {
//                         color: "red",
//                         weight: 2,
//                         fillColor: "orange",
//                         fillOpacity: 0.3
//                     }
//                 }).addTo(map);

//                 // Auto-zoom to fit Bulan’s boundary
//                 map.fitBounds(bulanBoundary.getBounds());
//             });

//             // Fix rendering bug
//             setTimeout(function () {
//                 map.invalidateSize();
//             }, 200);
//         }
//     });
// });

