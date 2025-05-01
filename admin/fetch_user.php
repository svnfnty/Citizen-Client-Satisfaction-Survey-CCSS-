<?php
require('config/dbconfig.php');

if(isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $query = "SELECT * FROM ccss_admin WHERE id = $userId";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row); // Encode the row data as JSON
    } else {
        // If user not found, return an error message
        echo json_encode(["error" => "User not found"]);
    }
} else {
    // If the request is invalid, return an error message
    echo json_encode(["error" => "Invalid request"]);
}
?>
