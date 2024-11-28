<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Clouds - University Transcript Tracking System";
if (isset($_GET["sync"]) && $_GET["sync"] == 'true') {
    $_SESSION['alert'] = 'Cloud changes synced successfully!';
}
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
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card shadow">
                        <div class="card-body text-center">

                            <button class="btn btn-primary my-3" onclick="startProgress()">Sync Cloud Changes</button>
                            <div id="progress-bar" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style='height:10px' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                            <script>
                                function startProgress() {
                                    var progressBar = document.getElementById('progress-bar');
                                    progressBar.style.display = 'block';
                                    var progress = 0;
                                    var intervalId = setInterval(function() {
                                        progress += 10;
                                        document.querySelector('.progress-bar').style.width = progress + '%';
                                        document.querySelector('.progress-bar').innerHTML = progress + '%';
                                        if (progress >= 100) {
                                            clearInterval(intervalId);
                                            setTimeout(function() {
                                                window.location.href = 'index?sync=true';
                                            }, 1000);
                                        }
                                    }, 500);
                                }
                            </script>

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