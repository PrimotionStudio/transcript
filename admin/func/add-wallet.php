<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $insert_wallet = "INSERT into wallet (wallet_name, wallet_addr) VALUES ('$name', '$address')";
    if (mysqli_query($con, $insert_wallet)) {
        $_SESSION["alert"] = "Wallet added successfully!";
    } else {
        $_SESSION["alert"] = "Unable to add wallet";
    }
    header("location: wallets");
    exit;
}
