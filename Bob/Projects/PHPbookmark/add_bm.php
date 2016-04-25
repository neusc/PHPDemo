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
    //���URL�Ƿ���http://ǰ׺��ʼ
    if (strstr($newURL, 'http://') === false) {
        $newURL = 'http://'.$newURL;
    }
    //���������URL�Ƿ���Ч
    if (!(@fopen($newURL,'r'))) {
        throw new Exception('Not a valid URL!');
    }
    //�����ǩ
    addBM($newURL);
    echo 'New bookmark added.<br/><br/>';
    //�����ǰ�û������б�ǩ
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