<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Message - Escrow Guarantee P2P";
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
    $get_transaction = mysqli_fetch_assoc($query_transactions);

    if ($get_transaction['seller'] == '' || $get_transaction['buyer'] == '') {
        $_SESSION['alert'] = "This transaction is not yet completed";
        header("location: transactions");
        exit;
    }
}

require_once "func/payment_request.php";
include_once "included/head.php";
function formatTransactionId(string $tnx_id): string
{
    return substr($tnx_id, 0, 3) . '...' . substr($tnx_id, -3);
}
?>
<style>
    .message-bubble {
        max-width: 75%;
        padding: 10px 10px;
        border-radius: 15px;
        margin-bottom: 10px;
        /* font-size: 0.9rem; */
        line-height: 1.5;
    }

    .message-bubble .message-header {
        font-size: 0.8rem;
        font-weight: 500;
        /* margin-bottom: 5px; */
    }

    .message-bubble .message-timestamp {
        font-size: 0.75rem;
        color: #888;
        text-align: right;
        /* margin-top: 5px; */
    }

    .message-sender {
        background-color: #007bff;
        color: white;
        margin-left: auto;
    }

    .message-receiver {
        background-color: #f1f1f1;
        color: #333;
        margin-right: auto;
    }

    .message-body {
        padding: 10px 0;
    }
</style>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <?php
    include_once "included/sidebar.php";
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        include_once "included/navbar.php";
        ?>

        <div class="modal fade" id="tnx_details" tabindex="-1" aria-labelledby="tnx_details" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $get_transaction['id']; ?>">
                            <?= htmlspecialchars($get_transaction['title']); ?>
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
                                    $buyer_id = $get_transaction['buyer'];
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
                                    $seller_id = $get_transaction['seller'];
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

                            <p><strong>Transaction ID:</strong> <?= htmlspecialchars($get_transaction['transactionId']); ?></p>
                            <p><strong>Amount:</strong> <?= htmlspecialchars($get_transaction['amount']); ?> <?= htmlspecialchars($get_transaction['coin']); ?></p>
                            <p><strong>Payment Method:</strong> <?= htmlspecialchars($get_transaction['paymentMethod']); ?></p>
                            <p><strong>Estimated Total:</strong> <?= htmlspecialchars($get_transaction['estimatedTotal']); ?></p>
                            <p><strong>Date & Time:</strong> <?= htmlspecialchars(date('l, F j, Y h:i A', strtotime($get_transaction['datetime']))); ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($get_transaction['state']); ?></p>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <span class="d-flex">Transaction ID:&nbsp;
                            <button class="btn p-0 bg-none" data-bs-toggle="modal" data-bs-target="#tnx_details">
                                <strong class="text-primary text-decoration-underline"><?= $transaction_id ?></strong>
                            </button>
                        </span>
                        <!-- <span>Transaction ID: </span> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- <h6>Buyer </h6> -->
                            <?php
                            $buyer_id = $get_transaction['buyer'];
                            $select_buyer_user = "SELECT * FROM users WHERE id='$buyer_id'";
                            $query_buyer_user = mysqli_query($con, $select_buyer_user);
                            if (mysqli_num_rows($query_buyer_user) == 0) {
                            ?>
                                <div class="d-flex">

                                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center d-none d-md-block" style="width: 50px; height: 50px;">
                                        <span>NULL</span>
                                    </div>
                                    <p class="mt-1 text-xs d-none d-md-block">This buyer has not<br>yet joined the transaction</p>
                                    <span class="badge bg-primary">Buyer</span>
                                </div>
                            <?php
                            } else {
                                $get_buyer_user = mysqli_fetch_assoc($query_buyer_user);
                            ?>
                                <div class="d-flex">
                                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center d-none d-md-block" style="width: 50px; height: 50px; ">
                                        <span><?= strtoupper(substr($get_buyer_user['name'], 0, 1)); ?></span>
                                    </div>
                                    <p class="m-2"><?= htmlspecialchars($get_buyer_user['name']); ?></p>
                                    <span class="badge bg-primary d-none d-md-block">Buyer</span>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            $seller_id = $get_transaction['seller'];
                            $select_seller_user = "SELECT * FROM users WHERE id='$seller_id'";
                            $query_seller_user = mysqli_query($con, $select_seller_user);
                            if (mysqli_num_rows($query_seller_user) == 0) {
                            ?>
                                <div class="d-flex">
                                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center d-none d-md-block" style="width: 50px; height: 50px;">
                                        <span>NULL</span>
                                    </div>
                                    <p class="mt-1 text-xs d-none d-md-block">This seller has not<br>yet joined the transaction</p>

                                    <span class="badge bg-primary h-auto">Seller</span>
                                </div>
                            <?php
                            } else {
                                $get_seller_user = mysqli_fetch_assoc($query_seller_user);
                            ?>
                                <div class="d-flex">
                                    <div class="rounded-circle bg-secondary text-white d-inline-flex d-none d-md-block align-items-center justify-content-center " style="width: 50px; height: 50px;">
                                        <span><?= strtoupper(substr($get_seller_user['name'], 0, 1)); ?></span>
                                    </div>
                                    <p class="m-2"><?= htmlspecialchars($get_seller_user['name']); ?></p>
                                    <span class="badge bg-primary d-none d-md-block">Seller</span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chat-box" class="overflow-auto" style="height: 300px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                            <!-- Messages will be dynamically added here -->
                        </div>
                        <div class="mt-3">
                            <textarea id="message-input" class="form-control mb-2" rows="2" placeholder="Type your message..."></textarea>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-secondary btn-xs" onclick="sendPresetMessage('I have sent this to the admin')">I have sent this to the admin</button>
                                <button class="btn btn-secondary btn-xs mx-2" onclick="sendPresetMessage('Please confirm')">Please confirm</button>
                                <button class="btn btn-secondary btn-xs mx-2" onclick="sendPresetMessage('Transaction completed successfully')">Transaction completed successfully</button>
                                <button class="btn btn-primary" id="send-btn">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p>Buyer Status<br />

                            <?php
                            $select_buyer_status = "SELECT * FROM payment_request WHERE transaction_id='$transaction_id' AND user_id='" . $get_transaction['buyer'] . "' AND status='seen'";
                            $query_buyer_status = mysqli_query($con, $select_buyer_status);
                            if (mysqli_num_rows($query_buyer_status) > 0) {
                            ?>
                                <strong class="text-success">sent</strong>
                            <?php
                            } else {
                            ?>
                                <strong class="text-warning">not yet sent</strong>
                            <?php
                            }
                            ?>
                        </p>

                        <button class="btn btn-warning" id="wallet-btn">Send to Admin Wallet</button>
                        <p>Seller Status<br />
                            <?php
                            $select_seller_status = "SELECT * FROM payment_request WHERE transaction_id='$transaction_id' AND user_id='" . $get_transaction['seller'] . "' AND status='seen'";
                            $query_seller_status = mysqli_query($con, $select_seller_status);
                            if (mysqli_num_rows($query_seller_status) > 0) {
                            ?>
                                <strong class="text-success">sent</strong>
                            <?php
                            } else {
                            ?>
                                <strong class="text-warning">not yet sent</strong>
                            <?php
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Wallet Dialog -->
            <div class="modal fade" id="walletDialog" tabindex="-1" aria-labelledby="walletDialogLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="walletDialogLabel">Send Exactly <?= $user_id == $get_transaction['buyer'] ? number_format($get_transaction['estimatedTotal'], 5) . ' USDT' : number_format($get_transaction['amount'], 5) . ' ' . strtoupper($get_transaction['coin']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="walletAddress" class="form-label">Wallet Address:</label>
                            <div class="input-group">
                                <?php
                                $admin_wallet = $user_id == $get_transaction['buyer'] ? 'USDT' : $get_transaction['coin'];
                                $select_wallet = "SELECT * FROM wallet WHERE wallet_name='$admin_wallet'";
                                $query_wallet = mysqli_query($con, $select_wallet);
                                if (mysqli_num_rows($query_wallet) == 0) {
                                ?>
                                    <input type="text" id="walletAddress" class="form-control" value="--No wallet address found--" readonly>
                                <?php
                                } else {
                                    $get_wallet = mysqli_fetch_assoc($query_wallet);
                                ?>
                                    <input type="text" id="walletAddress" class="form-control" value="<?= $get_wallet['wallet_addr'] ?>" readonly>
                                <?php
                                }
                                ?>
                                <button class="btn btn-outline-secondary" id="copyWalletBtn">Copy</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php

                            if (mysqli_num_rows($query_wallet) != 0) {
                            ?>
                                <form action="" method="post">
                                    <input type="hidden" name="transaction_id" value="<?= $transaction_id ?>">
                                    <input type="hidden" name="wallet_addr" id="wallet_addr" value='<?= $get_wallet['wallet_addr'] ?>'>
                                    <input type="hidden" name="wallet_name" id="wallet_name" value='<?= $get_wallet['wallet_name'] ?>'>
                                    <input type="hidden" name="amount" id="amount" value='<?= $user_id == $get_transaction['buyer'] ? $get_transaction['estimatedTotal'] : $get_transaction['amount'] ?>'>
                                    <button type="submit" class="btn btn-primary" id="paid-btn">I have sent it.</button>
                                </form>
                            <?php
                            } else {
                            ?>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <?php
                            }
                            ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show the wallet dialog
        document.getElementById('wallet-btn').addEventListener('click', function() {
            const walletDialog = new bootstrap.Modal(document.getElementById('walletDialog'));
            walletDialog.show();
        });

        // Copy wallet address to clipboard
        document.getElementById('copyWalletBtn').addEventListener('click', function() {
            const walletInput = document.getElementById('walletAddress');
            walletInput.select();
            navigator.clipboard.writeText(walletInput.value).then(() => {
                alert('Wallet address copied to clipboard!');
            }).catch(() => {
                alert('Failed to copy wallet address.');
            });
        });
    </script>

    <script>
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');

        // Load messages from the database every second
        let totalMsg = 0;

        function loadMessages() {
            $.ajax({
                url: 'func/find_new_message.php?transactionId=<?= $transaction_id ?>', // PHP script to fetch messages
                method: 'GET',
                success: function(data) {
                    // console.log(`totalMsg: ${totalMsg} - data: ${parseInt(data)}`);
                    if (parseInt(data) > totalMsg) {
                        totalMsg = parseInt(data);
                        // console.log(`totalMsg: ${totalMsg}`);
                        $.ajax({
                            url: 'func/load_message.php?transactionId=<?= $transaction_id ?>', // PHP script to fetch messages
                            method: 'GET',
                            success: function(data) {
                                $('#chat-box').html(data);
                                chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
                            }
                        });
                    }
                }
            });
        }

        // Send a new message
        sendBtn.addEventListener('click', function() {
            const message = messageInput.value.trim();
            if (message) {
                $.ajax({
                    url: 'func/send_message.php', // PHP script to save the message
                    method: 'POST',
                    data: {
                        message,
                        transactionId: '<?= $transaction_id ?>'
                    },
                    success: function() {
                        messageInput.value = '';
                        loadMessages(); // Refresh messages
                    }
                });
            }
        });

        // Send preset messages
        function sendPresetMessage(message) {
            $.ajax({
                url: 'func/send_message.php',
                method: 'POST',
                data: {
                    message,
                    transactionId: '<?= $transaction_id ?>'
                },
                success: function() {
                    loadMessages();
                }
            });
        }

        // Auto-refresh messages every second
        setInterval(loadMessages, 1000);
    </script>
</body>

</html>