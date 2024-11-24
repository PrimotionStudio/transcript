<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";

// Fetch messages
$transaction_id = htmlspecialchars($_GET['transactionId']);
$query_messages = mysqli_query($con, "SELECT * FROM messages WHERE transactionId = '$transaction_id' ORDER BY id ASC");
echo mysqli_num_rows($query_messages);
