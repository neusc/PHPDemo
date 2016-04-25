<?php

require_once('book_sc_fns.php');
session_start();


if (($_POST['userName']) && ($_POST['passWord'])) {

    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];

    if (login($userName, $passWord)) {
        // if they are in the database register the user id
        $_SESSION['admin'] = $userName;

    } else {
        // unsuccessful login
        doHtmlHeader("Problem:");
        echo "<p>You could not be logged in.<br/>
            You must be logged in to view this page.</p>";
        doHtmlUrl('login.php', 'Login');
        doHtmlFooter();
        exit;
    }
}

doHtmlHeader("Administration");
if (checkAdminUser()) {
    displayAdminMenu();
} else {
    echo "<p>You are not authorized to enter the administration area.</p>";
}
doHtmlFooter();
?>