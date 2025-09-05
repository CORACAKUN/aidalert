<?php
include "../../db_connect.php";
header("Content-Type: application/json");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM users WHERE user_id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["ok" => true, "message" => "User deleted successfully"]);
    } else {
        echo json_encode(["ok" => false, "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["ok" => false, "message" => "No ID provided"]);
}
?>
