<?php
include "../../db_connect.php";

header('Content-Type: application/json');

$result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);