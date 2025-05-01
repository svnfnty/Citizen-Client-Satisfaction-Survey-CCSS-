     
     <div class="container">
     <?php
require('config/dbconfig.php');

// Query to fetch data from all three tables joined together
$query = "SELECT ccss_clients.date_created AS client_date, ccss_clients.name AS customer_name,
                 ccss_ratings.description AS rating_description, ccss_ratings.status AS rating_status,
                 ccss_comments.description AS comment_description, ccss_comments.status AS comment_status,
                 ccss_clients.contact, ccss_clients.email
          FROM ccss_clients
          LEFT JOIN ccss_ratings ON ccss_clients.id = ccss_ratings.client_id
          LEFT JOIN ccss_comments ON ccss_clients.id = ccss_comments.client_id";

$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Output table header
    echo "<table id='dataTable' border='1'>";
    echo "<thead>";
    echo "<tr><th colspan='5' style='text-align: center; background-color: transparent; border: none;'>NATIONAL BUREAU OF INVESTIGATION</th></tr>";
    echo "<tr><th colspan='5' style='text-align: center; background-color: transparent; border: none;'>NORTHEASTHERN MINDANAO REGIONAL OFFICE</th></tr>";
    echo "<tr><th colspan='5' style='text-align: center; background-color: transparent; border: none;'>CITIZEN/CLIENT SATISFACTION SURVEY (CCSS) SUMMARY</th></tr>";
    echo "<tr><th colspan='5' style='text-align: center; background-color: transparent; border: none;'></th></tr>";
    echo "<tr>
            <th style='text-align: center;'>Date</th>
            <th style='text-align: center;'>Ratar (Customer/Client)</th>
            <th style='text-align: center;'>RATINGS</th>
            <th style='text-align: center;'>Contact Number / Email Address</th>
            <th style='text-align: center;'>Remarks</th>
            <th style='text-align: center;'>Analysis</th>
          </tr>";
    echo "</thead>";
    echo "<tbody>";
// Loop through the result set and output table rows
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row["client_date"]."</td>";
    echo "<td>".$row["customer_name"]."</td>";
    echo "<td>".$row["rating_description"]."</td>";
    echo "<td>".$row["contact"]." / ".$row["email"]."</td>";
    echo "<td>".$row["comment_description"]."</td>";
    echo "<td>";
    if ($row["comment_status"] == 1) {
        echo "Positive";
    } else {
        echo "Negative";
    }
    echo "</td>";
    echo "</tr>";
}


    // Close tbody and table
    echo "</tbody></table>";
} else {
    // Handle the error, e.g., display an error message
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
    </div>

</br>
            <button id="exportButton">Export to Excel</button>
        </div>
    </div><!-- Include SheetJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    // Export table data to Excel
    $("#exportButton").click(function() {
        // Display SweetAlert message indicating that the report is generated
        swal({
            title: "Report Generated",
            text: "Your report has been generated. Do you want to download the file?",
            icon: "success",
            buttons: {
                cancel: "No",
                confirm: "Yes",
            },
        }).then(function(isConfirmed) {
            // Inside this function, the user has clicked either "OK" or "Cancel" on the SweetAlert
            if (isConfirmed) {
                var table = document.getElementById("dataTable");
                var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});

                // Modify the sheet's header to include the layout
                wb.Sheets["Sheet JS"]["!cols"] = [
                    { width: 20 }, // Date column width
                    { width: 30 }, // Customer/Client column width
                    { width: 30 }, // Ratings column width
                    { width: 50 }, // Contact Number / Email Address column width
                    { width: 50 }  // Remarks column width
                ];

                // Center the data in the table
                var range = XLSX.utils.decode_range(wb.Sheets["Sheet JS"]["!ref"]);
                for (var C = range.s.c; C <= range.e.c; ++C) {
                    var cell_address = {c: C, r: 0}; // Assuming header row is at index 0
                    if (!wb.Sheets["Sheet JS"][XLSX.utils.encode_cell(cell_address)]) continue;
                    wb.Sheets["Sheet JS"][XLSX.utils.encode_cell(cell_address)].s = {alignment: {horizontal: "center"}};
                }

                // Make the <thead> bold
                var headerRange = XLSX.utils.decode_range(wb.Sheets["Sheet JS"]["!ref"]);
                for (var R = headerRange.s.r; R <= headerRange.e.r; ++R) {
                    for (var C = headerRange.s.c; C <= headerRange.e.c; ++C) {
                        var cell_address = {c: C, r: R};
                        if (!wb.Sheets["Sheet JS"][XLSX.utils.encode_cell(cell_address)]) continue;
                        wb.Sheets["Sheet JS"][XLSX.utils.encode_cell(cell_address)].s = {font: {bold: true}};
                    }
                }

                var wbout = XLSX.write(wb, {bookType: "xlsx", bookSST: true, type: "binary"});

                function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
                }

                // Download the file
                saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'ccss_summary.xlsx');
            }
        });
    });
});
</script>
</div>