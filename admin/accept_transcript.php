<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Accept Transcript - University Transcript Tracking System";
require_once "required/validate.php";
if (isset($_GET['id'])) {
    $transcript_id = $_GET['id'];
    $select_transcripts = "SELECT * FROM transcripts WHERE id='$transcript_id'";
    $query_transcripts = mysqli_query($con, $select_transcripts);
    $get_transcripts = mysqli_fetch_assoc($query_transcripts);
} else {
    header("Location: index.php");
    exit;
}
require_once "func/accept-transcript.php";
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
                    </div>
                </div>

                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="create-goal">

                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" class="form-control" id="course" name="course" required>
                                </div>
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control" id="grade" name="grade" required>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type='submit' value="add" class="btn btn-secondary">Add</button>
                                    <button type="submit" value='accept' class="btn btn-primary">Accept</button>
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