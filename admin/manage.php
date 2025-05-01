<?php

require('config/dbconfig.php');
// Fetch user data from the database
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT username, password, confirm_password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists in the database
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $password = $row['password'];
        $confirm_password = $row['confirm_password'];
    } else {
        // Handle case where user does not exist in the database
        $password = '';
        $confirm_password = '';
    }
} else {
    // Handle case where username is not set in session
    $username = '';
    $password = '';
    $confirm_password = '';
}
?>

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
    <style>
        /* Additional CSS for form styling */
        .container {
            max-width: 600px;
            margin: 1 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php require('inc/sideNavigation.php'); ?>
    <div class="content">
        <?php require('inc/headerNavigation.php'); ?>
        <div class="container">
        <!-- Main content area -->
        <h2>My Account Management</h2>
        <form id="accountForm" action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>">
            <button type="button" onclick="updateAccount()">Update Account</button>
        </form>
    </div>
    </div>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateAccount() {
            var formData = $('#accountForm').serialize(); // Serialize form data
            $.ajax({
                type: 'POST',
                url: 'update_ac.php',
                data: formData,
                success: function(response) {
                    alert(response); // Alert the response from the server
                    // You can add further handling here, such as updating UI elements
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors to the console
                    alert("Error updating account. Please try again."); // Alert the user about the error
                }
            });
        }
        </script>

</body>
</html>
