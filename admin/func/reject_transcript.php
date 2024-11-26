<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM transcripts WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE transcripts SET status = 'rejected' WHERE id = '$id'";
        if (mysqli_query($con, $sql)) $_SESSION['alert'] = "Transcript request rejected successfully.";
        else $_SESSION['alert'] = "Error: " . $sql . "<br>" . mysqli_error($con);
    } else $_SESSION['alert'] = "Transcript request does not exist.";
} else {
    $_SESSION['alert'] = "ID not provided.";
}
header('Location: ../transcripts');
exit;
