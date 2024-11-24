<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['alert'] = 'Redirected to payouts page due to invalid or missing payout ID.';
    header('Location: ../payouts');
    exit;
}

$select_payout = "SELECT * FROM payouts WHERE id='" . $_GET['id'] . "'";
$query_payout = mysqli_query($con, $select_payout);
$get_payout = mysqli_fetch_assoc($query_payout);
if (!$get_payout) {
    $_SESSION['alert'] = 'Redirected to payouts page due to non-existent payout ID.';
    header('Location: ../payouts');
    exit;
}

$user_id = $get_payout['user_id'];
$select_user = "SELECT * FROM users WHERE id='$user_id'";
$query_user = mysqli_query($con, $select_user);
$get_user = mysqli_fetch_assoc($query_user);
if (!$get_user) {
    $_SESSION['alert'] = 'Redirected to payouts page due to non-existent user ID.';
    header('Location: ../payouts');
    exit;
}

$amount = $get_payout['amount'];
$payout_balance = $get_user['payout_balance'];
$new_payout_balance = $payout_balance - $amount;

$update_payout_balance = "UPDATE users SET payout_balance='$new_payout_balance' WHERE id='$user_id'";
$query_update_payout_balance = mysqli_query($con, $update_payout_balance);
if (!$query_update_payout_balance) {
    $_SESSION['alert'] = 'Failed to update payout balance. Redirected to payouts page.';
    header('Location: ../payouts');
    exit;
}
$update_payout = "UPDATE payouts SET status='approved' WHERE id='" . $_GET['id'] . "'";
$query_update_payout = mysqli_query($con, $update_payout);
if (!$query_update_payout) {
    $revert_payout_balance = "UPDATE users SET payout_balance='$payout_balance' WHERE id='$user_id'";
    $query_revert_payout_balance = mysqli_query($con, $revert_payout_balance);
    if (!$query_revert_payout_balance) {
        $_SESSION['alert'] = 'Failed to revert payout balance. Redirected to payouts page.';
        header('Location: ../payouts');
        exit;
    }
    $_SESSION['alert'] = 'Failed to update payout status. Redirected to payouts page.';
    header('Location: ../payouts');
    exit;
}


$_SESSION['alert'] = 'Payout processed successfully.';
header('Location: ../payouts');
exit;
