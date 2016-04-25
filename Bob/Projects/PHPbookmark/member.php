<?php
require_once('bookmark_fns.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {
    try {
        login($username, $password);
        $_SESSION['validUser'] = $username;
    } catch (Exception $e) {
        doHtmlHeader('Problem:');
        echo 'You could not be logged in.You must be logged in to view this page.';
        doHtmlUrl('login.php','Login');
        doHtmlFooter();
        exit;
    };
}
//登录成功后显示会员页面
doHtmlHeader('Home');
//检测当前用户是否拥有一个注册的会话
//针对没有登录却处于会话当中的用户
checkValidUser();
//获取该用户保存的书签
$urlArray = getUserUrls($_SESSION['validUser']);
if ($urlArray) {
    //以表格的形式输出标签
    displayUserUrls($urlArray);
}
//列出选项清单
displayUserMenu();
doHtmlFooter();
?>