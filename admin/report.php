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
    <script src="https://cdn.canvasjs.com/ga/canvasjs.stock.min.js"></script>   
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

/* Button Styles */
#exportButton {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 10px;
  transition-duration: 0.4s;
}

#exportButton:hover {
  background-color: #45a049; /* Darker Green */
}

.openPage {
  background-color: #4267B2; /* Facebook's primary blue */
  color: #fff; /* White text */
  padding: 10px 20px; /* Padding for better readability and clickability */
  border: none; /* No border */
  border-radius: 5px; /* Rounded corners */
  cursor: pointer; /* Show pointer cursor on hover */
  margin: 5px; /* Some margin for spacing */
  font-size: 13px; /* Font size */
  transition: background-color 0.3s; /* Smooth transition for background color change */
}

.openPage:hover {
  background-color: #3b5998; /* Darker shade of blue on hover */
}

</style>

<body id="print">
    <?php require('inc/sideNavigation.php'); ?>
    <div class="content">

<header>
   <span>
    License: Jundel Single Developer License
    Copyright @2024 Jundel. All rights reserved
    This version (v1) is created by the use of NBI satellite office. You are free to use this software under the terms of the agreement provided by the author.</span>
   <div class="header-content">
     
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.getElementById('logout').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent the default action of the link
    swal("Are you sure you want to logout?", {
        buttons: ["Oh noez!", true],
    }).then((value) => {
        if (value) {
            window.location.href = this.getAttribute('href'); // Proceed with logout if confirmed
        }
    });
});
</script>

    </div>
</header>
<style>/* Style the dropdown button */
.dropbtn {
  background-color: #f1f1f1;
  color: black;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
  float: left;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 117px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #ddd;}

/* Media Query for laptops */
@media only screen and (max-width: 1024px) {
  .header-content {
    float: left; /* Align the header content to the left side */
  }
}

</style>
    <div class="container" >
    <button class="openPage" data-url="reports.php">Summary</button>
    <button class="openPage" data-url="reports_pn.php">Per Feedback</button>
    <button class="openPage" data-url="reports_pu.php">Per User</button>
    


    <div id="pageContent">
        <br></br>
        <div class="welcome-message">Report data will be displayed here</div>
    </div>

    <script>
        $(document).ready(function(){
            $(".openPage").click(function(){
                var pageUrl = $(this).data("url");
                $.ajax({
                    url: pageUrl,
                    success: function(result){
                        $("#pageContent").html(result);
                    }
                });
            });
        });
    </script>
</br></br></br>
</br>
        </div>
    </div>

</body>
</html>
