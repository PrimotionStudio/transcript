<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Dashboard - University Transcript Tracking System";
require_once "required/validate.php";

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
      <!-- Top Statistics -->
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Transcript Applications</p>
                    <h5 class="font-weight-bolder">

                      <?php
                      $select_total_transcripts = "SELECT * FROM transcripts WHERE user_id='$user_id'";
                      $query_total_transcripts = mysqli_query($con, $select_total_transcripts);
                      echo mysqli_num_rows($query_total_transcripts);
                      ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Accepted Transcript Applications</p>
                    <h5 class="font-weight-bolder">

                      <?php
                      $select_completed_transcripts = "SELECT * FROM transcripts WHERE user_id='$user_id' AND status = 'completed'";
                      $query_completed_transcripts = mysqli_query($con, $select_completed_transcripts);
                      echo mysqli_num_rows($query_completed_transcripts);
                      ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pending Transcript Applications</p>
                    <h5 class="font-weight-bolder">
                      <?php
                      $select_pending_transcripts = "SELECT * FROM transcripts WHERE user_id='$user_id' AND status = 'pending'";
                      $query_pending_transcripts = mysqli_query($con, $select_pending_transcripts);
                      echo mysqli_num_rows($query_pending_transcripts);
                      ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Rejected Transcript Applications</p>
                    <h5 class="font-weight-bolder">
                      <?php
                      $select_rejected_transcripts = "SELECT * FROM transcripts WHERE user_id='$user_id' AND status = 'rejected'";
                      $query_rejected_transcripts = mysqli_query($con, $select_rejected_transcripts);
                      echo mysqli_num_rows($query_rejected_transcripts);
                      ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4 mx-auto">
          <div class="card z-index-2" style='height: 400px;'>
            <div class="card-header pb-0 p-3 d-flex justify-content-between">
              <h6 class="mb-0">Transcript Applications</h6>
              <form action="" method="post">
                <!-- Make a post request to self and get AI advice -->
                <a href="apply-for-transcript" class="btn btn-primary">Apply for Transcript</a>
              </form>
            </div>
            <div class="card-body p-3">


              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Blockchain ID
                      </th>
                      <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status
                      </th>
                      <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        purpose
                      </th>
                      <th
                        class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Date
                      </th>
                      <th
                        class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select_transcripts = "SELECT * FROM transcripts WHERE user_id = '$user_id' LIMIT 10";
                    $query_transcripts = mysqli_query($con, $select_transcripts);
                    while ($get_transcripts = mysqli_fetch_assoc($query_transcripts)) :
                    ?>
                      <tr>

                        <td
                          class="align-middle text-start">
                          <span class="text-secondary text-xs font-weight-bold mx-3"><?= $get_transcripts["blockchain_id"] ?></span>
                        </td>
                        <td
                          class="align-middle text-sm">
                          <?php
                          if ($get_transcripts["status"] == 'completed') :
                          ?>
                            <span
                              class="badge badge-sm bg-gradient-success">Completed</span>
                          <?php
                          elseif ($get_transcripts["status"] == 'pending') :
                          ?>
                            <span
                              class="badge badge-sm bg-gradient-warning">Pending</span>
                          <?php
                          elseif ($get_transcripts["status"] == 'rejected') :
                          ?>
                            <span
                              class="badge badge-sm bg-gradient-danger">Rejected</span>
                          <?php
                          else :
                          ?>
                            <span
                              class="badge badge-sm bg-gradient-gray">Undefined</span>
                          <?php
                          endif;
                          ?>
                        </td>
                        <td class="align-middle ">
                          <span class="text-secondary text-xs font-weight-bold" id="purpose<?= $get_transcripts["id"] ?>">
                            <?= substr($get_transcripts["purpose"], 0, 20) ?>
                            <?php if (strlen($get_transcripts["purpose"]) > 20) : ?>
                              ...
                              <span id="see-more<?= $get_transcripts["id"] ?>" class='text-primary text-decoration-underline' style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#purpose-modal-<?= $get_transcripts["id"] ?>">See more</span>
                            <?php endif; ?>
                          </span>

                        </td>
                        <td
                          class="align-middle text-end">
                          <span
                            class="text-secondary text-xs font-weight-bold"><?= date('l, M j, Y h:i A', strtotime($get_transcripts["datetime"])) ?></span>
                        </td>
                        <td
                          class="align-middle text-end">
                          <a target='_blank' href="transcript?id=<?= $get_transcripts["id"] ?>" class="btn btn-primary">View</a>
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
  $select_transcripts = "SELECT * FROM transcripts WHERE user_id = '$user_id' LIMIT 10";
  $query_transcripts = mysqli_query($con, $select_transcripts);
  while ($get_transcripts = mysqli_fetch_assoc($query_transcripts)) :
  ?>
    <!-- Modal -->
    <div class="modal fade" tabindex='-1' id="purpose-modal-<?= $get_transcripts["id"] ?>" tabindex="-1" aria-labelledby="purpose-modal-label-<?= $get_transcripts["id"] ?>" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="purpose-modal-label-<?= $get_transcripts["id"] ?>">Full Purpose</h5>
          </div>
          <div class="modal-body">
            <?= $get_transcripts["purpose"] ?>
          </div>
        </div>
      </div>
    </div>
  <?php
  endwhile;
  include_once "included/scripts.php";
  ?>
</body>

</html>