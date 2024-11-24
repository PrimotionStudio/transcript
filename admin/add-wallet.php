<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Add Wallet - Escrow";
require_once "required/validate.php";
require_once "func/add-wallet.php";
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
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="create-goal">

                                <div class="form-group">
                                    <label for="name">Wallet Name</label>
                                    <input type="text" name='name' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address">Title</label>
                                    <input type="text" name='address' class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Wallet</button>
                            </form>
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