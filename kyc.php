<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "KYC - Escrow Guarantee P2P";
require_once "required/validate.php";
require_once "func/kyc.php";
include_once "included/head.php";
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
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM kyc WHERE user_id = '$user_id' AND status='verified'";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                echo "<p>You have already been verified.</p>";
                            } else {
                            ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="kyc" enctype='multipart/form-data'>
                                    <div class="form-group">
                                        <label for="id_type">ID Type</label>
                                        <select name="id_type" id="id_type" class="form-control">
                                            <option value="Driver's License">Driver's License</option>
                                            <option value="International Passport">International Passport</option>
                                            <option value="Government ID">Government ID</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Upload ID image">Upload ID Image</label>
                                        <input type="file" name='id_doc' class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Upload Selfie">Upload Selfie</label>
                                        <input type="file" name='selfie' class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Date of Birth</label>
                                        <input type="date" name='dob' class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Verify</button>
                                </form>
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
</body>

</html>