<?php
include '../inc/_base.php';

if (isset($_POST["cb_type"])) {
    $cb_type = intval($_POST["cb_type"]);
    if ($cb_type == 1) {
        ?>
        <option selected>Open this select menu</option>
        <?php
        $result = $db->sel_data("cre_cat");
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?= $row["cc_id"] ?>"><?= $row["name"] ?></option>
            <?php
        }
    } else {
        ?>
        <option selected>Open this select menu</option>
        <?php
        $result = $db->sel_data("deb_cat");
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?= $row["d_id"] ?>"><?= $row["name"] ?></option>
            <?php
        }
    }
}