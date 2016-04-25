<?php
require_once('bookmark_fns.php');
session_start();
//��ȡ��Ҫɾ����ǩ������
$delMe = $_POST['delMe'];
$validUser = $_SESSION['validUser'];
doHtmlHeader("Deleting bookmarks");
try {
checkValidUser();
if (!filledOut($_POST)) {
    echo '<p>You have not chosen any bookmarks to delete.<br/>
        please try again.</p>';
    displayUserMenu();
    doHtmlFooter();
    exit;
}else {
    if (count($delMe)>0) {
        foreach ($delMe as $url) {
            if (deleteBM($validUser,$url)) {
                echo 'Deleted '.htmlspecialchars($url).'</br>';
            }else {
                echo 'Could not delete '.htmlspecialchars($url).'</br>';
            }
        }
    }else {
        echo 'No bookmarks selected for deletion!';
    }
    //�г���ǰ�û���������ǩ
    $urlArray = getUserUrls($validUser);
    if ($urlArray) {
        displayUserUrls($urlArray);
    }
}
} catch (Exception $e) {
    echo $e->getMessage();
}

displayUserMenu();
doHtmlFooter();
?>