<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
if (isset($_GET['id'])) {
    $select_transcripts = "SELECT * FROM transcripts WHERE id='" . $_GET['id'] . "'";
    $query_transcripts = mysqli_query($con, $select_transcripts);
    $get_transcripts = mysqli_fetch_assoc($query_transcripts);
} else {
    header('Location: index');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript</title>
    <!-- Include Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        .table-custom {
            background-color: #f8f9fa;
        }

        .validated-badge {
            font-size: 14px;
            color: #ffffff;
            background-color: #28a745;
            border-radius: 12px;
            padding: 2px 10px;
            display: inline-block;
        }

        .header-title {
            font-weight: bold;
            font-size: 18px;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 200px;
            margin-top: 5px;
        }

        .footer-button {
            background-color: #d9534f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .footer-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <!-- Header -->
        <!-- <div class="row">
            <div class="col-md-12 text-center">
                <img src="https://via.placeholder.com/80/80" alt="ALX Logo" class="mb-2">
                <h4 class="header-title">Student Transcript</h4>
            </div>
        </div> -->

        <!-- Student Details -->
        <div class="row my-4">
            <!-- <div class="col-md-2">
                <img src="https://via.placeholder.com/80/80" alt="Student Photo" class="profile-pic">
            </div> -->
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <p><strong>Name:</strong> <?= $get_user['name'] ?></p>
                <p><strong>Phone:</strong> <?= $get_user['phone'] ?></p>
                <p><strong>Email:</strong> <?= $get_user['email'] ?></p>
            </div>
            <div class="col-md-5">
                <p><strong>Matriculation Number:</strong> <?= $get_transcripts['matric'] ?></p>
                <p><strong>Faculty:</strong> <?= $get_transcripts['faculty'] ?></p>
                <p><strong>Department:</strong> <?= $get_transcripts['department'] ?></p>
                <p><strong>Degree:</strong> <?= $get_transcripts['degree'] ?></p>
            </div>
            <div class="col-md-1"></div>
        </div>

        <!-- Scores Table -->
        <h5>Academics - <span class="validated-badge">Validated</span></h5>
        <table class="table table-striped table-custom">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_accepted_transcripts = "SELECT * FROM accepted_transcripts WHERE transcript_id = '" . $get_transcripts['id'] . "'";
                $query_accepted_transcripts = mysqli_query($con, $select_accepted_transcripts);
                while ($get_accepted_transcripts = mysqli_fetch_assoc($query_accepted_transcripts)) :
                ?>
                    <tr>
                        <td><?= $get_accepted_transcripts['course'] ?></td>
                        <td><?= $get_accepted_transcripts['grade'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


        <!-- Signature -->
        <div class="row mt-5">
            <div class="col-md-6">
                <p><strong>School Official Signature:</strong></p>
                <p><?php
                    $select_admin = "SELECT * FROM admin WHERE id = '1'";
                    $query_admin = mysqli_query($con, $select_admin);
                    $get_admin = mysqli_fetch_assoc($query_admin);
                    echo $get_admin['name']; ?></p>
                <div class="signature-line"></div>
                <p>Date: <?= date('d/m/Y', strtotime($get_transcripts['date_issued'])); ?></p>
            </div>
        </div>

        <!-- Footer Button -->
        <div class="row mt-4">
            <div class="col-md-12 text-end">
                <button class="footer-button" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</body>

</html>