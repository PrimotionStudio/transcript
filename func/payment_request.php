<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST["transaction_id"];
    $wallet_name = $_POST["wallet_name"];
    $wallet_addr = $_POST["wallet_addr"];
    $amount = $_POST["amount"];

    $insert_request = "INSERT into payment_request (transaction_id, user_id, wallet_name, wallet_addr, amount) VALUES ('$transaction_id', '$user_id', '$wallet_name', '$wallet_addr', '$amount')";

    if (mysqli_query($con, $insert_request)) {
        $_SESSION["alert"] = "Your payment will be confirmed soon!";
    } else {
        $_SESSION["alert"] = "Unable to confirm payment";
    }

    header("location: message?transaction=$transaction_id");
    exit;
}
