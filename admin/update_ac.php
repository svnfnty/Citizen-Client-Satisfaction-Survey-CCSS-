<?php
require('config/dbconfig.php');

// Retrieve form data
$username = $_POST['username'];
$password = isset($_POST['password']) ? md5($_POST['password']) : null; // Hash password with MD5 if provided
$confirm_password = isset($_POST['confirm_password']) ? md5($_POST['confirm_password']) : null; // Hash confirm password with MD5 if provided

// Check if password fields are provided and not empty
if ($password !== null && $confirm_password !== null) {
    // Update user data in the database including password fields
    $stmt = $conn->prepare("UPDATE ccss_admin SET password = ? WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $password, $username);
        if ($stmt->execute()) {
            echo "Account updated successfully";
        } else {
            echo "Error executing SQL query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement: " . $conn->error;
    }
} else {
    // Update user data in the database without changing password fields
    $stmt = $conn->prepare("UPDATE ccss_admin SET username = ? WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $username, $username);
        if ($stmt->execute()) {
            echo "Account updated successfully";
        } else {
            echo "Error executing SQL query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement: " . $conn->error;
    }
}

$conn->close();
?>
