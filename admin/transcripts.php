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
                                                Details
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
                                        $select_transcripts = "SELECT * FROM transcripts";
                                        $query_transcripts = mysqli_query($con, $select_transcripts);
                                        while ($get_transcripts = mysqli_fetch_assoc($query_transcripts)) :
                                        ?>
                                            <tr>

                                                <td
                                                    class="align-middle text-start">
                                                    <span class="text-secondary text-xs font-weight-bold mx-3"><?= formatTranscriptId($get_transcripts["blockchain_id"]) ?></span>
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
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#transcript-id-<?= $get_transcripts["blockchain_id"] ?>">
                                                        Details
                                                    </button>
                                                </td>
                                                <td
                                                    class="align-middle text-end">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold"><?= date('l, M j, Y h:i A', strtotime($get_transcripts["datetime"])) ?></span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <?php
                                                    if ($get_transcripts['status'] == 'pending') :
                                                    ?>
                                                        <a href="func/reject_transcript.php?id=<?= $get_transcripts["id"] ?>" class="btn btn-danger">
                                                            ✘
                                                        </a>
                                                        <a href="accept_transcript.php?id=<?= $get_transcripts["id"] ?>" class="btn btn-success">
                                                            ✔
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
    $select_transcripts = "SELECT * FROM transcripts LIMIT 10";
    $query_transcripts = mysqli_query($con, $select_transcripts);
    while ($get_transcripts = mysqli_fetch_assoc($query_transcripts)) :
    ?>
        <!-- Modal -->
        <div class="modal fade" id="transcript-id-<?= $get_transcripts["blockchain_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?= $get_transcripts['blockchain_id'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="modal-body">
                            <p class="mb-2">Name: <?php
                                                    $user_id = $get_transcripts['user_id'];
                                                    $select_user = "SELECT * FROM users WHERE id = '$user_id'";
                                                    $query_user = mysqli_query($con, $select_user);
                                                    $get_user = mysqli_fetch_assoc($query_user);
                                                    echo $get_user['name'];
                                                    ?></p>
                            <p class="mb-2">Matric Number: <?= $get_transcripts['matric'] ?></p>
                            <p class="mb-2">Faculty: <?= $get_transcripts['faculty'] ?></p>
                            <p class="mb-2">Department: <?= $get_transcripts['department'] ?></p>
                            <p class="mb-2">Degree: <?= $get_transcripts['degree'] ?></p>
                            <p class="mb-2">Purpose: <?= $get_transcripts['purpose'] ?></p>
                            <hr>
                            <?php
                            $transcript_id = $get_transcripts['id'];
                            $select_accepted_transcripts = "SELECT * FROM accepted_transcripts WHERE transcript_id = '$transcript_id'";
                            $query_accepted_transcripts = mysqli_query($con, $select_accepted_transcripts);
                            while ($get_accepted_transcripts = mysqli_fetch_assoc($query_accepted_transcripts)) {
                            ?>
                                <p class="mb-2">Course: <?= $get_accepted_transcripts['course'] ?></p>
                                <p class="mb-2">Grade: <?= $get_accepted_transcripts['grade'] ?></p>
                                <hr>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
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