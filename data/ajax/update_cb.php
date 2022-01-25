<?php

include '../inc/_base.php';

if (isset($_POST["data_des"]) && isset($_POST["new_data"]) && isset($_POST["new_dt_type"]) && isset($_POST["dta_id"])) {
    $data_des = trim($_POST["data_des"]);
    $new_data = trim($_POST["new_data"]);
    $new_dt_type = intval($_POST["new_dt_type"]);
    $dta_id = intval($_POST["dta_id"]);

    if ($dta_id > 0) {
        if ($data_des == "data_set_amount") {
            $new_data = floatval($new_data);
            if ($new_dt_type == 1) {
                $db->exc_q("UPDATE `debits` SET `amount` = $new_data WHERE `d_id`=$dta_id");
            } else if ($new_dt_type == 0) {
                $db->exc_q("UPDATE `credits` SET `amount` = $new_data WHERE `c_id`=$dta_id");
            }
        } else if ($data_des == "data_set_des") {
            $new_data = $db->validate_data($new_data);
            if ($new_dt_type == 1) {
                $db->exc_q("UPDATE `debits` SET `description` = '$new_data' WHERE `d_id`=$dta_id");
            } else if ($new_dt_type == 0) {
                $db->exc_q("UPDATE `credits` SET `description` = '$new_data' WHERE `c_id`=$dta_id");
            }
        }
    }
}
