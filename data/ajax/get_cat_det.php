<?php

include '../inc/_base.php';

$cat_det = 0;
if (isset($_POST["cb_type"]) && isset($_POST["cat"])) {
    $cb_type = intval($_POST["cb_type"]);
    $cat = intval($_POST["cat"]);

    if ($cb_type == 1) {
        $cat_det = $db->exc_q("SELECT * FROM `cre_cat` WHERE `cc_id`=$cat", 1);
        $cat_det["data_id"] = $cat_det["cc_id"];
    } else {
        $cat_det = $db->exc_q("SELECT * FROM `deb_cat` WHERE `d_id`=$cat", 1);
        $cat_det["data_id"] = $cat_det["d_id"];
    }
    if ($cat_det == null) {
        $cat_det = 0;
    }
}
echo json_encode($cat_det);
