<?php
// Validate a users login
if (isset($_SESSION["loginkey"]) && isset($_SESSION["admin_id"])) {
	$admin_id = $_SESSION["admin_id"];
	$loginkey = $_SESSION["loginkey"];
	$select_user = "SELECT * FROM admin WHERE id='$admin_id' AND loginkey='$loginkey'";
	$query_user = mysqli_query($con, $select_user);
	if (mysqli_num_rows($query_user) != 0) {
		// Login Validated
		$get_admin = mysqli_fetch_assoc($query_user);
	} else {
		$_SESSION["alert"] = "Session expired, please login again";
		(file_exists('logout.php')) ? header("location: logout") : header("location: ../logout");
		exit;
	}
} else {
	$_SESSION["alert"] = "Session expired, please login again";
	(file_exists('logout.php')) ? header("location: logout") : header("location: ../logout");
	exit;
}
