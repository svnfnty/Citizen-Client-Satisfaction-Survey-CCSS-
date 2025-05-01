
<div class="container">
<?php require('inc/genChart.php'); ?>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script>

    $(document).ready(function() {
    // Function to update chart container with data
    function updateChart(dateFrom, dateTo) {
        $.ajax({
            url: 'loadreportpn.php',
            type: 'GET',
            data: { date_from: dateFrom, date_to: dateTo },
            success: function(response) {
                    console.log(response); // Log the response
                    $('#chartContainer').html(response); // Update chart container with the response
                },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initial chart rendering
    updateChart('', '');

    // Add click event listener to the button
    $('#generateChartBtn').click(function() {
        var dateFrom = $('#date_from').val();
        var dateTo = $('#date_to').val();

        // Update chart container with the selected date range
        updateChart(dateFrom, dateTo);
    });
});

    </script>

</div>