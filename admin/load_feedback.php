<?php
// Assuming you have already established a database connection
require('config/dbconfig.php');

// Get the parameter indicating whether to show positive or negative feedback
$showPositive = isset($_GET['showPositive']) ? $_GET['showPositive'] : null;
$fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : null;
$toDate = isset($_GET['toDate']) ? $_GET['toDate'] : null;

$sql = "SELECT c.id, c.description, c.status, c.date_created, u.name, u.email FROM ";

if ($showPositive === null) {
    $sql .= "(SELECT id, client_id, description, status, date_created FROM ccss_comments) AS c";
} else {
    $sql .= "(SELECT id, client_id, description, status, date_created FROM ccss_comments WHERE status = $showPositive) AS c";
}

$sql .= " LEFT JOIN ccss_clients u ON c.client_id = u.id"; // Join with the ccss_clients table using client_id

$sql .= " WHERE c.description IS NOT NULL AND c.description <> ''"; // Filter out empty descriptions

// Apply date filters if provided
if ($fromDate !== null && $toDate !== null) {
    $sql .= " AND c.date_created BETWEEN '$fromDate' AND '$toDate'";
}

$sql .= " ORDER BY c.id DESC"; // Apply ORDER BY to the outer query

$result = $conn->query($sql);

// Check for errors
if ($result === false) {
    echo "Error executing query: " . $conn->error;
} else {
    // Proceed if query executed successfully
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Date</th><th>User</th><th>Email</th><th>Description</th><th>Feedback</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['date_created'] . "</td>";
            echo "<td>" . $row['name'] . "</td>"; // Display user's name
            echo "<td>" . $row['email'] . "</td>"; // Display user's email
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>";
            // Add a class to the button based on feedback status
            $buttonClass = $row['status'] == 1 ? "positive" : "negative";
            echo '<button class="feedback-button ' . $buttonClass . '" data-feedback-id="' . $row['id'] . '" title="' . ($row['status'] == 1 ? "Click to mark this   feedback as Negative" : "Click to mark this feedback as Positive") . '">' . ($row['status'] == 1 ? "Positive" : "Negative") . '</button>';
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No feedback available.";
    }
}

// Close the database connection
$conn->close();
?>