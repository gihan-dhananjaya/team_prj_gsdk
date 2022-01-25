<?php

include 'inc/_base.php';

if (isset($_POST["type"]) && isset($_POST["category"]) && isset($_POST["cat_name"])) {
    $type = intval($_POST["type"]);
    $category = trim($_POST["cat_name"]);

    if (strlen($category) > 0) {
        $data = ["name" => $category];
        if ($type == 1) {
            if ($db->ins_data("cre_cat", $data)) {
                header("location:../cat_mange.php?suc");
            } else {
                header("location:../cat_mange.php?err");
            }
        } elseif ($type == 2) {
            if ($db->ins_data("deb_cat", $data)) {
                header("location:../cat_mange.php?suc");
            } else {
                header("location:../cat_mange.php?err");
            }
        } else {
            header("location:../cat_mange.php");
        }
    } else {
        header("location:../cat_mange.php");
    }
}