<?php
if(isset($_GET['date_from']) && isset($_GET['date_to'])) {
    $dateFrom = $_GET['date_from'];
    $dateTo = $_GET['date_to'];

    function generateDailyDataPoints($dateFrom, $dateTo) {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ccss_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $startDate = new DateTime($dateFrom);
        $endDate = new DateTime($dateTo);
        $interval = new DateInterval('P1D'); // 1 day interval

        $dataPoints = array();

        // Iterate over each day within the date range
        $currentDate = clone $startDate; // clone startDate to avoid modifying it
        while ($currentDate <= $endDate) {
            // Format the current date
            $formattedDate = $currentDate->format('Y-m-d');

            // Execute SQL query to count data for the current day
            $sql = "SELECT COUNT(id) AS count FROM ccss_clients WHERE date_Created = '$formattedDate'";
            $result = $conn->query($sql);

            // Fetch the result
            if ($result !== false) {
                $row = $result->fetch_assoc();
                $count = $row['count'];
            } else {
                // Handle query error
                echo "Error executing SQL: " . $conn->error;
                $count = 0; // No records found for the current day
            }
                $count = intval($count); // Convert count to integer

                // Add data point to array
                $dataPoints[] = array("label" => $formattedDate, "y" => $count);

            // Move to the next day
            $currentDate->add($interval);
        }

        // Close connection
        $conn->close();

        return $dataPoints;
    }

    $dataPoints = generateDailyDataPoints($dateFrom, $dateTo);

    // Debug: Echo the data points
    echo "<pre>";
    print_r($dataPoints);
    echo "</pre>";

    echo generateChart($dataPoints);
} else {
    echo "Error: Date range not provided.";
}

function generateChart($dataPoints) {
    // Encode data points array to JSON
    $chartJSON = json_encode($dataPoints);

    // Return the HTML content for the chart
    return "
    <script>
        var chart = new CanvasJS.Chart('chartContainer', {
            animationEnabled: true,
            title: {
                text: 'NBI Entries - Daily Level'
            },
            axisX: {
                title: 'Date'
            },
            axisY: {
                title: 'Entries'
            },
            data: [{
                type: 'line',
                dataPoints: $chartJSON
            }]
        });
        chart.render();
    </script>";
}
?>
