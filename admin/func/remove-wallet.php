<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $wallet_id = $_GET["id"];
    $delete_wallet = "DELETE FROM wallet WHERE id = '$wallet_id'";
    if (mysqli_query($con, $delete_wallet)) {
        $_SESSION["alert"] = "Wallet removed successfully!";
    } else {
        $_SESSION["alert"] = "Unable to remove wallet";
    }
    header("location: ../wallets");
    exit;
}
