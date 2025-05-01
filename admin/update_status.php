<?php
require('config/dbconfig.php'); // Assuming this file contains your database connection settings

// Get the ID and new status of the feedback
$feedbackId = isset($_GET['id']) ? $_GET['id'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

if ($feedbackId !== null && $status !== null) {
    // Update the status of feedback in the database
    $sql = "UPDATE ccss_comments SET status = $status WHERE id = $feedbackId";
    $result = $conn->query($sql);

    // Check for errors
    if ($result === false) {
        echo "Error updating feedback status: " . $conn->error;
    }
}

$conn->close();
?>
