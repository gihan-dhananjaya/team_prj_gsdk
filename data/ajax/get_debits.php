<?php
include '../inc/_base.php';

if (isset($_POST["sel_date"])) {
    $req_val = $_POST["sel_date"];
    $deb_re = $db->exc_q("SELECT * FROM `debits` WHERE `date` LIKE '%$req_val%' ORDER BY `d_id` DESC");

    $avg_max_exp = $db->find_avg_max_exp(date("Y"), date("m"));
    $tot_exp = $i = 0;
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
            <td class="d-xl-table-cell"><?= $cat_det["name"] ?></td>
            <td><?= number_format($deb_row["amount"], 2, ".", ",") ?></td>
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
        <th class="d-xl-table-cell"></th>
        <th><?= number_format($tot_exp, 2, ".", ",") ?></th>
        <th class="d-xl-table-cell"></th>
    </tr>
    <tr>
        <th colspan="5" class="text-center"><?= $req_val ?></th>
    </tr>
    <?php
}