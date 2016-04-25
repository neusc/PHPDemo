<?php
include ('book_sc_fns.php');
session_start();

doHtmlHeader('Add a book');
if (checkAdminUser()) {
    displayBookForm();
    doHtmlUrl('admin.php','Back to administration menu');
}else {
    echo "<p>You are not authorized to enter the administration area.</p>";
}

doHtmlFooter();
?>