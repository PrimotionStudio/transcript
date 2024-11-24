<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = $_POST["food_name"];
    $calories = $_POST["calories"];
    $protein = $_POST["protein"];
    $carbohydrate = $_POST["carbohydrate"];
    $fats = $_POST["fats"];

    $insert_nutrition = "INSERT INTO nutrition_logs (user_id, food_name, calories, protein, carbohydrate, fats) VALUES ('$user_id', '$food_name', '$calories', '$protein', '$carbohydrate', '$fats')";
    if (mysqli_query($con, $insert_nutrition)) {
        $_SESSION["alert"] = "Nutrition log created successfully!";
    } else {
        $_SESSION["alert"] = "Unable to create nutrition log";
    }
    header("location: nutrition");
    exit;
}
