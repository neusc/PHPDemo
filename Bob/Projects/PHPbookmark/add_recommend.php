<?php
/*��չ��
 * ���Ƽ�����ǩ��ӵ���ǰ�û��Լ�����ǩ�б�  */
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
                //addBM()�������Ը���
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
    //������Ƽ���ǩ�����ڵ�ǰ�û���������ǩ�б�
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