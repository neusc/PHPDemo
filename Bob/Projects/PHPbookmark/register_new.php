<?php
require_once('bookmark_fns.php');
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
//start it before headers
session_start();
try {
    //check out user inputs
    if (!filledOut($_POST)){
        throw new Exception("You have not filled the form out correctlly-
            please go back and try again.");
    }
    if (!validEmail($email)){
        throw new Exception("This is not a valid email address.
            please go back and try again.");
    }
    if ($password != $password2){
        throw new Exception("The passwords you entered do not match-
            please go back and try again.");
    }
    if (strlen($password) < 6 || strlen($password) > 16){
        throw new Exception("Your password must be between 6 and 16 characters.
            please go back and try again.");
    }
    //attempt to register
    register($username,$password,$email);
    //注册成功后创建session变量,直接保持登录状态
    $_SESSION['validUser'] = $username;
    doHtmlHeader('Registration successfully');
    echo 'Your registration was successfully.Go to the members page to start setting up your bookmarks!';
    doHtmlUrl('member.php','Go to members page');
    doHtmlFooter();
} catch (Exception $e) {
    doHtmlHeader('Problem:');
    echo $e->getMessage();
    doHtmlFooter();
    exit;
}

