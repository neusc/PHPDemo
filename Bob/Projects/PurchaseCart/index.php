<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader('Welcome to Book-O-Rama');

echo 'Please choose a category';
//从数据库获得图书目录的数组
$catArray = getCategories();
//显示当前图书的所有目录
displayCategories($catArray);
//如果作为管理员用户登录,需要显示添加、删除和编辑目录的链接
if (isset($_SESSION['admin'])) {
    displayButton('admin.php','admin-menu','Admin Menu');
}
doHtmlFooter();
?>
      