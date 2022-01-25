<?php include 'data/inc/_base.php'; ?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages | <big><b><?= date("Y-m-d") ?></b></big>
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" href="dashboard.php">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="add_cre_deb.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Add Credit / Debit</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="cat_mange.php">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Category Management</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="cb_mange.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Credit / Debit Mng.</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="budg_plan.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Budget Planning</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="data/logout.php">
                    <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="main">

    <nav class="position-fixed w-100 navbar navbar-expand navbar-light navbar-bg" style="z-index:999999">
        <a class="sidebar-toggle p-0 btn text-primary js-sidebar-toggle" href="#">
            <b><h1 id="bill_time">Time</h1></b>
        </a>
        <div class="navbar-collapse collapse m-0">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown float-left">
                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator">4</span>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                        <div class="dropdown-menu-header">
                            4 New Notifications
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-danger" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">Update completed</div>
                                        <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                        <div class="text-muted small mt-1">30m ago</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="#" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>