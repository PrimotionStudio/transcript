<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transcript_id = $_POST["transcript_id"];
    if (isset($_POST['add'])) {
        $course = $_POST["course"];
        $grade = $_POST["grade"];
        $insert_transcript = "INSERT INTO accepted_transcripts (transcript_id, course, grade) VALUES ('$transcript_id', '$course', '$grade')";
        if (mysqli_query($con, $insert_transcript)) $_SESSION["alert"] = "Transcript added successfully";
        else $_SESSION["alert"] = "Unable to add transcript";
    } else {
        $update_transcript = "UPDATE transcripts SET status = 'completed' WHERE id = '$transcript_id'";
        if (mysqli_query($con, $update_transcript)) $_SESSION["alert"] = "Transcript accepted successfully";
        else $_SESSION["alert"] = "Unable to update transcript";
        header("location: ../transcripts");
        exit;
    }
}
header("location: " . $_SERVER["HTTP_REFERER"]);
exit;
