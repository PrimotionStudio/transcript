<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Create New Transaction - Escrow Guarantee P2P";
require_once "required/validate.php";

// Check if an entry with same user_id exists already
$checkSql = "SELECT * FROM kyc WHERE user_id = '$user_id' AND status = 'verified'";
$checkResult = mysqli_query($con, $checkSql);

if (mysqli_num_rows($checkResult) == 0) {
    $_SESSION['alert'] = 'Please complete your KYC first.';
    header('Location: kyc');
    exit;
}
require_once "func/create-new-transaction.php";
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
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="create-goal">
                                <div class="form-group">
                                    <label for="role">What is your role in this transaction</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name='title' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="coin">What is the coin to be purchased</label>
                                    <select name="coin" id="coin" class="form-control">
                                        <?php
                                        $select_wallets = "SELECT * FROM wallet";
                                        $query_wallets = mysqli_query($con, $select_wallets);
                                        while ($get_wallets = mysqli_fetch_assoc($query_wallets)) {
                                        ?>
                                            <option value="<?= strtoupper($get_wallets["wallet_name"]) ?>"><?= strtoupper($get_wallets["wallet_name"]) ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Amout">Amount of coin to be purchase</label>
                                    <input type="number" name='amount' step='0.000000001' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="price">Estimated price of coin to be purchased</label>
                                    <input type="number" name='estimatedTotal' step='0.000000001' class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="paymentMethod">Payment method </label>
                                    <input type="text" name='paymentMethod' value='USDT' readonly class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Create Transaction</button>
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