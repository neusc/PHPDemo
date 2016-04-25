<?php
include ('book_sc_fns.php');
session_start();
//获取需要显示详细信息的图书的isbn号
$isbn = $_GET['isbn'];
//获取图书的详细信息,包括title、isbn、author等，
$book = getBookDetails($isbn);
doHtmlHeader($book['title']);
//isbn在SQL语句中不需要加引号
//echo $isbn;
//echo $book['title'];
displayBookDetails($book);
$target = "index.php";
if ($book['catid']) {
    $target = "showCat.php?catid=".$book['catid'];
}
//判断是否以管理员身份登录,显示不同的功能菜单
if (checkAdminUser()) {
    displayButton("editBookForm.php?isbn=".$isbn,'edit-item','Edit Item');
    displayButton('admin.php', 'admin-menu','Admin Menu');
    displayButton($target,'continue','Continue');
}else {
    //将此图书添加到购物车按钮
    displayButton("showCart.php?new=".$isbn, "add-to-cart",
                   "Add".$book['title']." To My Shopping Cart");
    displayButton($target, "continue-shopping", "Continue Shopping");
}
doHtmlFooter();
?>