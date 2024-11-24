<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
// Get the message from GET
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['transaction'])) {
    $transactionId = htmlspecialchars($_GET['transaction']);
    // update transaction state to completed
    $update_transaction = "UPDATE transactions SET state = 'completed' WHERE transactionId = '$transactionId'";
    if (mysqli_query($con, $update_transaction)) {
        $_SESSION["alert"] = "This transaction has been marked completed!";
    } else {
        $_SESSION["alert"] = "This transaction could not be marked completed!";
    }
    header('location: ../message?transaction=' . $transactionId);
    exit;
}
