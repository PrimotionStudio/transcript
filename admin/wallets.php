<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Admin Wallets - Escrow";
require_once "required/validate.php";

include_once "included/head.php";

function formatWallet(string $tnx_id): string
{
  return substr($tnx_id, 0, 6) . '...' . substr($tnx_id, -3);
}
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
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4 mx-auto">
          <div class="card z-index-2" style='height: 400px;'>
            <div class="card-header pb-0 p-3 d-flex justify-content-between">
              <h6 class="mb-0">Wallets</h6>
              <form action="" method="post">
                <!-- Make a post request to self and get AI advice -->
                <a href="add-wallet" class="btn btn-primary">Add Wallet</a>
              </form>
            </div>
            <div class="card-body p-3">


              <div class="table-responsive p-0">
                <table
                  class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th
                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                        Wallet Name
                      </th>
                      <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Amount
                      </th>
                      <th
                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                        Wallet Address
                      </th>
                      <th
                        class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select_wallet = "SELECT * FROM wallet";
                    $query_wallet = mysqli_query($con, $select_wallet);
                    while ($get_wallet = mysqli_fetch_assoc($query_wallet)) :
                    ?>
                      <tr>

                        <td
                          class="align-middle text-center">
                          <span
                            class="text-secondary text-xs font-weight-bold"><?= strtoupper($get_wallet["wallet_name"]) ?></span>
                        </td>
                        <td
                          class="align-middle text-center">
                          <span
                            class="text-secondary text-xs font-weight-bold"><?php
                                                                            $select_payments = "SELECT * FROM payment_request WHERE wallet_name='" . $get_wallet['wallet_name'] . "'";
                                                                            $query_payments = mysqli_query($con, $select_payments);
                                                                            $total_amount = 0;
                                                                            while ($get_payments = mysqli_fetch_assoc($query_payments)) :
                                                                              $total_amount += $get_payments['amount'];
                                                                            endwhile;
                                                                            echo number_format($total_amount, 2);
                                                                            ?></span>
                        </td>
                        <td
                          class="align-middle text-center">
                          <span
                            class="text-secondary text-xs font-weight-bold"><?= formatWallet($get_wallet["wallet_addr"]) ?></span>
                        </td>
                        <td
                          class="align-middle text-end">
                          <button class="btn btn-danger">
                            <a class='text-white' href="func/remove-wallet?id=<?= $get_wallet['id'] ?>">Remove</a>
                          </button>

                        </td>

                      </tr>
                    <?php
                    endwhile;
                    ?>
                  </tbody>
                </table>
              </div>

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