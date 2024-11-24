<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $current_password = $_POST["current_password"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $confirm_password = $_POST["confirm_password"];
    if ($_POST["password"] !== '' && $confirm_password !== '') {
        // then just update user info and password
        if ($_POST['password'] === $confirm_password) {
            $update_user_profile = "UPDATE users SET password='$password' WHERE id='$user_id'";
            mysqli_query($con, $update_user_profile);
        }
    }
    // then just update user info 
    $update_user_profile = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$user_id'";
    if (mysqli_query($con, $update_user_profile)) {
        $_SESSION['alert'] = "User Profile Updated";
        header("location: profile");
    } else {
        $_SESSION['alert'] = "Updating User Profile Failed";
        header("location: profile");
    }
    exit;
}
