<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $role = $_POST['role'];
    $transaction_id = $_POST['transaction_id'];
    if ($action == 'accept') {
        $update_transaction = "UPDATE transactions SET $role='" . $get_user['id'] . "' WHERE transactionId='$transaction_id'";
        $query_transactions = mysqli_query($con, $update_transaction);
        if ($query_transactions) {
            $_SESSION["alert"] = "Transaction joined successfully";
            header("Location: transactions.php");
            exit;
        } else {
            $_SESSION["alert"] = "Error updating transaction";
            header("Location: transactions.php");
            exit;
        }
    } else {
        // reject
        $update_transaction = "UPDATE transactions SET state='rejected' WHERE transactionId='$transaction_id'";
        $query_transactions = mysqli_query($con, $update_transaction);
        if ($query_transactions) {
            $_SESSION["alert"] = "Transaction rejected successfully";
            header("Location: transactions.php");
            exit;
        } else {
            $_SESSION["alert"] = "Error updating transaction";
            header("Location: transactions.php");
            exit;
        }
    }
}
