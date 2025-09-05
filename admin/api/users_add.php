<?php
include "../../db_connect.php";
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first   = $conn->real_escape_string($_POST['first_name']);
    $middle  = $conn->real_escape_string($_POST['middle_name']);
    $last    = $conn->real_escape_string($_POST['last_name']);
    $contact = $conn->real_escape_string($_POST['contact_no']);
    $email   = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role    = $conn->real_escape_string($_POST['role']);
    $status  = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO users 
            (first_name, middle_name, last_name, contact_no, email, password, role, status, created_at, updated_at)
            VALUES ('$first','$middle','$last','$contact','$email','$password','$role','$status', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["ok" => true, "message" => "✅ User added successfully"]);
    } else {
        echo json_encode(["ok" => false, "message" => "❌ Error: " . $conn->error]);
    }
}
?>
