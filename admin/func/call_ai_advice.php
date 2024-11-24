<?php
require_once "get_ai_advice.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["advice_id"])) {
        $advice_id = $_POST["advice_id"];
        $select_advice = "SELECT * FROM advice WHERE user_id='$user_id' && id='$advice_id'";
        $query_advice = mysqli_query($con, $select_advice);
        $get_advice = mysqli_fetch_assoc($query_advice);
        $ai_advice = $get_advice["message"];
    } else {
        $select_nutrition_logs = "SELECT * FROM nutrition_logs WHERE user_id='$user_id'";
        $query_nutrition_logs = mysqli_query($con, $select_nutrition_logs);
        $total_nutrition_logs_serialized = '';

        $last_nutrition_id = 0;
        while ($get_nutrition_logs = mysqli_fetch_assoc($query_nutrition_logs)) {
            $total_nutrition_logs_serialized .= serialize($get_nutrition_logs) . '\n';
            $last_nutrition_id = $get_nutrition_logs["id"];
        }

        $select_nutrition_log = "SELECT * FROM nutrition_logs WHERE id='$last_nutrition_id' && user_id='$user_id'";
        $query_nutrition_logs = mysqli_query($con, $select_nutrition_log);
        $get_nutrition_log = mysqli_fetch_assoc($query_nutrition_logs);

        $select_transactions = "SELECT * FROM goals WHERE user_id='$user_id' && status='In Progress'";
        $query_transactions = mysqli_query($con, $select_transactions);
        if (mysqli_num_rows($query_transactions) == 0) {
            // No Goal to add
            $goal = '';
        } else {
            $get_transactions = mysqli_fetch_assoc($query_transactions);
            $goal = "I have set a Goal for myself ";
            // echo
            // "Last Goal: " . "<br>";
            switch ($get_transactions['goal_type']) {
                case 'Weight Loss':
                    $goal .= "To loose " . number_format($get_transactions['target_value'], 2) . "kg in about " . approximateTimeDifference(date('Y-m-d', strtotime($get_transactions['start_date'])), date('Y-m-d', strtotime($get_transactions["end_date"]))) . "( " . $get_transactions['start_date'] . " - " . $get_transactions['end_date'] . " )";
                    $unit = 'kg';
                    break;
                case 'Workout':
                    $goal .= "To workout " . number_format($get_transactions['target_value'], 2) . " time(s) within " . approximateTimeDifference(date('Y-m-d', strtotime($get_transactions['start_date'])), date('Y-m-d', strtotime($get_transactions["end_date"]))) . "( " . $get_transactions['start_date'] . " - " . $get_transactions['end_date'] . " )";
                    $unit = 'time(s)';
                    break;
                case 'Distance':
                    $goal .= "To walk or run over " . number_format($get_transactions['target_value'], 2) . "km in about " . approximateTimeDifference(date('Y-m-d', strtotime($get_transactions['start_date'])), date('Y-m-d', strtotime($get_transactions["end_date"]))) . "( " . $get_transactions['start_date'] . " - " . $get_transactions['end_date'] . " )";
                    $unit = 'time(s)';
                    $unit = 'km';
                    break;
                case 'Calories Burned':
                    $goal .= "To burn " . number_format($get_transactions['target_value'], 2) . "kcal calories within " . approximateTimeDifference(date('Y-m-d', strtotime($get_transactions['start_date'])), date('Y-m-d', strtotime($get_transactions["end_date"]))) . "( " . $get_transactions['start_date'] . " - " . $get_transactions['end_date'] . " )";
                    $unit = 'kcal';
                    break;
                default:
                    $goal = '';
                    $unit = '';
                    break;
            }
        }
        // echo "Goal: " . $goal
        //     . "<br>";
        $select_activity_metrics = "SELECT * FROM activity_metrics WHERE user_id='$user_id'";
        $query_activity_metrics = mysqli_query($con, $select_activity_metrics);
        $total_activity_metrics_serialized = '';
        while ($get_activity_metrics = mysqli_fetch_assoc($query_activity_metrics)) {
            $total_activity_metrics_serialized .= serialize($get_activity_metrics) . "\n";
        }
        // echo "Total Activity Metrics Serialied: " . $total_activity_metrics_serialized
        //     . "<br>";
        // Overwrite Session Alert
        $question = "Give me advice on being fit. \n";
        $question .= $goal . "\n";
        $question .= "Below is a serialized version of activities that i have done and logged \n";
        $question .= $total_activity_metrics_serialized . "\n";
        $question .= "I just ate " . $get_nutrition_log["food_name"] . " with " . $get_nutrition_log["calories"] . " calories, " . $get_nutrition_log["protein"] . "g protein, " . $get_nutrition_log["carbohydrate"] . "g carbohydrates, and " . $get_nutrition_log["fats"] . "g fats. \n";
        $question .= "Below are my previous nutrition logs (serialized) \n";
        $question .= $total_nutrition_logs_serialized . "\n\n";
        $question .= "I want you to give me advice, whether or not I can reach my goal.\n";
        $question .= "Some words of encouragement and some advice on things to improve on in both the workouts and the nutrition aspects";

        // str_replace('"', "'", $question);
        // echo "Question: " . $question . "<br>";
        $ai_advice = get_ai_advice($question);
        // echo $ai_advice . "<br>";
        $message = mysqli_real_escape_string($con, $ai_advice);
        $insert_advice = "INSERT INTO advice (user_id, message) VALUES ('$user_id', '$message')";
        if (mysqli_query($con, $insert_advice)) {
            $_SESSION["alert"] = "Advice generated";
        }
    }
    $_SESSION["advice"] = $ai_advice;
    header("location: index");
    exit;
}
