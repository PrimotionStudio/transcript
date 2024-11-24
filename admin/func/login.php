<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Check if username and email already exist in users table
    $select_user = "SELECT * FROM admin WHERE name='$name'";
    $query_user = mysqli_query($con, $select_user);
    if (mysqli_num_rows($query_user) == 0) {
        $_SESSION["alert"] = "This username is not linked to an account";
        header("location: login");
    } else {
        $get_admin = mysqli_fetch_assoc($query_user);
        // Check if password is correct
        if ($password == $get_admin["password"]) {
            $loginkey = password_hash(time(), PASSWORD_BCRYPT);
            $login_user = "UPDATE admin SET loginkey='$loginkey' WHERE name='$name'";
            $query_login = mysqli_query($con, $login_user);
            $_SESSION["loginkey"] = $loginkey;
            $_SESSION["admin_id"] = $get_admin["id"];
            $_SESSION["alert"] = "Login Successful";
            header("location: index");
        } else {
            $_SESSION["alert"] = "Incorrect login credentials";
            header("location: login");
        }
    }
    exit;
}
