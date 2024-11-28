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
                                    if ($route === 'profile') {
                                        echo 'active';
                                    }
                                    ?>" href="profile">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-user-run text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'transcripts') {
                                        echo 'active';
                                    }
                                    ?>" href="transcripts">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transcripts Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php
                                    $file_path = explode("/", $_SERVER["SCRIPT_NAME"]);
                                    $file_name = end($file_path);
                                    $route = explode(".", $file_name)[0];
                                    if ($route === 'cloud') {
                                        echo 'active';
                                    }
                                    ?>" href="cloud">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-cloud-upload-96 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sync Cloud Changes</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <a class="btn btn-primary btn-sm mb-0 w-100" href="logout" type="button">Logout</a>
    </div>
</aside>