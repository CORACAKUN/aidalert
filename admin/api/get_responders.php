<?php
include "../../db_connect.php";

header("Content-Type: application/json");

$sql = "SELECT user_id, responder_id, first_name, last_name, contact_no, email, status 
        FROM users 
        WHERE role = 'responder'";

$result = $conn->query($sql);

$responders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $responders[] = $row;
    }
}

echo json_encode($responders);
