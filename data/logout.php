<?php

include 'inc/_base.php';

if (isset($_SESSION["c_user_login"])) {
    $last_login_to = date("Y-m-d H:i:s");
    $db->exc_q("UPDATE `users` SET `last_login_to`='$last_login_to' WHERE `u_id`=1");
    unset($_SESSION["c_user_login"]);
}
header("location:../");
