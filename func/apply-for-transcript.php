<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $faculty = $_POST["faculty"];
    $department = $_POST["department"];
    $degree = $_POST["degree"];
    $purpose = $_POST["purpose"];

    function generateRandomHex($length = 16)
    {
        $randomBytes = random_bytes($length / 2);
        $hex = bin2hex($randomBytes);
        return "0x" . $hex;
    }
    $blockchain_id = generateRandomHex();
    $insert_transcript = "INSERT INTO transcripts (user_id, matric, faculty, department, degree, purpose, blockchain_id) VALUES ('$user_id', '$matric', '$faculty', '$department', '$degree', '$purpose', '$blockchain_id')";

    if (mysqli_query($con, $insert_transcript)) {
        $_SESSION["alert"] = "Transcript applied successfully!";
    } else {
        $_SESSION["alert"] = "Unable to apply for transcript!";
    }

    header("location: transcripts");
    exit;
}
