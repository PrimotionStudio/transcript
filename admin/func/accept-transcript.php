<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $course = $_POST["course"];
        $grade = $_POST["grade"];
        $insert_transcript = "INSERT INTO accepted_transcripts (transcript_id, course, grade) VALUES ('$transcript_id', '$course', '$grade')";
        if (mysqli_query($con, $insert_transcript)) $_SESSION["alert"] = "Transcript added successfully";
        else $_SESSION["alert"] = "Unable to add transcript";
    } else {
        $update_transcript = "UPDATE transcript SET status = 'completed' WHERE transcript_id = '$transcript_id'";
        if (mysqli_query($con, $update_transcript)) $_SESSION["alert"] = "Transcript accepted successfully";
        else $_SESSION["alert"] = "Unable to update transcript";
    }
    header("location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}
