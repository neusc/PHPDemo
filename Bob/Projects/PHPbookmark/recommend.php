<?php
require_once('bookmark_fns.php');
session_start();
doHtmlHeader('Recommending URLs');
try {
    checkValidUser();
    //向当前用户推荐书签
    $urls = recommendURLs($_SESSION['validUser']);
    //列出推荐的书签
    displayRecommendURLs($urls);
} catch (Exception $e) {
    echo $e->getMessage();
}
echo "<br/><br/>";
displayUserMenu();
doHtmlFooter();
?>