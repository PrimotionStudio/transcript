<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Escrow Guarantee P2P - Register";
require_once "func/register.php";
include_once "included/head.php";
?>

<body class="">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="#">
        <?= PAGE_TITLE ?>
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto">
        </ul>
        <ul class="navbar-nav d-lg-block d-none">
          <li class="nav-item">
            <a href="login" class="btn btn-sm mb-0 me-1 bg-gradient-light">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-primary opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome to <?= PAGE_TITLE ?>!</h1>
            <p class="text-lead text-white">Our escrow service ensures safe and secure transactions for both buyers and sellers. No more worries about online deals.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Sign Up</h5>
            </div>
            <div class="card-body">
              <form role="form" action="" method="post">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" name='name' aria-label="Name">
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" name='email' aria-label="Email">
                </div>
                <div class="mb-3">
                  <input type="tel" class="form-control" placeholder="Phone" name='phone' aria-label="Phone">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" name='password' aria-label="Password">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" name='confirm_password' aria-label="Password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login" class="text-dark font-weight-bolder">Sign in</a></p>
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