<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Adding a book");
//检测管理员身份
if (checkAdminUser()) {
    if (filledOut($_POST)) {
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $catid = $_POST['catid'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        //插入图书信息到数据库
        if(insertBook($isbn, $title, $author, $catid, $price, $description)) {
            echo "<p>Book <em>".stripslashes($title)."</em> was added to the database.</p>";
        } else {
            echo "<p>Book <em>".stripslashes($title)."</em> could not be added to the database.</p>";
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