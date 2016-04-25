<?php
/*扩展：
 * 将推荐的书签添加到当前用户自己的书签列表  */
require_once('bookmark_fns.php');
session_start();
$recommendURLs = $_POST['recommend'];
$validUser = $_SESSION['validUser'];
doHtmlHeader("Adding recommendURLs");
try {
    checkValidUser();
    if (!filledOut($_POST)) {
        echo '<p>You have not chosen any bookmarks to add.<br/>
        please try again.</p>';
        displayUserMenu();
        doHtmlFooter();
        exit;
    }else {
        if (count($recommendURLs)>0) {
            foreach ($recommendURLs as $url) {
                //addBM()函数可以复用
                if (addBM($url)) {
                    echo 'Added successfully! '.$url.'<br/><br/>';
                }
                else {
                    echo 'Could not add recommendURLs!';
                }
            };
        }else {
            echo "No recommend bookmarks selected for add!";
        }
    }
    //添加完推荐书签后现在当前用户的最新书签列表
    $urlArray = getUserUrls($validUser);
    if ($urlArray) {
        displayUserUrls($urlArray);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
echo "<br/><br/>";
displayUserMenu();
doHtmlFooter();
?>