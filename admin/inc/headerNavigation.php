<header>
   <span>
    License: Jundel Single Developer License
    Copyright @2024 Jundel. All rights reserved
    This version (v1) is created by the use of NBI satellite office. You are free to use this software under the terms of the agreement provided by the author.</span>
   <div class="header-content">
      <?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Display the username on the dashboard as a clickable dropdown
    echo "<div class='dropdown'>
            <button class='dropbtn'>$username</button>
            <div class='dropdown-content'>
                <a href='manage'>My Account</a>
                <a href='logout' id='logout'>Logout</a>
            </div>
          </div>";
} else {
    // Redirect to login page if not logged in
    header("Location: index");
    exit();
}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.getElementById('logout').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default action
    swal({
        title: "Are you sure?",
        text: "You will be logged out of the system.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            window.location.href = this.getAttribute('href'); // Proceed with logout
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