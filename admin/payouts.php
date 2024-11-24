<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Payouts - Escrow";
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
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bolder">Payouts</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table
                                    class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User Name/Email
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date/Time
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_payouts = "SELECT * FROM payouts ORDER BY id DESC";
                                        $query_payouts = mysqli_query($con, $select_payouts);
                                        while ($get_payouts = mysqli_fetch_assoc($query_payouts)) :
                                        ?>
                                            <tr>

                                                <td class="align-middle text-start text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <?php
                                                        $select_payouts_user = "SELECT * FROM users WHERE id = '" . $get_payouts['user_id'] . "'";
                                                        $query_payouts_user = mysqli_query($con, $select_payouts_user);
                                                        $get_payouts_user = mysqli_fetch_assoc($query_payouts_user);
                                                        echo $get_payouts_user["name"] . "<br>";
                                                        echo $get_payouts_user["email"];
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $get_payouts["amount"] ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= date("M j, Y h:i A", strtotime($get_payouts["datetime"])) ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php
                                                    if ($get_payouts["status"] == 'approved') :
                                                    ?>
                                                        <span class="badge badge-sm bg-gradient-success">Paid</span>
                                                    <?php
                                                    elseif ($get_payouts["status"] == 'pending') :
                                                    ?>
                                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php
                                                    if ($get_payouts["status"] == 'pending') :
                                                    ?>
                                                        <a href="func/pay_payout.php?id=<?= $get_payouts["id"] ?>" class="btn btn-success">
                                                            ✔
                                                        </a>
                                                        <a href="func/reject_payout.php?id=<?= $get_payouts["id"] ?>" class="btn btn-danger">
                                                            ✘
                                                        </a>
                                                    <?php
                                                    endif;
                                                    ?>
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