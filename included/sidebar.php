<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" style="z-index: 999;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="index" target="_blank">
            <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"><?= explode(' - ', PAGE_TITLE)[1] ?></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-75 " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'index') {
                                        echo 'active';
                                    }
                                    ?>" href="index">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'create-new-transaction') {
                                        echo 'active';
                                    }
                                    ?>" href="create-new-transaction">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-compass-04 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Create New Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'transactions') {
                                        echo 'active';
                                    }
                                    ?>" href="transactions">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-money-coins text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transactions</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'kyc') {
                                        echo 'active';
                                    }
                                    ?>" href="kyc">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-paper-diploma text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">KYC</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'withdraw') {
                                        echo 'active';
                                    }
                                    ?>" href="withdraw">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-diamond text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Withdraw</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'messages') {
                                        echo 'active';
                                    }
                                    ?>" href="messages">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-user-run text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Messages</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'goals') {
                                        echo 'active';
                                    }
                                    ?>" href="goals">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Goals</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'nutrition') {
                                        echo 'active';
                                    }
                                    ?>" href="nutrition">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-satisfied text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nutrition</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'activities') {
                                        echo 'active';
                                    }
                                    ?>" href="activities">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Activities</span>
                </a>
            </li> -->
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <!-- <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Call our HOT-LINE!</p>
                </div>
            </div>
        </div>
        <a href="tel:+2349012345678" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">(+234) 901 234 5678</a> -->
        <a class="btn btn-primary btn-sm mb-0 w-100" href="logout" type="button">Logout</a>
    </div>
</aside>