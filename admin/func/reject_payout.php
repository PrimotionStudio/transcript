<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_payout = "SELECT * FROM payouts WHERE id='$id'";
    $query_payout = mysqli_query($con, $select_payout);
    if (mysqli_num_rows($query_payout) > 0) {
        $get_payout = mysqli_fetch_assoc($query_payout);
        $update_payout = "UPDATE payouts SET status='rejected' WHERE id='$id'";
        $query_update_payout = mysqli_query($con, $update_payout);
        if ($query_update_payout) {
            $_SESSION['alert'] = 'Payout request rejected successfully.';
        } else {
            $_SESSION['alert'] = 'Failed to reject payout request. Please try again.';
        }
    } else {
        $_SESSION['alert'] = 'Payout request not found.';
    }
} else {
    $_SESSION['alert'] = 'No payout request selected';
}
header('Location: ../payouts.php');
exit;
