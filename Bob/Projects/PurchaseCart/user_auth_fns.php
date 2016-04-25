<?php
require_once('db_fns.php');
//检查登录用户身份
function checkAdminUser() {
    if (isset($_SESSION['admin'])) {
        return true;
    }else {
        return false;
    }
}
//登录
function login($userName, $passWord) {
    // check username and password with db
    // if yes, return true
    // else return false

    // connect to db
    $conn = dbConnect();
    if (!$conn) {
        return 0;
    }

    // check if username is unique
    $result = $conn->query("select * from admin
                         where username='".$userName."'
                         and password = sha1('".$passWord."')");
    if (!$result) {
        return 0;
    }

    if ($result->num_rows>0) {
        return 1;
    } else {
        return 0;
    }
}
//更改密码
function changePassword($userName, $oldPassword, $newPassword) {
    // change password for username/old_password to new_password
    // return true or false

    // if the old password is right
    // change their password to new_password and return true
    // else return false
    if (login($userName, $oldPassword)) {
        if (!($conn = dbConnect())) {
            return false;
        }

        $result = $conn->query("update admin
                            set password = sha1('".$newPassword."')
                            where username = '".$userName."'");
        if (!$result) {
            return false;  // not changed
        } else {
            return true;  // changed successfully
        }
    } else {
        return false; // old password was wrong
    }
}