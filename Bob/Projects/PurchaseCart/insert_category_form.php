<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Add a category");
if (checkAdminUser()) {
    displayCategoryForm();
    doHtmlUrl("admin.php", "Back to administration menu");
} else {
    echo "<p>You are not authorized to enter the administration area.</p>";
}
doHtmlFooter();
?>