<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
// Get the message from POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $transactionId = htmlspecialchars($_POST['transactionId']);
    $message = htmlspecialchars($_POST['message']);
    $insert_message = "INSERT INTO messages (transactionId, sendUserId, message) VALUES ('$transactionId', '$admin_id', '$message')";
    if (mysqli_query($con, $insert_message)) {
    } else {
        throw new Exception("Error Sending Message", 1);
    }
}
