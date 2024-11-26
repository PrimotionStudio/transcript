<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "University Transcript Tracking System - Admin Login";
require_once "func/login.php";
include_once "included/head.php";
?>

<body class="">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="#">
                <?= PAGE_TITLE ?>
            </a>
        </div>
    </nav>
    <!-- End Navbar -->

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form role="form" action="" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Username" name='name' aria-label="Username">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name='password' aria-label="Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once "included/scripts.php";
    ?>
</body>

</html>