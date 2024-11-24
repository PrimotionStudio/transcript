<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $role = $_POST["role"];
    $coin = $_POST["coin"];
    $amount = $_POST["amount"];
    $paymentMethod = $_POST["paymentMethod"];
    $estimatedTotal = $_POST["estimatedTotal"];
    function generateRandomHex($length = 16)
    {
        $randomBytes = random_bytes($length / 2);
        $hex = bin2hex($randomBytes);
        return "0x" . $hex;
    }
    $transaction_id = generateRandomHex();
    $insert_trasaction = "INSERT into transactions (creatorUserId,  title, creatorRole, coin, amount, paymentMethod, estimatedTotal, transactionId, $role) VALUES ('" . $get_user['id'] . "', '$title', '$role', '$coin', '$amount', '$paymentMethod', '$estimatedTotal', '$transaction_id', '" . $get_user['id'] . "')";

    if (mysqli_query($con, $insert_trasaction)) {
        $_SESSION["alert"] = "Transaction created successfully!";
    } else {
        $_SESSION["alert"] = "Unable to create transaction";
    }

    header("location: transactions");
    exit;
}
