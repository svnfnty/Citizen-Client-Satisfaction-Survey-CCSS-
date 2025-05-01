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
    <h2>User Management</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('config/dbconfig.php');

                // Query to select all users from the ccss_admin table
                $query = "SELECT * FROM ccss_admin WHERE status = '1'";

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
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            // Adding action buttons for editing and deleting
                            echo "<td>";
                            echo "<button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row['id'] . ")'>block</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No users found
                        echo "<tr><td colspan='4'>No users found.</td></tr>";
                    }
                } else {
                    // Query failed
                    echo "<tr><td colspan='4'>Error: " . mysqli_error($conn) . "</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>
<style>
/* Popup style */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Modal content */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    border-radius: 8px; /* Add border radius for a softer look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add box shadow for depth */
}

/* Close button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form fields */
#editForm label {
    margin-bottom: 8px; /* Add spacing below labels */
    display: block; /* Ensure labels appear on a new line */
    font-weight: bold; /* Make labels stand out */
}

#editForm input[type="text"],
#editForm input[type="password"] {
    width: 100%; /* Make inputs fill the entire width */
    padding: 8px; /* Add padding for better appearance */
    margin-bottom: 16px; /* Add spacing below inputs */
    border-radius: 4px; /* Add border radius for a softer look */
    border: 1px solid #ccc; /* Add border for clarity */
}

#editForm button[type="submit"] {
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#editForm button[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
}

</style>

<!-- Add this HTML for the edit popup -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit User</h2>
        <form id="editForm">
            <input type="hidden" id="editUserId" name="userId">
            <label for="editUsername">Username:</label>
            <input type="text" id="editUsername" name="username">
            <label for="editPassword">Password:</label>
            <input type="password" id="editPassword" name="password">
            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>
  $(document).ready(function() {
    // When edit button is clicked, fetch data and show edit popup
    $('.btn.btn-primary').click(function() {
        var userId = $(this).closest('tr').find('td:eq(0)').text(); // Get user ID from the table row
        $.ajax({
            url: 'fetch_user.php',
            type: 'POST',
            data: { userId: userId },
            success: function(response) {
                var data = JSON.parse(response);
                if(data.error) {
                    console.error(data.error);
                } else {
                    $('#editUserId').val(data.id);
                    $('#editUsername').val(data.username);
                    $('#editPassword').val(data.password);
                    $('#editModal').show();
                }
            } // Added closing parenthesis here
        });
    });

    // Close the edit popup when the close button is clicked
    $('.close').click(function() {
        $('#editModal').hide();
    });

    // Submit edited data via AJAX
    $('#editForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'edit_user.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Handle success, maybe update UI or close popup
                $('#editModal').hide();
                // Reload the table to reflect changes
                // You can implement this or update the table row directly
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

function deleteUser(userId) {
    swal({
        title: "Are you sure?",
        text: "This action will permanently delete the user.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { userId: userId },
                success: function(response) {
                    swal("Deleted!", "User has been deleted.", "success").then(() => {
                        location.reload(); // Reload the page to reflect changes
                    });
                },
                error: function() {
                    swal("Error!", "Failed to delete user.", "error");
                }
            });
        }
    });
}
</script>


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
