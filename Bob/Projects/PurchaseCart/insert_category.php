<?php
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Adding a category");
if (checkAdminUser()) {
    if (filledOut($_POST))   {
        $catname = $_POST['catname'];
        if(insertCategory($catname)) {
            echo "<p>Category \"".$catname."\" was added to the database.</p>";
        } else {
            echo "<p>Category \"".$catname."\" could not be added to the database.</p>";
        }
    } else {
        echo "<p>You have not filled out the form.  Please try again.</p>";
    }
    doHtmlUrl('admin.php', 'Back to administration menu');
} else {
    echo "<p>You are not authorised to view this page.</p>";
}

doHtmlFooter();
?>