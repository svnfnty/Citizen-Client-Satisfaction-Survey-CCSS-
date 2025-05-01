<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Citizen/Client Satisfaction Survey</title>
    <link rel="icon" href="images/merchant-nbi.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/table.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php require('inc/sideNavigation.php'); ?>
    <div class="content">
       <?php require('inc/headerNavigation.php'); ?>

<div class="container">
    <!-- Main content area -->
    <h2>Clients Survey</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Ratings</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
             <?php
require('config/dbconfig.php');

// Query to select clients along with their corresponding ratings descriptions
$query = "SELECT c.id, c.date_created, c.email, c.name, c.contact, r.description
          FROM ccss_clients c
          LEFT JOIN ccss_ratings r ON c.id = r.client_id";

// Perform the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and echo user details in table rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['date_created'] . "</td>";
            // Adding action buttons for editing and deleting
            echo "</tr>";
        }
    } else {
        // No users found
        echo "<tr><td colspan='7'>No users found.</td></tr>";
    }
} else {
    // Query failed
    echo "<tr><td colspan='7'>Error: " . mysqli_error($conn) . "</td></tr>";
}

// Close the connection
mysqli_close($conn);
?>


            </tbody>
        </table>
    </div>
</div>

</div>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include any additional scripts here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        // Add 'active' class to the active link in the sidebar
        $(document).ready(function() {
            $('.sidebar ul li a').each(function() {
                if ($(this).attr('href') == window.location.pathname) {
                    $(this).addClass('active');
                }
            });
        });
    </script>

</body>

</html>
