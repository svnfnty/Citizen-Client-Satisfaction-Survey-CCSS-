<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Citizen/Client Satisfaction Survey</title>
    <link rel="icon" href="images/merchant-nbi.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        /* CSS for logo and office name */
        .header {
            text-align: center;
            margin-bottom: 0px;
        }

        .logo {
            width: 100px; /* Adjust as needed */
            height: auto;
        }

        .office-name {
            font-size: 14px; /* Adjust as needed */
            font-weight: bold;
            margin-top: 0px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <form class="survey-form" id="login" method="post">
        <div class="header">
            <img src="images/merchant-nbi.png" alt="NBI Logo" class="logo">
            <div class="office-name">NATIONAL BUREAU OF INVESTIGATION <br> GINGOOG CITY SATELLITE OFFICE</div>
        </div>
        <center><h1>ADMINISTRATION (CCSS)</h1></center>

        <div class="steps">
            <div class="step"></div>
            <div class="step current"></div>
            <div class="step"></div>
        </div></br>

        <center><div class="error-message" id="error-message"></div> </center>

        <div class="fields">
            <label for="name">Username</label>
            <div class="field">
                <i class="fas fa-user"></i>
                <input id="name" type="text" name="username" placeholder="Your Username">
            </div>
            <label for="contact">Password</label>
            <div class="field">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password" placeholder="Your Password">
            </div>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    
    <script>
        $(document).ready(function () {
            // Function to handle form submission via AJAX
            $('#login').submit(function (e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize();

                // Perform AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'config/config.php', // Verify if this is the correct URL
                    data: formData,
                    success: function (response) {
                        // Check the response
                        if (response.trim() === "Login successful!") {
                                                                                 swal({
                                      text: "Login successful!",
                                      icon: "success",
                                      buttons: false,
                                      timer: 1000 // Set the timer to automatically close the alert after 1.5 seconds
                                    }).then(() => {
                                      window.location.href = "/ccss/admin/dashboard"; // Redirect to the dashboard page
                                    });

                        } else {
                            // Display error message for incorrect username or password
                            $('#error-message').html(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });

            });
        });
    </script>

</body>

</html>
