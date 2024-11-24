<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Profile - Escrow Guarantee P2P";
require_once "required/validate.php";

require_once "func/update-profile.php";
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

        <div class="col-xl-5 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4 pb-0">
              <h5>Edit Profile Information</h5>
            </div>
            <div class="card-body">
              <form role="form" action="" method="post">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" name='name' value="<?= $get_user["name"] ?>">
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" name='email' value="<?= $get_user["email"] ?>">
                </div>
                <div class="mb-3">
                  <label>Phone</label>
                  <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?= $get_user["phone"] ?>">
                </div>
                <label for="">Change passwords here </label>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Current Password" name='current_password'>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" name='password'>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" name='confirm_password'>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Update Information</button>
                </div>
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