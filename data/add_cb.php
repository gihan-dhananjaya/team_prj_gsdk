<?php

include 'inc/_base.php';

if (isset($_POST["type"]) && isset($_POST["amount"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["date"])) {
    $type = intval($_POST["type"]);
    $amount = floatval($_POST["amount"]);
    $category = intval($_POST["category"]);
    $description = trim($_POST["description"]);
    $date = trim($_POST["date"]);

    if ($amount > 0) {
        $data = ["amount" => $amount, "cat" => $category, "description" => $description, "date" => $date, "time" => date("H:i:s")];
        if (isset($_POST["cat_name"]) && !empty($_POST["cat_name"])) {
            $cat_data = ["name" => trim($_POST["cat_name"])];
            $result = $db->ins_data(($type == 1) ? "cre_cat" : "deb_cat", $cat_data);
            if ($result) {
                $data["cat"] = $db->ins_id;
            } else {
                header("location:../add_cre_deb.php");
            }
        }
        if ($type == 1) {
            $db->exc_q("UPDATE `cre_cat` SET `last_update` = '". date("Y-m-d H:i:s")."' WHERE `cc_id`=$category");
            if ($db->ins_data("credits", $data)) {
                header("location:../add_cre_deb.php?suc");
            } else {
                header("location:../add_cre_deb.php?err");
            }
        } else {
            $db->exc_q("UPDATE `deb_cat` SET `last_update` = '". date("Y-m-d H:i:s")."' WHERE `d_id`=$category");
            if ($db->ins_data("debits", $data)) {
                header("location:../add_cre_deb.php?suc");
            } else {
                header("location:../add_cre_deb.php?err");
            }
        }
    } else {
        header("location:../add_cre_deb.php");
    }
} else {
    header("location:../add_cre_deb.php");
}