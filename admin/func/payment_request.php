<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST["payment_id"];
    $update_payment_request = "UPDATE payment_request SET status = 'seen' WHERE id = '$payment_id'";
    if (mysqli_query($con, $update_payment_request)) {
        $_SESSION["alert"] = "Payment has been confirmed!";
    } else {
        $_SESSION["alert"] = "Unable to confirm payment";
    }

    header("location: message?transaction=$transaction_id");
    exit;
}
