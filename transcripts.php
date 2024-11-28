<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Transcripts - Escrow Guarantee P2P";
require_once "required/validate.php";

include_once "included/head.php";
function formatTranscriptId(string $tnx_id): string
{
    return substr($tnx_id, 0, 3) . '...' . substr($tnx_id, -3);
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
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bolder">Transcripts Application History</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_transcripts = "SELECT * FROM transcripts WHERE user_id = '$user_id'";
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