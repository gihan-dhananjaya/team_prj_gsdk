<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
        <meta name="author" content="AdminKit">
        <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

        <title>Dilanka R | Dashboard</title>

        <link href="css/app.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <?php
            include 'inc/header.php';
            $year = (isset($_GET["y"])) ? $_GET["y"] : 2021;
            ?>
            <main class="content mt-4">
                <div class="container-fluid p-0">
                    <div class="d-none d-lg-block d-xl-block">
                        <h1 class="h3 mb-3 mt-0"><strong>Analytics</strong> Dashboard</h1> 
                        <div class="row col-sm-12">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <select class="form-select" id="ch_date">
                                    <option value="2021" <?= ($year == 2021) ? "selected" : null ?>>2021</option>
                                    <option value="2022" <?= ($year == 2022) ? "selected" : null ?>>2022</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card d-none d-lg-block d-xl-block">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Income</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">
                                                    <?php
                                                    $cre_det = $db->exc_q("SELECT SUM(amount) FROM `credits`", 1);
                                                    if ($cre_det != null) {
                                                        $tot_cre = floatval($cre_det["SUM(amount)"]);
                                                        echo number_format($tot_cre, 2, ".", ",");
                                                    }

                                                    $datestring = $year . "-" . date("m-d") . ' first day of last month';
                                                    $dt = date_create($datestring);
                                                    $prev_ym = $dt->format('Y-m');
                                                    $this_ym = $year . "-" . date("m");

                                                    $cre_det_lm = $db->exc_q("SELECT SUM(amount) FROM `credits` WHERE `date` LIKE '%$prev_ym%'", 1)["SUM(amount)"];
                                                    $cre_det_tm = $db->exc_q("SELECT SUM(amount) FROM `credits` WHERE `date` LIKE '%$this_ym%'", 1)["SUM(amount)"];
                                                    $c_imp = $cre_det_tm - $cre_det_lm;
                                                    ?>
                                                </h1>
                                                <div class="mb-0">
                                                    <?php
                                                    if ($c_imp > 0) {
                                                        ?>
                                                        <span class="text-success"> +<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format($c_imp, 2, ".", ""); ?> </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="text-danger"> -<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format(abs($c_imp), 2, ".", ""); ?> </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <span class="text-muted">Since last month</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">This Month Income</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= number_format($cre_det_tm, 2, ".", ",") ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-muted">last month</span>
                                                    <span class="text-info"> <i class="mdi mdi-arrow-bottom-right"></i> <b><?= number_format($cre_det_lm, 2, ".", ",") ?></b> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card d-none d-lg-block d-xl-block">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Expense</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">
                                                    <?php
                                                    $deb_det = $db->exc_q("SELECT SUM(amount) FROM `debits`", 1);
                                                    if ($deb_det != null) {
                                                        $tot_deb = floatval($deb_det["SUM(amount)"]);
                                                        echo number_format($tot_deb, 2, ".", ",");
                                                    }

                                                    $deb_det_lm = $db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$prev_ym%'", 1)["SUM(amount)"];
                                                    $deb_det_tm = $db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$this_ym%'", 1)["SUM(amount)"];
                                                    $d_imp = $deb_det_tm - $deb_det_lm;
                                                    ?></h1>
                                                <div class="mb-0">
                                                    <?php
                                                    if ($d_imp < 0) {
                                                        ?>
                                                        <span class="text-success"> +<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format(abs($d_imp), 2, ".", ""); ?> </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="text-danger"> -<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format($d_imp, 2, ".", ""); ?> </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <span class="text-muted">Since last month</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">This Month Expense</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= number_format($deb_det_tm, 2, ".", ",") ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-muted">last month</span>
                                                    <span class="text-info"> <i class="mdi mdi-arrow-bottom-right"></i><b> <?= number_format($deb_det_lm, 2, ".", ",") ?> </b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card d-sm-block d-md-block d-lg-none d-xl-none">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">This Month Balance</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= number_format($cre_det_tm - $deb_det_tm, 2, ".", ",") ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-muted">last month</span>
                                                    <span class="text-info"> <i class="mdi mdi-arrow-bottom-right"></i><b> <?= number_format($cre_det_lm - $deb_det_lm, 2, ".", ",") ?> </b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-7 d-none d-lg-block d-xl-block">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Month Wise Income / Expense</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row col-12 col-xxl-12 col-lg-12">

                    <div class="col-lg-4 col-xxl-3 d-flex d-none d-lg-block d-xl-block">
                        <div class="card col-lg-4 flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Most Expensive Categories (5)</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center w-100">
                                    <div class="py-3">
                                        <div class="chart chart-xs">
                                            <canvas id="chartjs-dashboard-pie"></canvas>
                                        </div>
                                    </div>

                                    <table class="table mb-0">
                                        <tbody>
                                            <?php
                                            $cat_ex = $cat_na = [];
                                            $result = $db->exc_q("SELECT cat,SUM(amount) FROM `debits` WHERE `date` LIKE '%$year%' GROUP BY `cat` ORDER BY SUM(amount) DESC LIMIT 5");
                                            while ($row = mysqli_fetch_array($result)) {
                                                $cat_name = $db->exc_q("SELECT * FROM `deb_cat` WHERE `d_id`=" . $row["cat"], 1)["name"];
                                                $cat_na[] = $cat_name;
                                                $cat_ex[] = $row["SUM(amount)"];
                                                ?>
                                                <tr>
                                                    <td><?= $cat_name ?></td>
                                                    <td class="text-end"><?= number_format($row["SUM(amount)"], 2, ".", ",") ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Day Wise Expense</h5>
                            </div>
                            <?= $db->build_calendar(date("m"), $year); ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th class="d-none d-xl-table-cell">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="day_tb_body"> 
                                    <tr class="pt-1">
                                        <td colspan="5" class="text-center p-2">Select Date</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-3">
                        <div class="card d-none d-lg-block d-xl-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Have</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $tm_tot_had = $tot_cre - $tot_deb;
                                    echo number_format($tm_tot_had, 2, ".", ",");
                                    ?>
                                </h1>
                                <div class="mb-0">
                                    <?php
                                    $tot_had_ml = $tm_tot_had - ($cre_det_lm - $deb_det_lm);
                                    if ($tot_had_ml >= 0) {
                                        ?>
                                        <span class="text-success"> +<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format($tot_had_ml, 2, ".", ""); ?> </span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="text-danger"> -<i class="mdi mdi-arrow-bottom-right"></i> <?= number_format(abs($tot_had_ml), 2, ".", ""); ?> </span>
                                        <?php
                                    }
                                    ?>
                                    <span class="text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body bg-dark">
                                <div class="row">
                                    <?php
                                    $m = date("m");
                                    $mon_ex_cat = $db->exc_q("SELECT cat,SUM(amount) FROM `debits` WHERE `date` LIKE '%" . $year . "-" . $m . "%' GROUP BY cat ORDER BY SUM(amount) DESC LIMIT 1", 1);
                                    $exp_cat = ($mon_ex_cat != null) ? $mon_ex_cat["cat"] : 1;
                                    $cat_det = $db->exc_q("SELECT * FROM `deb_cat` WHERE `d_id`=" . $exp_cat, 1);
                                    $deb_t_cat_lm = $db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$prev_ym%' AND `cat`=" . $exp_cat, 1)["SUM(amount)"];
                                    ?>
                                    <div class="col mt-0">
                                        <h5 class="card-title"><?= $cat_det["name"] ?><br>This Month</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat bg-warning warn-anim">
                                            <i class="align-middle " data-feather="alert-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 text-white"><?= number_format(($mon_ex_cat != null) ? $mon_ex_cat["SUM(amount)"] : 0, 2, ".", ",") ?></h1>
                                <div class="mb-0">
                                    <span class="text-muted">last month</span>
                                    <span class="text-info"> <i class="mdi mdi-arrow-bottom-right"></i> <b><?= number_format($deb_t_cat_lm, 2, ".", ",") ?></b> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 col-xxl-12 d-none d-lg-block d-xl-block">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">In <?= $year ?>, Category Wise Expesnses</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th class="d-none d-xl-table-cell">Jan</th>
                                    <th class="d-none d-xl-table-cell">Feb</th>
                                    <th class="d-none d-xl-table-cell">Mar</th>
                                    <th class="d-none d-xl-table-cell">Apr</th>
                                    <th class="d-none d-xl-table-cell">May</th>
                                    <th class="d-none d-xl-table-cell">Jun</th>
                                    <th class="d-none d-xl-table-cell">Jul</th>
                                    <th class="d-none d-xl-table-cell">Aug</th>
                                    <th class="d-none d-xl-table-cell">Sep</th>
                                    <th class="d-none d-xl-table-cell">Oct</th>
                                    <th class="d-none d-xl-table-cell">Nov</th>
                                    <th class="d-none d-xl-table-cell">Dec</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 0;
                                $mon_cat_deb = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                $deb_cat_re = $db->exc_q("SELECT * FROM `deb_cat` ORDER BY `last_update` DESC");
                                while ($deb_cat_row = mysqli_fetch_array($deb_cat_re)) {
                                    $cat = $deb_cat_row["d_id"];
                                    $deb_cat_avg_max = $db->find_avg_max_exp($year, $m, $cat);
                                    $total = 0;
                                    ?>
                                    <tr>
                                        <td><?= ++$index ?></td>
                                        <td><?= $deb_cat_row["name"] ?></td>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $deb = floatval($db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$year" . "-" . sprintf("%02s", $i) . "%' AND `cat`=$cat", 1)["SUM(amount)"]);
                                            $total += $deb;
                                            $mon_cat_deb[$i - 1] += $deb;
                                            $in_cl = "";
                                            if ($deb > 0 && $deb == $deb_cat_avg_max[1]) {
                                                $in_cl = "bg-danger text-white";
                                            } elseif ($deb > $deb_cat_avg_max[0]) {
                                                $in_cl = "bg-warning";
                                            }
                                            ?>
                                            <td class="<?= $in_cl ?>"><?= ($deb > 0) ? number_format($deb, 2, ".", ",") : "" ?></td>
                                            <?php
                                        }
                                        ?>
                                        <td><?= number_format($total, 2, ".", ",") ?></td>
                                        <td>
                                            <?php
                                            if ($deb_cat_row["status"] == 1) {
                                                ?>
                                                <span class=" badge bg-primary">Payed</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="badge bg-danger">Still Paying</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <th>Total</th>
                                    <?php
                                    $g_exp = 0;
                                    for ($i = 0; $i < 12; $i++) {
                                        $g_exp += $mon_cat_deb[$i];
                                        ?>
                                        <td><?= $mon_cat_deb[$i] > 0 ? number_format($mon_cat_deb[$i], 2, ".", ",") : "" ?></td>
                                        <?php
                                    }
                                    ?>
                                    <td><b><?= number_format($g_exp, 2, ".", ",") ?></b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row col-lg-12 col-xxl-12 d-none d-lg-block d-xl-block">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">In <?= $year ?>, Total Balances</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">Jan</th>
                                    <th class="d-none d-xl-table-cell">Feb</th>
                                    <th class="d-none d-xl-table-cell">Mar</th>
                                    <th class="d-none d-xl-table-cell">Apr</th>
                                    <th class="d-none d-xl-table-cell">May</th>
                                    <th class="d-none d-xl-table-cell">Jun</th>
                                    <th class="d-none d-xl-table-cell">Jul</th>
                                    <th class="d-none d-xl-table-cell">Aug</th>
                                    <th class="d-none d-xl-table-cell">Sep</th>
                                    <th class="d-none d-xl-table-cell">Oct</th>
                                    <th class="d-none d-xl-table-cell">Nov</th>
                                    <th class="d-none d-xl-table-cell">Dec</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mon_arr_cre = [];
                                $mon_arr_deb = [];
                                for ($i = 1; $i <= 12; $i++) {
                                    $cre = $db->exc_q("SELECT SUM(amount) FROM `credits` WHERE `date` LIKE '%$year" . "-" . sprintf("%02s", $i) . "%'", 1);
                                    $deb = $db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$year" . "-" . sprintf("%02s", $i) . "%'", 1);
                                    $mon_arr_cre[$i - 1] = ($cre != null ) ? floatval($cre["SUM(amount)"]) : 0;
                                    $mon_arr_deb[$i - 1] = ($deb != null ) ? floatval($deb["SUM(amount)"]) : 0;
                                }
                                ?>
                                <tr>
                                    <?php
                                    $g_bal = 0;
                                    for ($i = 0; $i < 12; $i++) {
                                        $tm_bal = ($mon_arr_cre[$i] - $mon_arr_deb[$i]);
                                        $g_bal += ($tm_bal);
                                        if ($tm_bal > 0) {
                                            ?>
                                            <td class="bg-success"><?= number_format($tm_bal, 2, ".", ",") ?></td>
                                            <?php
                                        } elseif ($tm_bal < 0) {
                                            ?>
                                            <td class="bg-danger text-white"><?= number_format(abs($tm_bal), 2, ".", ",") ?></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td></td>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <td class="<?= $g_bal < 0 ? "bg-danger text-white" : "" ?>"><b><?= number_format($g_bal, 2, ".", ",") ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Recent Expenses</h5>
                            </div>
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th class="d-none d-xl-table-cell">Category</th>
                                        <th class="d-none d-xl-table-cell">Status</th>
                                    </tr>
                                    <tr>
                                        <th class="pb-3">Filter</th>
                                        <th><input class="form-control filter_exp" type="text" id="description"></th>
                                        <th><input class="form-control filter_exp" type="number" id="amount"></th>
                                        <th><input class="form-control filter_exp" type="text"id="date"></th>
                                        <th class="d-none d-xl-table-cell">
                                            <select class="form-select filter_exp_sel" id="cat">
                                                <option value="">Select Option</option>
                                                <?php
                                                $cat_re = $db->exc_q("SELECT * FROM `deb_cat`");
                                                while ($cat_row = mysqli_fetch_array($cat_re)) {
                                                    ?>
                                                    <option value="<?= $cat_row["d_id"] ?>"><?= $cat_row["name"] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </th>
                                        <th class="d-none d-xl-table-cell">
                                            <select class="form-select filter_exp_sel" id="by_type">
                                                <option value="">Select Option</option>
                                                <option value="1">Payed</option>
                                                <option value="0">Still Paying</option>
                                            </select>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="data_body">
                                    <?php
                                    $avg_max_exp = $db->find_avg_max_exp($year, date("m"));
                                    $tot_exp = $i = 0;
                                    $deb_re = $db->exc_q("SELECT * FROM `debits` WHERE `date` LIKE '%$year-$m%' ORDER BY `d_id` DESC");
                                    while ($deb_row = mysqli_fetch_array($deb_re)) {
                                        $cat_det = $db->exc_q("SELECT * FROM `deb_cat` WHERE `d_id`=" . $deb_row["cat"], 1);
                                        $tot_exp += floatval($deb_row["amount"]);
                                        $bg_color = "";
                                        if ($deb_row["amount"] > $avg_max_exp[0]) {
                                            $bg_color = "bg-warning";
                                        }
                                        if ($deb_row["amount"] > $avg_max_exp[1]) {
                                            $bg_color = "bg-danger text-white";
                                        }
                                        ?>
                                        <tr class="<?= $bg_color ?>">
                                            <td><?= ++$i ?></td>
                                            <td><?= $deb_row["description"] ?></td>
                                            <td><?= number_format($deb_row["amount"], 2, ".", ",") ?></td>
                                            <td><?= $deb_row["date"] ?></td>
                                            <td class="d-none d-xl-table-cell"><?= $cat_det["name"] ?></td>
                                            <td class="d-none d-xl-table-cell">
                                                <?php
                                                if ($cat_det["status"] == 1) {
                                                    ?>
                                                    <span class="badge bg-primary">Payed</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="badge bg-danger">Still Paying</span>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th><?= number_format($tot_exp, 2, ".", ",") ?></th>
                                        <th class="d-none d-xl-table-cell"></th>
                                        <th class="d-none d-xl-table-cell"></th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include 'inc/footer.php'; ?>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Line chart
                new Chart(document.getElementById("chartjs-dashboard-line"), {
                    type: "line",
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                                label: "Income",
                                fill: true,
                                backgroundColor: "transparent",
                                borderColor: window.theme.primary,
                                data: <?= json_encode($mon_arr_cre) ?>
                            }, {
                                label: "Expense",
                                fill: true,
                                backgroundColor: "transparent",
                                borderColor: "#adb5bd",
                                borderDash: [4, 4],
                                data: <?= json_encode($mon_arr_deb) ?>
                            }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: false
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                    reverse: true,
                                    gridLines: {
                                        color: "rgba(0,0,0,0.05)"
                                    }
                                }],
                            yAxes: [{
                                    ticks: {
                                        stepSize: 500},
                                    display: true,
                                    borderDash: [5, 5],
                                    gridLines: {
                                        color: "rgba(0,0,0,0)",
                                        fontColor: "#fff"
                                    }
                                }]
                        }
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Pie chart
                new Chart(document.getElementById("chartjs-dashboard-pie"), {
                    type: "pie",
                    data: {
                        labels: <?= json_encode($cat_na) ?>,
                        datasets: [{
                                data: <?= json_encode($cat_ex) ?>,
                                backgroundColor: [
                                    window.theme.primary,
                                    window.theme.warning,
                                    window.theme.danger,
                                    window.theme.black,
                                    window.theme.success
                                ],
                                borderWidth: 5
                            }]
                    },
                    options: {
                        responsive: !window.MSInputMethodContext,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 75
                    }
                });
            });
            $("#ch_date").on('change', function () {
                window.location.href = "dashboard.php?y=" + $(this).val();
            });
        </script>
    </body>

</html>