<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id_type = mysqli_real_escape_string($con, $_POST['id_type']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $uploadDir = 'uploads/';

    // Check if id_doc and selfie are set
    if (!isset($_FILES['id_doc']) || !isset($_FILES['selfie'])) {
        $_SESSION['alert'] = 'Please select both ID document and selfie.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Get file information
    $idDocFile = $_FILES['id_doc'];
    $selfieFile = $_FILES['selfie'];

    // Check if files are images
    if (!in_array($idDocFile['type'], ['image/jpeg', 'image/png', 'image/gif']) || !in_array($selfieFile['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
        $_SESSION['alert'] = 'Please upload images.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Generate unique file names
    $idDocFileName = basename($idDocFile['name']);
    $idDocFileExtension = pathinfo($idDocFileName, PATHINFO_EXTENSION);
    $uniqueId = uniqid();
    $idDocPath = $uploadDir . $uniqueId . '_' . $idDocFileName;

    $selfieFileName = basename($selfieFile['name']);
    $selfieFileExtension = pathinfo($selfieFileName, PATHINFO_EXTENSION);
    $uniqueId = uniqid();
    $selfiePath = $uploadDir . $uniqueId . '_' . $selfieFileName;

    // Move uploaded files
    if (!move_uploaded_file($idDocFile['tmp_name'], $idDocPath) || !move_uploaded_file($selfieFile['tmp_name'], $selfiePath)) {
        $_SESSION['alert'] = 'Failed to upload files.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Check if an entry with same user_id exists already
    $checkSql = "SELECT * FROM kyc WHERE user_id = '$user_id' AND (status = 'verified' OR status = 'not verified')";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['alert'] = 'You have already submitted a KYC request. Please wait for it to be verified or rejected.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Insert into kyc table
    $sql = "INSERT INTO kyc (user_id, id_type, dob, id_doc, selfie) VALUES ('$user_id', '$id_type', '$dob', '$idDocPath', '$selfiePath')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['alert'] = "New record created successfully.";
    } else {
        $_SESSION['alert'] = "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
