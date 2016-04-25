<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Updating book");
if (checkAdminUser()) {
    if (filledOut($_POST)) {
        $oldisbn = $_POST['oldisbn'];
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $catid = $_POST['catid'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        if(updateBook($oldisbn, $isbn, $title, $author, $catid, $price, $description)) {
            echo "<p>Book was updated.</p>";
        } else {
            echo "<p>Book could not be updated.</p>";
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