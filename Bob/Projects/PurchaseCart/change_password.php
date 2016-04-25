<?php
require_once('book_sc_fns.php');
session_start();
doHtmlHeader('Changing password');
checkAdminUser();
if (!filledOut($_POST)) {
    echo "<p>You have not filled out the form completely.<br/>
         Please try again.</p>";
    doHtmlUrl("admin.php", "Back to administration menu");
    doHtmlFooter();
    exit;
} else {
    $newPasswd = $_POST['newPasswd'];
    $newPasswd2 = $_POST['newPasswd2'];
    $oldPasswd = $_POST['oldPasswd'];
    if ($newPasswd != $newPasswd2) {
        echo "<p>Passwords entered were not the same.  Not changed.</p>";
    } else if ((strlen($newPasswd)>16) || (strlen($newPasswd)<6)) {
        echo "<p>New password must be between 6 and 16 characters.  Try again.</p>";
    } else {
        // attempt update
        if (changePassword($_SESSION['admin'], $oldPasswd, $newPasswd)) {
            echo "<p>Password changed.</p>";
        } else {
            echo "<p>Password could not be changed.</p>";
        }
    }
}
doHtmlUrl("admin.php", "Back to administration menu");
doHtmlFooter();
?>