<?php
require_once('bookmark_fns.php');
session_start();
$newURL = $_POST['newURL'];
doHtmlHeader('Adding bookmarks');
try {
    checkValidUser();
    if (!filledOut($_POST)) {
        throw new Exception('Form not completely filled out');
    }
    //检测URL是否以http://前缀开始
    if (strstr($newURL, 'http://') === false) {
        $newURL = 'http://'.$newURL;
    }
    //测试输入的URL是否有效
    if (!(@fopen($newURL,'r'))) {
        throw new Exception('Not a valid URL!');
    }
    //添加书签
    addBM($newURL);
    echo 'New bookmark added.<br/><br/>';
    //输出当前用户的所有标签
    $urlArray = getUserUrls($_SESSION['validUser']);
    if ($urlArray) {
        displayUserUrls($urlArray);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
displayUserMenu();
doHtmlFooter();
?>