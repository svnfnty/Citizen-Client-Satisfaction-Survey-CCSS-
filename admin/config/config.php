<?php
require('dbconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize username to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);

    // Hash the password using a secure hashing algorithm like bcrypt
    // Note: MD5 is not recommended for password hashing due to its insecurity
    $hashed_password = md5($password);

    // Check if the user exists in the ccss_admin table
    $sql = "SELECT * FROM ccss_admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password using a secure method like password_verify for bcrypt
        if (md5($password) === $user['password']) {
            // Authentication successful
            session_start();
            $_SESSION['username'] = $username;
            echo "Login successful!";
            // Here you can redirect the user to another page or perform any other actions
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User does not exist
        echo "User not found. Please check your username.";
    }
}

// Close connection
$conn->close();
?>
