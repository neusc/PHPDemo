<?php
require_once('bookmark_fns.php');
session_start();
doHtmlHeader('Recommending URLs');
try {
    checkValidUser();
    //��ǰ�û��Ƽ���ǩ
    $urls = recommendURLs($_SESSION['validUser']);
    //�г��Ƽ�����ǩ
    displayRecommendURLs($urls);
} catch (Exception $e) {
    echo $e->getMessage();
}
echo "<br/><br/>";
displayUserMenu();
doHtmlFooter();
?>