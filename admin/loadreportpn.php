<?php
if(isset($_GET['date_from']) && isset($_GET['date_to'])) {
    $dateFrom = $_GET['date_from'];
    $dateTo = $_GET['date_to'];

    // Include the database configuration file
    require('config/dbconfig.php');

    // Function to fetch counts of positive and negative feedback for each day
    function getFeedbackCounts($dateFrom, $dateTo, $conn) {
        $feedbackCounts = array();

        $currentDate = $dateFrom;
        while (strtotime($currentDate) <= strtotime($dateTo)) {
            $query = "SELECT 
                        SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS positiveCount,
                        SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS negativeCount
                      FROM ccss_comments 
                      WHERE date_created = '$currentDate'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $feedbackCounts[$currentDate] = array(
                'positiveCount' => intval($row['positiveCount']),
                'negativeCount' => intval($row['negativeCount'])
            );

            // Move to the next day
            $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
        }

        return $feedbackCounts;
    }

    // Get counts of positive and negative feedback for each day
    $feedbackCounts = getFeedbackCounts($dateFrom, $dateTo, $conn);

    // Debug: Echo the feedback counts
    echo "<pre>";
    print_r($feedbackCounts);
    echo "</pre>";

    // Render the chart using the feedback counts
    echo generateChart($feedbackCounts);
} else {
    echo "Error: Date range not provided.";
}

// Function to generate chart HTML
function generateChart($feedbackCounts) {
    // Prepare data points for positive and negative feedback
    $dataPointsPositive = array();
    $dataPointsNegative = array();
    foreach ($feedbackCounts as $date => $counts) {
        $dataPointsPositive[] = array('label' => $date, 'y' => $counts['positiveCount']);
        $dataPointsNegative[] = array('label' => $date, 'y' => $counts['negativeCount']);
    }

    // Return the HTML content for the chart
    return "
<script>
    var chart = new CanvasJS.Chart('chartContainer', {
        animationEnabled: true,
        theme: 'light2',
        title: {
            text: 'Positive and Negative Feedback'
        },
        axisY: {
            includeZero: true
        },
        legend: {
            cursor: 'pointer',
            verticalAlign: 'center',
            horizontalAlign: 'right',
            itemclick: toggleDataSeries
        },
        data: [{
            type: 'column',
            name: 'Positive',
            indexLabel: '{y}',
            yValueFormatString: '#',
            showInLegend: true,
            dataPoints: " . json_encode($dataPointsPositive) . "
        }, {
            type: 'column',
            name: 'Negative',
            indexLabel: '{y}',
            yValueFormatString: '#',
            showInLegend: true,
            dataPoints: " . json_encode($dataPointsNegative) . "
        }]
    });

    chart.render();

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === 'undefined' || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
</script>
";
}
?>
