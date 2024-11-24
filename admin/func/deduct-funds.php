
<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if (isset($_POST['amount']) && isset($_POST['user'])) {
    $user_id = $_POST['user'];
    $amount = $_POST['amount'];

    $query = "UPDATE users SET payout_balance = payout_balance - $amount WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['alert'] = "Amount deduted from user's payout balance";
    } else {
        $_SESSION['alert'] = "Error deducted amount from user's payout balance";
    }
    header("Location: ../users.php");
    exit;
}
