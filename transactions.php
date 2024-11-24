<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Transactions - Escrow Guarantee P2P";
require_once "required/validate.php";

include_once "included/head.php";
function formatTransactionId(string $tnx_id): string
{
    return substr($tnx_id, 0, 3) . '...' . substr($tnx_id, -3);
}
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
                <div class="col-md-12 col-sm-12">

                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bolder">Transaction History</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table
                                    class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                State
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Role
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Coin
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Estimated Total
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payment Method
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Transaction ID
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_transactions = "SELECT * FROM transactions WHERE seller='$user_id' || buyer='$user_id'";
                                        $query_transactions = mysqli_query($con, $select_transactions);
                                        // $goal_id = 0;
                                        while ($get_transactions = mysqli_fetch_assoc($query_transactions)) :
                                        ?>
                                            <tr>

                                                <td
                                                    class="align-middle text-center text-sm">

                                                    <?php
                                                    if ($get_transactions["state"] == 'completed') :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-success">Completed</span>
                                                    <?php
                                                    elseif ($get_transactions["state"] == 'pending') :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-warning">Pending</span>
                                                    <?php
                                                    elseif ($get_transactions["state"] == 'rejected') :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-danger">Rejected</span>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-gray">Undefined</span>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= $get_user == $get_transactions['creatorUserId'] ? $get_transactions["creatorRole"] : ($get_transactions['creatorRole'] === 'seller' ? 'seller' : 'buyer') ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= strtoupper($get_transactions["coin"]) ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= number_format($get_transactions["amount"], 2) ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= number_format($get_transactions["estimatedTotal"], 2) ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= strtoupper($get_transactions["paymentMethod"]) ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= formatTransactionId($get_transactions["transactionId"]) ?></span>
                                                </td>
                                                <td
                                                    class="align-middle text-center">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $get_transactions['id']; ?>">
                                                        View Details
                                                    </button>


                                                    <div class="modal fade" id="modal<?= $get_transactions['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $get_transactions['id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalLabel<?= $get_transactions['id']; ?>">
                                                                        <?= htmlspecialchars($get_transactions['title']); ?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
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
                                                                                        <span>NULL</span>
                                                                                    </div>
                                                                                    <p class="mt-1 text-xs">This buyer has not<br>yet joined the transaction</p>
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
                                                                                        <span>NULL</span>
                                                                                    </div>
                                                                                    <p class="mt-1 text-xs">This seller has not<br>yet joined the transaction</p>
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
                                                                        <p><strong>Amount:</strong> <?= htmlspecialchars($get_transactions['amount']); ?> <?= htmlspecialchars($get_transactions['coin']); ?></p>
                                                                        <p><strong>Payment Method:</strong> <?= htmlspecialchars($get_transactions['paymentMethod']); ?></p>
                                                                        <p><strong>Estimated Total:</strong> <?= htmlspecialchars($get_transactions['estimatedTotal']); ?></p>
                                                                        <p><strong>Date & Time:</strong> <?= htmlspecialchars(date('l, F j, Y h:i A', strtotime($get_transactions['datetime']))); ?></p>
                                                                        <p><strong>Status:</strong> <?= htmlspecialchars($get_transactions['state']); ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-between">
                                                                    <?php
                                                                    if ($get_transactions['seller'] != '' && $get_transactions['buyer'] != '') {
                                                                    ?>
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                                            <a class="text-white" href="message?transaction=<?= htmlspecialchars($get_transactions['transactionId']); ?>">Message</a>
                                                                        </button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="form-group d-flex align-items-center">
                                                                            <input type="text" class='form-control' id="transaction-link<?= $get_transactions['id']; ?>" value="https://escrowguaranteep2p.com/join?transaction=<?= htmlspecialchars($get_transactions['transactionId']); ?>" readonly>
                                                                            <button class="btn btn-primary" onclick="copyLink('transaction-link<?= $get_transactions['id']; ?>')">Copy Link</button>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>

                                                                <script>
                                                                    function copyLink(id) {
                                                                        var copyText = document.getElementById(id);
                                                                        copyText.select();
                                                                        copyText.setSelectionRange(0, 99999);
                                                                        navigator.clipboard.writeText(copyText.value);
                                                                        // alert("Copied the text: " + copyText.value);
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php
                                        endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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