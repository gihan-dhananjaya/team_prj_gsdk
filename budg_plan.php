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

        <link rel="canonical" href="https://demo-basic.adminkit.io/ui-forms.html" />

        <title>Dilanka R | Budget Planning</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <?php include 'inc/header.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-4 mt-5">
                        <h1 class="h3 d-inline align-middle">Budget Planning</h1>
                    </div>
                    <div class="row col-lg-12 mb-3">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <?php
                            $base_in = $db->exc_q("SELECT SUM(amount) FROM `credits` WHERE `date` LIKE '%" . date("Y-m") . "%'", 1);
                            $base_ex = $db->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%" . date("Y-m") . "%'", 1);
                            ?>
                            <input type="number" step="0.00" class="form-control" value="<?= ($base_in != null) ? $base_in["SUM(amount)"] : "" ?>" readonly placeholder="This Month Basic Income">
                        </div>
                        <div class="col-lg-2">
                            <input type="number" step="0.00" class="form-control" value="<?= ($base_ex != null) ? $base_ex["SUM(amount)"] : "" ?>" readonly placeholder="This Month Current Expense">
                        </div>
                        <div class="col-lg-2">
                            <input type="number" step="0.00" id="can_pay" class="form-control" value="<?= ($base_in != null && $base_ex != null) ? floatval($base_in["SUM(amount)"]) - floatval($base_ex["SUM(amount)"]) : "" ?>" placeholder="This Month Balance">
                        </div>
                        <div class="col-lg-2">
                            <input type="number" step="0.00" id="tot_charge" class="form-control" readonly placeholder="Total">
                        </div>
                        <div class="col-lg-2">
                            <input type="number" step="0.00" id="balance" class="form-control" readonly placeholder="Balance">
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <?php
                        $result = $db->exc_q("SELECT * FROM `deb_cat` WHERE `status`=0");
                        while ($row = mysqli_fetch_array($result)) {
                            $cat_max = $db->exc_q("SELECT MAX(amount) FROM `debits` WHERE `cat`=" . $row["d_id"], 1);
                            ?>
                            <div class="col-lg-6">
                                <label for="selections" class="form-label"><?= $row["name"] ?> <spna class="ch_tot_det" id="ch_ele_<?= $row["d_id"] . "_val" ?>">0</spna> / <spna class=""><?= ($cat_max != null) ? $cat_max["MAX(amount)"] : 0 ?></spna></label>
                                <input type="range" class="form-range ch_range" id="ch_ele_<?= $row["d_id"] ?>" name="selections[]" value="0" min="0" max="<?= ($cat_max != null) ? $cat_max["MAX(amount)"] : 0 ?>">
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>