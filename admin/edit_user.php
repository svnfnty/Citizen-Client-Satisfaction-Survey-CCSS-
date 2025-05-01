<?php
require('config/dbconfig.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password with MD5
    
    // Update user data in the database
    $query = "UPDATE ccss_admin SET username = '$username', password = '$password' WHERE id = $userId";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>

