<?php
require('dbconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST["date"];
    $name = isset($_POST["name"]) ? $_POST["name"] : ""; // Name is optional
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $comments = $_POST["comments"];

    // Sanitize inputs to prevent SQL injection
    $date = mysqli_real_escape_string($conn, $date);
    $name = mysqli_real_escape_string($conn, $name);
    $contact = mysqli_real_escape_string($conn, $contact);
    $email = mysqli_real_escape_string($conn, $email);
    $rating = mysqli_real_escape_string($conn, $rating);
    $comments = mysqli_real_escape_string($conn, $comments);

    // Insert data into ccss_clients table
    $sql = "INSERT INTO ccss_clients (date_created, name, contact, email) VALUES ('$date', '$name', '$contact', '$email')";
    if ($conn->query($sql) === TRUE) {
        $client_id = $conn->insert_id; // Get the last inserted ID

        // Insert data into ccss_comments table
        $sql = "INSERT INTO ccss_comments (client_id, description, status, date_created) VALUES ('$client_id', '$comments', '1', '$date')";
        $conn->query($sql);

        // Insert data into ccss_ratings table (assuming similar structure as comments)
        $sql = "INSERT INTO ccss_ratings (client_id, description, status, date_created) VALUES ('$client_id', '$rating', '1', '$date')";
        $conn->query($sql);

        // Return success message
        echo "Thanks for your feedback!";
    } else {
        // Return error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
