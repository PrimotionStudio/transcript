<?php
require_once "required/session.php";
require_once "required/sql.php";
const PAGE_TITLE = "Users - Escrow";
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
                            <h4 class="font-weight-bolder">Users</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table
                                    class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phone
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payout Balance
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_users = "SELECT * FROM users ORDER BY id DESC";
                                        $query_users = mysqli_query($con, $select_users);
                                        while ($get_users = mysqli_fetch_assoc($query_users)) :
                                        ?>
                                            <tr>
                                                <td class="align-middle text-start text-sm">
                                                    <?= htmlspecialchars($get_users['name']); ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?= htmlspecialchars($get_users['email']); ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?= htmlspecialchars($get_users['phone']); ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?= number_format($get_users['payout_balance'], 2); ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addFundsModal<?= $get_users['id']; ?>">Add Funds</a></li>
                                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deductFundsModal<?= $get_users['id']; ?>">Deduct Funds</a></li>
                                                        </ul>

                                                        <!-- Add Funds Modal -->
                                                        <div class="modal fade" id="addFundsModal<?= $get_users['id']; ?>" tabindex="-1" aria-labelledby="addFundsModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="addFundsModalLabel">Add Funds to <?= htmlspecialchars($get_users['name']); ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="func/add-funds" method="post">
                                                                            <input type="hidden" name="user" value="<?= $get_users['id']; ?>">
                                                                            <div class="mb-3">
                                                                                <label for="amount" class="form-label">Amount:</label>
                                                                                <input type="number" class="form-control"
                                                                                    step="0.00001" id="amount" name="amount" required>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary">Add Funds</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Deduct Funds Modal -->
                                                        <div class="modal fade" id="deductFundsModal<?= $get_users['id']; ?>" tabindex="-1" aria-labelledby="deductFundsModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deductFundsModalLabel">Deduct Funds from <?= htmlspecialchars($get_users['name']); ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="func/deduct-funds" method="post">
                                                                            <input type="hidden" name="user" value="<?= $get_users['id']; ?>">
                                                                            <div class="mb-3">
                                                                                <label for="amount" class="form-label">Amount:</label>
                                                                                <input type="number" class="form-control"
                                                                                    step="0.00001" id="amount" name="amount" required>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary">Deduct Funds</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                            </div>
                        </div>
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