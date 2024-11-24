<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workout = $_POST["workout"];
    $intensity = $_POST["intensity"];
    $duration = $_POST["duration"];

    $workout_map = [
        "running" => 8.0,
        "walking" => 3.5,
        "cycling" => 6.0,
        "swimming" => 6.0
    ]; // Map of workouts to their respective caloric burn rates

    // get the key in the workout map based on value stored in $workout
    $workout_type = array_search($workout, $workout_map);

    if ($get_user["weight"] == null) {
        $_SESSION["alert"] = "Cannot calculate calories burned without weight. Please update your information and try again!";
        header("location: profile");
    }
    $phone = $get_user['weight'];

    $bmr = 10 * $phone;

    $calories_burned = (floatval($workout) * floatval($bmr) * floatval($intensity)) / (60 * floatval($duration));

    $insert_activity_metrics = "INSERT INTO activity_metrics (user_id, workout_type, weight, intensity, duration, calories_burned) VALUES ('$user_id', '$workout_type', $phone, $intensity, $duration, $calories_burned)";
    if (mysqli_query($con, $insert_activity_metrics)) {
        $_SESSION["alert"] = "Activity metrics successfully recorded!";
    } else {
        $_SESSION["alert"] = "Unable to record activity metrics";
    }
    header("location: activities");
    exit;
}
