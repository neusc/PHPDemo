<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Deleting book");
if (checkAdminUser()) {
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        if(deleteBook($isbn)) {
            echo "<p>Book ".$isbn." was deleted.</p>";
        } else {
            echo "<p>Book ".$isbn." could not be deleted.</p>";
        }
    } else {
        echo "<p>We need an ISBN to delete a book.  Please try again.</p>";
    }
    doHtmlUrl("admin.php", "Back to administration menu");
} else {
    echo "<p>You are not authorised to view this page.</p>";
}

doHtmlFooter();
?>