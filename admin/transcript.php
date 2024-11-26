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
                <p><strong>Name:</strong> Martins Okaniawon</p>
                <p><strong>Address:</strong> 35 Wheel Street, Port-Harcourt, Rivers, 500221, Nigeria</p>
                <p><strong>Phone:</strong> +2348149589572</p>
                <p><strong>Email:</strong> student@example.com</p>
            </div>
            <div class="col-md-5">
                <p><strong>Student ID:</strong> 125-35</p>
                <p><strong>Date of Birth:</strong> 01-01-2004</p>
                <p><strong>Termination Date:</strong> -</p>
                <p><strong>Last Date of Attendance:</strong> -</p>
                <p><strong>Status:</strong> ACTIVE</p>
            </div>
            <div class="col-md-1"></div>
        </div>

        <!-- Scores Table -->
        <h5>Scores - SE Foundations <span class="validated-badge">Validated</span></h5>
        <table class="table table-striped table-custom">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Duration</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Month 08</td>
                    <td>06/04/2023 to 02/06/2023</td>
                    <td>168.02%</td>
                </tr>
                <tr>
                    <td>Month 07</td>
                    <td>01/02/2023 to 05/04/2023</td>
                    <td>135.91%</td>
                </tr>
                <!-- Add other months here -->
            </tbody>
        </table>


        <!-- Signature -->
        <div class="row mt-5">
            <div class="col-md-6">
                <p><strong>School Official Signature:</strong></p>
                <p>Marthe Von Middlesor</p>
                <div class="signature-line"></div>
                <p>Date: 24/11/2024</p>
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