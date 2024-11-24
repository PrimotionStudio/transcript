<?php

require_once "../required/session.php";
require_once "../required/sql.php";
require_once "../required/validate.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM kyc WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "DELETE FROM kyc WHERE id = '$id'";
        if (mysqli_query($con, $sql)) {
            $_SESSION['alert'] = "KYC request deleted successfully.";
            header('Location: ../kyc');
            exit;
        } else {
            $_SESSION['alert'] = "Error: " . $sql . "<br>" . mysqli_error($con);
            header('Location: ../kyc');
            exit;
        }
    } else {
        $_SESSION['alert'] = "KYC request does not exist.";
        header('Location: ../kyc');
        exit;
    }
} else {
    $_SESSION['alert'] = "ID not provided.";
    header('Location: ../kyc');
    exit;
}
