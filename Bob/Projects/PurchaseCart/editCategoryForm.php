<?php

// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Edit category");
if (checkAdminUser()) {
    if ($catname = getCategoryName($_GET['catid'])) {
        $catid = $_GET['catid'];
        $cat = compact('catname', 'catid');
        displayCategoryForm($cat);
    } else {
        echo "<p>Could not retrieve category details.</p>";
    }
    doHtmlUrl("admin.php", "Back to administration menu");
} else {
    echo "<p>You are not authorized to enter the administration area.</p>";
}
doHtmlFooter();
?>