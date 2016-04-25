<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Updating category");
if (checkAdminUser()) {
    if (filledOut($_POST)) {
        if(updateCategory($_POST['catid'], $_POST['catname'])) {
            echo "<p>Category was updated.</p>";
        } else {
            echo "<p>Category could not be updated.</p>";
        }
    } else {
        echo "<p>You have not filled out the form.  Please try again.</p>";
    }
    doHtmlUrl("admin.php", "Back to administration menu");
} else {
    echo "<p>You are not authorised to view this page.</p>";
}
doHtmlFooter();
?>