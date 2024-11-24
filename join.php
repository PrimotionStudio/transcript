<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Join Transactions - Escrow Guarantee P2P";

require_once "required/validate.php";

// Check if an entry with same user_id exists already
$checkSql = "SELECT * FROM kyc WHERE user_id = '$user_id' AND status = 'verified'";
$checkResult = mysqli_query($con, $checkSql);

if (mysqli_num_rows($checkResult) == 0) {
    $_SESSION['alert'] = 'Please complete your KYC first.';
    header('Location: kyc');
    exit;
}
if ($_GET['transaction']) {
    $transaction_id = $_GET['transaction'];
    if (!$transaction_id) {
        $_SESSION['alert'] = "Invalid transaction link";
        header("location: transactions");
        exit;
    }
    $select_transactions = "SELECT * FROM transactions WHERE transactionId = '$transaction_id'";
    $query_transactions = mysqli_query($con, $select_transactions);
    if (mysqli_num_rows($query_transactions) == 0) {
        $_SESSION['alert'] = "Invalid transaction link";
        header("location: transactions");
        exit;
    }
    $transaction = mysqli_fetch_assoc($query_transactions);
    $get_transactions = $transaction;
    if ($get_transactions['creatorUserId'] == $get_user['id']) {
        $_SESSION['alert'] = "You cannot join your own transaction";
        header("location: transactions");
        exit;
    }
    if ($get_transactions['seller'] != '' && $get_transactions['buyer'] != '') {
        $_SESSION['alert'] = "This transaction is full. You cannot join it";
        header("location: transactions");
        exit;
    }
    if ($get_transactions['state'] == "completed") {
        $_SESSION['alert'] = "This transaction has been completed";
        header("location: transactions");
        exit;
    }
    if ($get_transactions['state'] == "rejected") {
        $_SESSION['alert'] = "This transaction has been cancelled";
        header("location: transactions");
        exit;
    }
}
require_once "func/join_transactions.php";
include_once "included/head.php";
?>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <?php
    include_once "included/sidebar.php";
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        include_once "included/navbar.php";
        ?>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">

                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bolder">Join Transactions</h4>
                            <small></small>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <!-- Buyer Details -->
                                <div class="col-6 text-center">
                                    <div class="border p-3">
                                        <h6>Buyer </h6>
                                        <?php
                                        $buyer_id = $get_transactions['buyer'];
                                        $select_buyer_user = "SELECT * FROM users WHERE id='$buyer_id'";
                                        $query_buyer_user = mysqli_query($con, $select_buyer_user);
                                        if (mysqli_num_rows($query_buyer_user) == 0) {
                                        ?>
                                            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <span><?= strtoupper(substr($get_user['name'], 0, 1)); ?></span>
                                            </div>
                                            <p class="mt-2"><?= htmlspecialchars($get_user['name']); ?></p>
                                        <?php
                                        } else {
                                            $get_buyer_user = mysqli_fetch_assoc($query_buyer_user);
                                        ?>
                                            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <span><?= strtoupper(substr($get_buyer_user['name'], 0, 1)); ?></span>
                                            </div>
                                            <p class="mt-2"><?= htmlspecialchars($get_buyer_user['name']); ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Seller Details -->
                                <div class="col-6 text-center">
                                    <div class="border p-3">

                                        <h6>Seller</h6>
                                        <?php
                                        $seller_id = $get_transactions['seller'];
                                        $select_seller_user = "SELECT * FROM users WHERE id='$seller_id'";
                                        $query_seller_user = mysqli_query($con, $select_seller_user);
                                        if (mysqli_num_rows($query_seller_user) == 0) {
                                        ?>
                                            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <span><?= strtoupper(substr($get_user['name'], 0, 1)); ?></span>
                                            </div>
                                            <p class="mt-2"><?= htmlspecialchars($get_user['name']); ?></p>
                                        <?php
                                        } else {
                                            $get_seller_user = mysqli_fetch_assoc($query_seller_user);
                                        ?>
                                            <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <span><?= strtoupper(substr($get_seller_user['name'], 0, 1)); ?></span>
                                            </div>
                                            <p class="mt-2"><?= htmlspecialchars($get_seller_user['name']); ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-start">

                                <p><strong>Transaction ID:</strong> <?= htmlspecialchars($get_transactions['transactionId']); ?></p>
                                <p><strong>Amount:</strong> <?= htmlspecialchars($get_transactions['amount']); ?> <?= htmlspecialchars(strtoupper($get_transactions['coin'])); ?></p>
                                <p><strong>Payment Method:</strong> <?= htmlspecialchars($get_transactions['paymentMethod']); ?></p>
                                <p><strong>Estimated Total:</strong> <?= htmlspecialchars($get_transactions['estimatedTotal']); ?></p>
                                <p><strong>Date & Time:</strong> <?= htmlspecialchars(date('l, F j, Y h:i A', strtotime($get_transactions['datetime']))); ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($get_transactions['state']); ?></p>
                            </div>
                        </div>
                        <div class="card-footer border-top d-flex justify-content-between">
                            <?php
                            $emptyRole;
                            if ($get_transactions['seller'] == '') $emptyRole = 'seller';
                            if ($get_transactions['buyer'] == '') $emptyRole = 'buyer';
                            ?>
                            <form action="" method="post">
                                <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($get_transactions['transactionId']); ?>">
                                <input type="hidden" name="role" value="<?= $emptyRole; ?>">
                                <button type="submit" name="action" value="reject" class="btn btn-danger mt-2">Reject</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($get_transactions['transactionId']); ?>">
                                <input type="hidden" name="role" value="<?= $emptyRole; ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success mt-2">Accept</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include_once "included/footer.php";
            ?>
        </div>
    </main>
    <?php
    include_once "included/scripts.php";
    ?>
</body>

</html>