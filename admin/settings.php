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
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    /* CSS for sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
            border-bottom: 1px solid #555; /* Add border to each list item */
        }

        .sidebar ul li:last-child {
            border-bottom: none; /* Remove border from the last list item */
        }

        .sidebar ul li a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        .logo {
            text-align: center; /* Center the logo horizontally */
        }

        .logo img {
            width: 150px; /* Set the width of the logo */
            height: auto; /* Maintain aspect ratio */
            display: block; /* Ensure proper spacing */
            margin: 0 auto 0px; /* Center the logo vertically and add some space below */
        }
        
/* CSS for content */
.content {
    margin-left: 250px; /* Adjust this value based on the width of the sidebar */
}

header {
    background-color: #ddd;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content span {
    margin-right: 20px;
}

.logout-btn {
    background-color: #f44336;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
}

.logout-btn:hover {
    background-color: #d32f2f;
}


.logo {
    text-align: center; /* Center the logo horizontally */
}

.logo img {
    width: 150px; /* Set the width of the logo */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Ensure proper spacing */
    margin: 0 auto 0px; /* Center the logo vertically and add some space below */
}

</style>

<body>

<?php require('inc/sideNavigation.php'); ?>

    <div class="content">
        <?php require('inc/headerNavigation.php'); ?>
        <div class="container">
            <!-- Main content area -->
            <h2>Settings</h2>
            <p>This is the settings page content. You can manage settings here.</p>
        </div>
    </div>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include any additional scripts here -->

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
