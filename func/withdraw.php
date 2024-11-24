<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];

    if ($amount > $get_user['payout_balance']) {
        $_SESSION['alert'] = 'Amount exceeds payout balance.';
        header('Location: withdraw');
        exit;
    }

    $insert_payout = "INSERT INTO payouts (user_id, amount) VALUES ('$user_id', '$amount')";
    $query_insert_payout = mysqli_query($con, $insert_payout);

    if (!$query_insert_payout) {
        $_SESSION['alert'] = 'Failed to insert payout entry. Please try again.';
        header('Location: withdraw');
        exit;
    }

    $_SESSION['alert'] = 'Payout request submitted successfully.';
    header('Location: withdraw');
    exit;
}
