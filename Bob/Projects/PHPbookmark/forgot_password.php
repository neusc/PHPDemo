<?php
require_once('bookmark_fns.php');
doHtmlHeader('Resetting password');
$username = $_POST['username'];
try {
    //重置密码并更新数据库
    $newPassword = resetPassword($username);
    //将重置后的密码发送到用户邮箱
    mailPassword($username,$newPassword);
    echo 'Your new password has been emailed to you.<br/>';
} catch (Exception $e) {
    echo 'Your password could not be reset - please try again later.';
}
doHtmlUrl('login.php', 'Login');
doHtmlFooter();
?>