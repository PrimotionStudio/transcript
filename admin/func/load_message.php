<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";

// Fetch messages
$transaction_id = htmlspecialchars($_GET['transactionId']);
$query_messages = mysqli_query($con, "SELECT * FROM messages WHERE transactionId = '$transaction_id' ORDER BY id ASC");
if (mysqli_num_rows($query_messages) == 0) {
    echo "<p>No messages yet.</p>";
} else {

    while ($messages = mysqli_fetch_assoc($query_messages,)) {
        $sendUserId = $messages['sendUserId'];
        $query_sender_user = mysqli_query($con, "SELECT * FROM users WHERE id = '$sendUserId'");
        if (mysqli_num_rows($query_sender_user) == 0) $get_sender_user = ['name' => 'Admin'];
        else $get_sender_user = mysqli_fetch_assoc($query_sender_user);
?>
        <div class="message-bubble <?= $messages['sendUserId'] == $admin_id ? 'message-sender' : 'message-receiver' ?>">
            <div>
                <div class="message-header">
                    <span class="fw-bold"><?= $get_sender_user['name'] ?></span>
                </div>
                <div class="message-body ">
                    <?= nl2br(htmlspecialchars($messages['message'])) ?>
                </div>
                <div class="message-timestamp <?= $messages['sendUserId'] == $admin_id ? 'text-white' : 'text-black' ?>">
                    <?php echo date('d M Y - h:i A', strtotime($messages['datetime'])); ?>
                </div>
            </div>
        </div>
<?php
    }
}
