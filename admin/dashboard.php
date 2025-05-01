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

</style>

<body>


<?php require('inc/sideNavigation.php'); ?>


    <div class="content">
       <?php require('inc/headerNavigation.php'); ?>

        <div class="container">
                <h2>Welcome to the Dashboard</h2>
                
        <div class="welcome-message">
        
        <div class="dashboard-box">
                <div class="box-header">
                    <h3 class="box-title">Poor</h3>
                </div>
                <div class="box-body">
                    <div class="box-icon"><i class="fas fa-users"></i></div>
                    <div class="box-info">
                        <h4 class="box-info-title">Total Users</h4>
                        <p class="box-info-value" id="poorUsersCount">
                                <?php
                                require('config/dbconfig.php');

                                // Query to count users with description "Poor"
                                $query = "SELECT COUNT(*) AS poor_count
                                          FROM ccss_clients c
                                          LEFT JOIN ccss_ratings r ON c.id = r.client_id
                                          WHERE r.description = 'Poor'";

                                // Perform the query
                                $result = mysqli_query($conn, $query);

                                // Initialize count for Poor users
                                $poorCount = 0;

                                // Check if the query was successful
                                if ($result) {
                                    // Fetch the result row
                                    $row = mysqli_fetch_assoc($result);
                                    // Get the count of Poor users
                                    $poorCount = $row['poor_count'];
                                } else {
                                    // Query failed
                                    echo "Error: " . mysqli_error($conn);
                                }

                                // Close the connection
                                mysqli_close($conn);

                                // Display the count of Poor users
                                echo $poorCount;
                                ?>
                        </p>
                    </div>
                </div>
            </div>

        <div class="dashboard-box">
    <div class="box-header">
        <h3 class="box-title">Dissatisfied</h3>
    </div>
    <div class="box-body">
        <div class="box-icon"><i class="fas fa-users"></i></div>
        <div class="box-info">
            <h4 class="box-info-title">Total Users</h4>
            <p class="box-info-value" id="dissatisfiedUsersCount">
                <?php
                require('config/dbconfig.php');

                // Query to count users with description "Dissatisfied"
                $query = "SELECT COUNT(*) AS dissatisfied_count
                          FROM ccss_clients c
                          LEFT JOIN ccss_ratings r ON c.id = r.client_id
                          WHERE r.description = 'Dissatisfied'";

                // Perform the query
                $result = mysqli_query($conn, $query);

                // Initialize count for Dissatisfied users
                $dissatisfiedCount = 0;

                // Check if the query was successful
                if ($result) {
                    // Fetch the result row
                    $row = mysqli_fetch_assoc($result);
                    // Get the count of Dissatisfied users
                    $dissatisfiedCount = $row['dissatisfied_count'];
                } else {
                    // Query failed
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the connection
                mysqli_close($conn);

                // Display the count of Dissatisfied users
                echo $dissatisfiedCount;
                ?>
            </p>
        </div>
    </div>
</div>

       <div class="dashboard-box">
    <div class="box-header">
        <h3 class="box-title">Satisfied</h3>
    </div>
    <div class="box-body">
        <div class="box-icon"><i class="fas fa-users"></i></div>
        <div class="box-info">
            <h4 class="box-info-title">Total Users</h4>
            <p class="box-info-value" id="satisfiedUsersCount">
                <?php
                require('config/dbconfig.php');

                // Query to count users with description "Satisfied"
                $query = "SELECT COUNT(*) AS satisfied_count
                          FROM ccss_clients c
                          LEFT JOIN ccss_ratings r ON c.id = r.client_id
                          WHERE r.description = 'Satisfied'";

                // Perform the query
                $result = mysqli_query($conn, $query);

                // Initialize count for Satisfied users
                $satisfiedCount = 0;

                // Check if the query was successful
                if ($result) {
                    // Fetch the result row
                    $row = mysqli_fetch_assoc($result);
                    // Get the count of Satisfied users
                    $satisfiedCount = $row['satisfied_count'];
                } else {
                    // Query failed
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the connection
                mysqli_close($conn);

                // Display the count of Satisfied users
                echo $satisfiedCount;
                ?>
            </p>
        </div>
    </div>
</div>

       <div class="dashboard-box">
    <div class="box-header">
        <h3 class="box-title">Very Satisfied</h3>
    </div>
    <div class="box-body">
        <div class="box-icon"><i class="fas fa-users"></i></div>
        <div class="box-info">
            <h4 class="box-info-title">Total Users</h4>
            <p class="box-info-value" id="verySatisfiedUsersCount">
                <?php
                require('config/dbconfig.php');

                // Query to count users with description "Very Satisfied"
                $query = "SELECT COUNT(*) AS very_satisfied_count
                          FROM ccss_clients c
                          LEFT JOIN ccss_ratings r ON c.id = r.client_id
                          WHERE r.description = 'Very Satisfied'";

                // Perform the query
                $result = mysqli_query($conn, $query);

                // Initialize count for Very Satisfied users
                $verySatisfiedCount = 0;

                // Check if the query was successful
                if ($result) {
                    // Fetch the result row
                    $row = mysqli_fetch_assoc($result);
                    // Get the count of Very Satisfied users
                    $verySatisfiedCount = $row['very_satisfied_count'];
                } else {
                    // Query failed
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the connection
                mysqli_close($conn);

                // Display the count of Very Satisfied users
                echo $verySatisfiedCount;
                ?>
            </p>
        </div>
    </div>
</div>

        <div class="dashboard-box">
    <div class="box-header">
        <h3 class="box-title">Excellent</h3>
    </div>
    <div class="box-body">
        <div class="box-icon"><i class="fas fa-users"></i></div>
        <div class="box-info">
            <h4 class="box-info-title">Total Users</h4>
            <p class="box-info-value" id="excellentUsersCount">
                <?php
                require('config/dbconfig.php');

                // Query to count users with description "Excellent"
                $query = "SELECT COUNT(*) AS excellent_count
                          FROM ccss_clients c
                          LEFT JOIN ccss_ratings r ON c.id = r.client_id
                          WHERE r.description = 'Excellent'";

                // Perform the query
                $result = mysqli_query($conn, $query);

                // Initialize count for Excellent users
                $excellentCount = 0;

                // Check if the query was successful
                if ($result) {
                    // Fetch the result row
                    $row = mysqli_fetch_assoc($result);
                    // Get the count of Excellent users
                    $excellentCount = $row['excellent_count'];
                } else {
                    // Query failed
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the connection
                mysqli_close($conn);

                // Display the count of Excellent users
                echo $excellentCount;
                ?>
            </p>
        </div>
    </div>
</div>

    </div>
                  <div class="welcome-message "> 
                  <!--Div for our chart -->
                 <div id="chart" style="width: 500px; height: 350px;"></div> 
                 <div id="chartContainer" style="height: 350px; width: 500px;"></div>
                    
                 </div>
                  
                    </div>
                
            

            </div>

    </div>
<style>
 .welcome-message {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap;
    overflow-x: auto;
}

.dashboard-box {
    flex: 0 0 18%;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-right: 20px; /* Margin between boxes */
    transition: all 0.3s ease;
}

.dashboard-box:last-child {
    margin-right: 0; /* Remove margin from the last box */
}

.box-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.box-title {
    margin: 0;
    font-size: 18px;
}

.box-body {
    display: flex;
    align-items: center;
}

.box-icon {
    flex: 0 0 auto;
    font-size: 30px;
    color: #007bff;
    margin-right: 15px;
}

.box-info {
    flex: 1 1 auto;
}

.box-info-title {
    margin: 0;
    font-size: 16px;
}

.box-info-value {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
}

</style>





 <?php  
 require('config/dbconfig.php');
 $query = "SELECT description, count(*) as number FROM ccss_ratings GROUP BY description";  
 $result = mysqli_query($conn, $query);  
 ?>  
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('visualization', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Ratings', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["description"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Ratings in Clients',  
                      is3D:true,  
                      pieHole: 0.1  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
</script> 

 <?php
require('config/dbconfig.php');
$query = "SELECT DATE_FORMAT(date_created, '%M') AS month, COUNT(*) AS client_count FROM ccss_clients GROUP BY MONTH(date_created)";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Handle the error, e.g., display an error message
    echo "Error: " . mysqli_error($conn);
} else {
    // Create an array to store the data
    $clientData = array();

    // Loop through the result set and populate the array
    while ($row = mysqli_fetch_assoc($result)) {
        $month = $row['month'];
        $clientCount = (int)$row['client_count'];
        $clientData[] = array($month, $clientCount);
    }
}
?>
        <script type="text/javascript">
            //load the Google Visualization API and the chart 
            google.load('visualization', {'packages': ['columnchart']});
            //set callback 
            google.setOnLoadCallback (createChart);
            //callback function 
            function createChart() {
                //create data table object 
                var dataTable = new google.visualization.DataTable();
                //define columns 
                dataTable.addColumn('string','Quarters 2009');
                dataTable.addColumn('number', 'Clients');
                //define rows of data 
                // Add data fetched from PHP
                var clientData = <?php echo json_encode($clientData); ?>;
                // Add data to the data table
                dataTable.addRows(clientData);
                //instantiate our chart object 
                var chart = new google.visualization.ColumnChart (document.getElementById('chart'));
                //define options for visualization 
                var options = {width: 500, height: 350, is3D: true, title: 'Total Client Survey'};
                //draw our chart 
                chart.draw(dataTable, options);
            }
        </script>

     <?php
require('config/dbconfig.php');

$query = "SELECT description, COUNT(*) AS number FROM ccss_ratings GROUP BY description";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Handle the error, e.g., display an error message
    echo "Error: " . mysqli_error($conn);
} else {
    // Create an array to store the data
    $ratingData = array();

    // Loop through the result set and populate the array
    while ($row = mysqli_fetch_assoc($result)) {
        $description = $row['description'];
        $number = (int)$row['number'];
        $ratingData[] = array("label" => $description, "y" => $number);
    }
}
?>
<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title: {
            text: "Rating Distribution"
        },
        data: [{
            type: "pie",
            showInLegend: true,
            legendText: "{label}",
            indexLabel: "{label} - #percent%",
            dataPoints: <?php echo json_encode($ratingData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>
</body>

</html>
