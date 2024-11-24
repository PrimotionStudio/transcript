<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["goal_id"]) {
        // Complete Goal
        $goal_id = $_POST["goal_id"];
        $complete_goal = "UPDATE goals SET status='Completed' WHERE id='$goal_id'";
        mysqli_query($con, $complete_goal);
        $_SESSION["alert"] = "Goal completed successfully!";
    } else {
        $goal_type = $_POST["goalType"];
        $target_value = $_POST["targetValue"];
        $end_date = $_POST["goalEnd"];

        // Only one goals can exist at a point
        $select_transactions = "SELECT * FROM goals WHERE user_id='$user_id' && status='In Progress'";
        $query_transactions = mysqli_query($con, $select_transactions);
        if (mysqli_num_rows($query_transactions) > 0) {
            $_SESSION["alert"] = "You already have a goal In Progress. Complete it and try again";
            header("location: goals");
            exit;
        }
        $insert_goals = "INSERT INTO goals (user_id, goal_type, target_value, end_date) VALUES ('$user_id', '$goal_type', '$target_value', '$end_date')";
        if (mysqli_query($con, $insert_goals)) {
            $_SESSION["alert"] = "Goal created successfully!";
        } else {
            $_SESSION["alert"] = "Unable to create goal";
        }
    }
    header("location: goals");
    exit;
}
