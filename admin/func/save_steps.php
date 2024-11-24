<?php
require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['step_count']) && isset($_POST['average_speed'])) {
        // Retrieve the form data using $_POST
        $step_count = $_POST['step_count'];
        $average_speed = $_POST['average_speed'];
        $current_date = date("Y-m-d");

        // Check if there's already an entry for today
        $select_steps = "SELECT * FROM steps WHERE date = '$current_date'";
        $result = mysqli_query($con, $select_steps);

        if (mysqli_num_rows($result) > 0) {
            // If a row for today's date exists, update it
            $update_query = "UPDATE steps SET step_count = '$step_count', average_speed = '$average_speed' WHERE date = '$current_date'";
            if (mysqli_query($con, $update_query)) {
                $response = 'Data saved successfully';
            } else {
                $response = 'Error updating data';
            }
        } else {
            // If no row for today's date exists, insert a new row
            $insert_query = "INSERT INTO steps (step_count, average_speed, date) VALUES ('$step_count', '$average_speed', '$current_date')";
            if (mysqli_query($con, $insert_query)) {
                $response = 'Data saved successfully';
            } else {
                $response = 'Error saving data';
            }
        }
    } else {
        $response = 'Missing step_count or average_speed';
    }
} else {
    $response = "Missing POST request";
}
echo $response;
