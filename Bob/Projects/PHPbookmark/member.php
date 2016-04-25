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
//��¼�ɹ�����ʾ��Աҳ��
doHtmlHeader('Home');
//��⵱ǰ�û��Ƿ�ӵ��һ��ע��ĻỰ
//���û�е�¼ȴ���ڻỰ���е��û�
checkValidUser();
//��ȡ���û��������ǩ
$urlArray = getUserUrls($_SESSION['validUser']);
if ($urlArray) {
    //�Ա�����ʽ�����ǩ
    displayUserUrls($urlArray);
}
//�г�ѡ���嵥
displayUserMenu();
doHtmlFooter();
?>