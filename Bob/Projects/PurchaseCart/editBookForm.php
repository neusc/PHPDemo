<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Edit book details");
if (checkAdminUser()) {
    if ($book = getBookDetails($_GET['isbn'])) {
        displayBookForm($book);
    } else {
        echo "<p>Could not retrieve book details.</p>";
    }
    doHtmlUrl("admin.php", "Back to administration menu");
} else {
    echo "<p>You are not authorized to enter the administration area.</p>";
}
doHtmlFooter();
?>