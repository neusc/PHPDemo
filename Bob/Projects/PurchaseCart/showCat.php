<?php
include ('book_sc_fns.php');
session_start();
//由于catid通过URL中参数形式传递，只能通过GET方式传递
$catid = $_GET['catid'];
//根据目录标识符获取目录名
$catname = getCategoryName($catid);
//从数据库获取当前目录下的图书信息
$bookArray = getBooks($catid);
//显示当前目录下的图书信息
displayBooks($bookArray);
//判断是否以管理员身份登录,显示不同的功能菜单
if (isset($_SESSION['admin'])) {
    displayButton('index.php','continue','Continue Shopping');
    displayButton('admin.php', 'admin-menu','Admin Menu');
    displayButton("editCategoryForm.php?catid=".$catid,'edit-category','Edit Category');
}else {
    displayButton('index.php','continue','Continue Shopping');
}
doHtmlFooter();
?>