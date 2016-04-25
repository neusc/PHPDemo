<?php
require_once('bookmark_fns.php');
session_start();
doHtmlHeader('Changing password');
$oldPasswd = $_POST['oldPasswd'];
$newPasswd = $_POST['newPasswd'];
$newPasswd2 = $_POST['newPasswd2'];

try {
    checkValidUser();
    if (!filledOut($_POST)) {
        throw new Exception('You have not filled out the form completely.Please try again');
    }
    if ($newPasswd != $newPasswd2) {
        throw new Exception('Passwords entered were not same. Not changed');
    }
    if ((strlen($newPasswd) < 6) || (strlen($newPasswd) > 16)) {
        throw new Exception('New password must be between 6 and 16 characters.Try again');
    }
    //¸üĞÂÃÜÂë
    changePassword($_SESSION['validUser'],$oldPasswd,$newPasswd);
    echo 'Password changed.<br/>';
} catch (Exception $e) {
    echo $e->getMessage();
}
displayUserMenu();
doHtmlFooter();
?>