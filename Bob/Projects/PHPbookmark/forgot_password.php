<?php
require_once('bookmark_fns.php');
doHtmlHeader('Resetting password');
$username = $_POST['username'];
try {
    //�������벢�������ݿ�
    $newPassword = resetPassword($username);
    //�����ú�����뷢�͵��û�����
    mailPassword($username,$newPassword);
    echo 'Your new password has been emailed to you.<br/>';
} catch (Exception $e) {
    echo 'Your password could not be reset - please try again later.';
}
doHtmlUrl('login.php', 'Login');
doHtmlFooter();
?>