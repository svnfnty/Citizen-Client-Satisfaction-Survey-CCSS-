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

.toggle-button {
        border: none;
        outline: none;
        background-color: revert-layer;
        cursor: pointer;
        padding: 10px 10px;
        font-size: 14px;
        margin-right: 10px;
        border-bottom: 2px solid transparent;
    }

    .toggle-button.active {
        border-bottom-color: black; /* Change this to the color you prefer */
    }

 /* CSS styles */
.feedback-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    outline: none;
    transition: background-color 0.3s ease;
}

.feedback-button.positive {
    background-color: #4CAF50; /* Green */
}

.feedback-button.negative {
    background-color: #f44336; /* Red */
}

.feedback-button:hover {
    opacity: 0.8;
}

.feedback-button.positive:hover {
    background-color: #45a049; /* Darker green */
}

.feedback-button.negative:hover {
    background-color: #d32f2f; /* Darker red */
}

.toggle-button.active {
    background-color: darkcyan; /* Change this to the color you prefer */
    color: black; /* Change this to the color you prefer */
}

   /* CSS for date filter inputs and button */
        .date-filter-container {
            margin-bottom: 10px;
        }

        .date-filter-label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .date-filter-input {
            width: 150px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        #filterBtn {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #filterBtn:hover {
            background-color: #45a049;
        }

        .filter-description {
            margin-top: 10px;
            font-style: italic;
            color: #555;
        }
</style>


<?php require('inc/sideNavigation.php'); ?>
<div class="content">

<header>
   <span>
    License: Jundel Single Developer License
    Copyright @2024 Jundel. All rights reserved
    This version (v1) is created by the use of NBI satellite office. You are free to use this software under the terms of the agreement provided by the author.</span>
   <div class="header-content">
      

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
    <div class="container">
        <h2>Feedback Management</h2>

          <div class="date-filter-container">
                <label class="date-filter-label" for="fromDate">From:</label>
                <input type="date" id="fromDate" name="fromDate" class="date-filter-input">
                <label class="date-filter-label" for="toDate">To:</label>
                <input type="date" id="toDate" name="toDate" class="date-filter-input">

                <button id="filterBtn" onclick="filterFeedbackData()">Apply Filter</button>
            </div>

            <div class="filter-description">
                This button will list all positive and negative feedback based on the specified date range.
            </div>
            <br>
        <button id="showPositiveBtn" class="toggle-button" onclick="loadFeedbackData(1)">Show ALL Positive Feedback</button>
        <button id="showNegativeBtn" class="toggle-button" onclick="loadFeedbackData(0)">Show ALL Negative Feedback</button>

       
        <br><br><br>
        <div class="welcome-message" id="feedbackContainer">
            Feedback data will be displayed here
        </div>
    </div>
</div>

<script>
   // Function to toggle the active state of the toggle buttons
function toggleActiveState(buttonId) {
    var buttons = document.querySelectorAll('.toggle-button');
    buttons.forEach(function(button) {
        if (button.id === buttonId) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });

}
// Function to reset the active state of toggle buttons
function resetActiveToggle() {
    toggleActiveState(null); // Pass null to remove active state from all buttons
}

// Function to filter feedback data based on date range
function filterFeedbackData() {
    var fromDate = document.getElementById("fromDate").value;
    var toDate = document.getElementById("toDate").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                document.getElementById("feedbackContainer").innerHTML = xhr.responseText;
                addFeedbackButtonListeners();
                resetActiveToggle(); // Reset the active toggle buttons
            } else {
                console.error("Error filtering feedback data");
            }
        }
    };
    xhr.open("GET", "load_feedback.php?fromDate=" + fromDate + "&toDate=" + toDate, true);
    xhr.send();
}

// Function to load feedback data
function loadFeedbackData(showPositive) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                document.getElementById("feedbackContainer").innerHTML = xhr.responseText;
                // Toggle active state for the clicked button
                toggleActiveState(showPositive === 1 ? 'showPositiveBtn' : 'showNegativeBtn');
                // Add event listeners for feedback buttons
                addFeedbackButtonListeners();
            } else {
                console.error("Error loading feedback data");
            }
        }
    };
    xhr.open("GET", "load_feedback.php?showPositive=" + showPositive, true);
    xhr.send();
}

// Function to add event listeners for feedback buttons
function addFeedbackButtonListeners() {
    var buttons = document.querySelectorAll('.feedback-button');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            var feedbackId = this.getAttribute('data-feedback-id');
            var newStatus = this.textContent === 'Positive' ? 0 : 1;
            // Send AJAX request to update feedback status
            updateFeedbackStatus(feedbackId, newStatus);
        });
    });
}

// Function to update feedback status in the database
function updateFeedbackStatus(feedbackId, newStatus) {
    swal({
        title: "Are you sure?",
        text: "You are about to change the feedback status.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willUpdate) => {
        if (willUpdate) {
            // Proceed with AJAX request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        swal("Success!", "Feedback status updated.", "success");
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        swal("Error!", "Failed to update feedback status.", "error");
                    }
                }
            };
            xhr.open("POST", "update_feedback.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("feedbackId=" + feedbackId + "&newStatus=" + newStatus);
        }
    });
}
</script>
</div>

</body>
</html>
