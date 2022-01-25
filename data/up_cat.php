<?php

include 'inc/_base.php';

if (isset($_POST["data_id"]) && isset($_POST["new_type"]) && isset($_POST["new_name"]) && isset($_POST["new_status"])) {
    $type = intval($_POST["new_type"]);
    $category = trim($_POST["new_name"]);
    $data_id = intval($_POST["data_id"]);
    $status = intval($_POST["new_status"]);

    if (isset($_POST["update"])) {
        if ($type == 1) {
            if ($db->exc_q("UPDATE `cre_cat` SET `name`='$category' , `status`=$status WHERE `cc_id`=$data_id")) {
                header("location:../cat_mange.php?up_suc");
            } else {
                header("location:../cat_mange.php?err");
            }
        } elseif ($type == 2) {
            if ($db->exc_q("UPDATE `deb_cat` SET `name`='$category' , `status`=$status WHERE `d_id`=$data_id")) {
                header("location:../cat_mange.php?up_suc");
            } else {
                header("location:../cat_mange.php?err");
            }
        } else {
            header("location:../cat_mange.php");
        }
    } else if (isset($_POST["delete"])) {
        if ($type == 1) {
            $have_data = $db->exc_q("SELECT * FROM `credits` WHERE `cat`=$data_id");
            if ($have_data == null) {
                if ($db->exc_q("DELETE FROM `cre_cat` WHERE `cc_id`=$data_id")) {
                    header("location:../cat_mange.php?del_suc");
                } else {
                    header("location:../cat_mange.php?err");
                }
            } else {
                header("location:../cat_mange.php?data_exis_err");
            }
        } elseif ($type == 2) {
            $have_data = $db->exc_q("SELECT * FROM `debits` WHERE `cat`=$data_id");
            if ($have_data == null) {
                if ($db->exc_q("DELETE FROM `deb_cat` WHERE `d_id`=$data_id")) {
                    header("location:../cat_mange.php?del_suc");
                } else {
                    header("location:../cat_mange.php?err");
                }
            } else {
                header("location:../cat_mange.php?data_exis_err");
            }
        } else {
            header("location:../cat_mange.php");
        }
    } else {
        header("location:../cat_mange.php");
    }
}