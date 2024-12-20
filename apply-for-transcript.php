<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Apply For Transcript - University Transcript Tracking System";
require_once "required/validate.php";

require_once "func/apply-for-transcript.php";
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
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="create-goal">

                                <div class="form-group">
                                    <label for="matric">Student ID/Matriculation Number</label>
                                    <input type="text" class="form-control" id="matric" name="matric" required>
                                </div>
                                <div class="form-group">
                                    <label for="faculty">Faculty</label>
                                    <input type="text" class="form-control" id="faculty" name="faculty" required>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department/Program of Study</label>
                                    <input type="text" class="form-control" id="department" name="department" required>
                                </div>
                                <div class="form-group">
                                    <label for="degree">Degree Type</label>
                                    <select class="form-control" id="degree" name="degree" required>
                                        <option disabled selected>Select Degree Type</option>
                                        <option value="BSc">BSc</option>
                                        <option value="MSc">MSc</option>
                                        <option value="PhD">PhD</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="purpose">Purpose of the Transcript </label>
                                    <textarea class="form-control" id="purpose" name="purpose" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Apply</button>
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