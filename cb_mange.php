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

        <title>Dilanka R | Credit / Debit Management</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <?php include 'inc/header.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-3 mt-5">
                        <h1 class="h3 d-inline align-middle">Credit / Debit Management</h1>
                    </div>
                    <div class="row">

                        <div class="col-12 col-lg-6 mb-0 mt-0 pb-0">

                            <form method="get" action="">
                                <div class="card mb-0 mt-0 pb-0">
                                    <div class="card-body mb-0 pb-0">
                                        <h5 class="card-title mb-2">Credit / Debit</h5>
                                        <select name="type" class="form-select mb-3">
                                            <option value="1" <?= (isset($_GET["type"]) && $_GET["type"] == 1) ? "selected" : null ?>>Debit</option>
                                            <option value="0" <?= (isset($_GET["type"]) && $_GET["type"] == 0) ? "selected" : null ?>>Credit</option>
                                        </select>
                                        <button type="submit" class="btn btn-success">Find</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row m-2 mt-3">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Date Time</th>
                                    <th>Amount</th>
                                    <th class="d-none d-xl-table-cell">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cb_type = (isset($_GET["type"])) ? intval($_GET["type"]) : 1;
                                $avg_max_exp = $db->find_avg_max_exp(date("Y"), date("m"), 0, ($cb_type > 0) ? "debits" : "credits");
                                $tot_exp = $i = 0;
                                if ($cb_type > 0) {
                                    $result = $db->exc_q("SELECT * FROM `debits` WHERE `date` LIKE '%" . date("Y-m") . "%'");
                                } else {
                                    $result = $db->exc_q("SELECT * FROM `credits` WHERE `date` LIKE '%" . date("Y-m") . "%'");
                                }
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($cb_type > 0) {
                                        $p_key = $row["d_id"];
                                        $cat_det = $db->exc_q("SELECT * FROM `deb_cat` WHERE `d_id`=" . $row["cat"], 1);
                                    } else {
                                        $p_key = $row["c_id"];
                                        $cat_det = $db->exc_q("SELECT * FROM `cre_cat` WHERE `cc_id`=" . $row["cat"], 1);
                                    }
                                    $tot_exp += floatval($row["amount"]);
                                    $bg_color = "";
                                    if ($row["amount"] > $avg_max_exp[0]) {
                                        $bg_color = "bg-warning";
                                    }
                                    if ($row["amount"] > $avg_max_exp[1]) {
                                        $bg_color = "bg-danger text-white";
                                    }
                                    ?>
                                    <tr class="<?= $bg_color ?>">
                                        <td><?= ++$i ?></td>
                                        <td ondblclick="ch_ele('<?= $p_key ?>', 'data_set_des')">
                                            <span id="data_set_des_cdata_<?= $p_key ?>"><?= $row["description"] ?></span>
                                            <div class="row col-sm-12" id="data_set_des<?= $p_key ?>" style="display:none">
                                                <div class="col-sm-8">
                                                    <input type="text" id="data_set_des_newData_<?= $p_key ?>" data-id="<?= $cb_type ?>" value="<?= $row["description"] ?>" class="form-control col-2" placeholder="Description">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button onclick="hide_ele('<?= $p_key ?>', 'data_set_des')" class="btn btn-success">&check;</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $cat_det["name"] ?></td>
                                        <td><?= $row["date"] . " " . $row["time"] ?></td>
                                        <td ondblclick="ch_ele('<?= $p_key ?>', 'data_set_amount')">
                                            <span id="data_set_amount_cdata_<?= $p_key ?>"><?= number_format($row["amount"], 2, ".", ",") ?></span>
                                            <div class="row col-sm-12" id="data_set_amount<?= $p_key ?>" style="display:none">
                                                <div class="col-sm-8">
                                                    <input type="number" step="0.00" id="data_set_amount_newData_<?= $p_key ?>" data-id="<?= $cb_type ?>" value="<?= $row["amount"] ?>" class="form-control col-2" placeholder="Amount">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button onclick="hide_ele('<?= $p_key ?>', 'data_set_amount', 1)" class="btn btn-success">&check;</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <?php
                                            if ($cat_det["status"] == 1) {
                                                ?>
                                                <span class="badge bg-primary">Payed</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="badge bg-danger">Still <?= ($cb_type > 0) ? "Paying" : "Reserving" ?></span>
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
                                    <th></th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th><?= number_format($tot_exp, 2, ".", ",") ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </main>
        </div>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>