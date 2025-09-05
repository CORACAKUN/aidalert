<?php
include "../../db_connect.php";
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id      = (int) $_POST['user_id'];
    $first   = $conn->real_escape_string($_POST['first_name']);
    $middle  = $conn->real_escape_string($_POST['middle_name']);
    $last    = $conn->real_escape_string($_POST['last_name']);
    $contact = $conn->real_escape_string($_POST['contact_no']);
    $email   = $conn->real_escape_string($_POST['email']);
    $role    = $conn->real_escape_string($_POST['role']);
    $status  = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE users 
            SET first_name='$first', middle_name='$middle', last_name='$last',
                contact_no='$contact', email='$email', role='$role', status='$status',
                updated_at = NOW()
            WHERE user_id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["ok" => true, "message" => "✅ User updated successfully"]);
    } else {
        echo json_encode(["ok" => false, "message" => "❌ Error: " . $conn->error]);
    }
}
?>
