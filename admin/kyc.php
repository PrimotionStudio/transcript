<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "KYC - Escrow";
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
                            <h4 class="font-weight-bolder">KYC Verification</h4>
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
                                                ID Type
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID Document
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Selfie
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date of Birth
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
                                        $select_kyc = "SELECT * FROM kyc ORDER BY id DESC";
                                        $query_kyc = mysqli_query($con, $select_kyc);
                                        while ($get_kyc = mysqli_fetch_assoc($query_kyc)) :
                                        ?>
                                            <tr>

                                                <td class="align-middle text-start text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <?php
                                                        $select_kyc_user = "SELECT * FROM users WHERE id = '" . $get_kyc['user_id'] . "'";
                                                        $query_kyc_user = mysqli_query($con, $select_kyc_user);
                                                        $get_kyc_user = mysqli_fetch_assoc($query_kyc_user);
                                                        echo $get_kyc_user["name"] . "<br>";
                                                        echo $get_kyc_user["email"];
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= strtoupper($get_kyc["id_type"]) ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="../<?= $get_kyc["id_doc"] ?>" data-lightbox="image-1">
                                                        <img src="../<?= $get_kyc["id_doc"] ?>" alt="ID Document" height="100">
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="../<?= $get_kyc["selfie"] ?>" data-lightbox="image-2">
                                                        <img src="../<?= $get_kyc["selfie"] ?>" alt="Selfie" height="100">
                                                    </a>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= date("M j, Y", strtotime($get_kyc["dob"])) ?></span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= date("M j, Y h:i A", strtotime($get_kyc["datetime"])) ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php
                                                    if ($get_kyc["status"] == 'verified') :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-success">Verified</span>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <span
                                                            class="badge badge-sm bg-gradient-warning">Not Verified</span>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="func/accept_kyc.php?id=<?= $get_kyc["id"] ?>" class="btn btn-success">
                                                        ✔
                                                    </a>
                                                    <a href="func/reject_kyc.php?id=<?= $get_kyc["id"] ?>" class="btn btn-danger">
                                                        ✘
                                                    </a>
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