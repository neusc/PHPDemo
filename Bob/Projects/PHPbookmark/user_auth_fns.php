<?php
require_once('bookmark_fns.php');
//向数据库注册新用户
function register($username,$password,$email) {
    $conn = dbConnect();
    $result = $conn->query("select * from user where username='".$username."'");
    if (!$result) {
        throw new Exception('Could not execute the query');
    }
    if ($result->num_rows > 0) {
        throw new Exception('The user has been registered - go back and register another one');
    }
    $registerResult = $conn->query("insert into user values('".$username."',sha1('".$password."'),'".$email."')");
    if (!$registerResult) {
        throw new Exception('Could not register you in database - please try again');
    }
    return true;
}
//检查用户是否拥有已经注册的会话,即是否已经登录
function checkValidUser() {
    if (isset($_SESSION['validUser'])) {
        echo 'Logged in as '.$_SESSION['validUser'].'<br/><br/>';
    }else {
        doHtmlHeader('Problem');
        echo 'You are not logged in.<br/>';
        doHtmlUrl('login.php','Login');
        doHtmlFooter();
        exit;
    }
}
//将用户填写的信息与数据库信息进行对比
function login($username,$password) {
    $conn = dbConnect();
    $result = $conn->query("select * from user where username='".$username."' and passwd=sha1('".$password."')");
    if (!$result) {
        throw new Exception('Could not log you in');
    }
    if ($result->num_rows > 0) {
        return true;
    }else {
        throw new Exception('Could not log you in');
    }
}
//已登录用户更改密码
function changePassword($username,$oldPassword,$newPassword) {
    //判断旧密码是否正确
    login($username, $oldPassword);
    $conn = dbConnect();
    $result = $conn->query("update user set passwd=sha1('".$newPassword."') where username='".$username."'");
    if (!$result) {
        throw new Exception('Password could not be changed');
    }else {
        return true;
    }
}
//重置密码
function resetPassword($username) {
    //从数据字典中获取随机单词生成随机密码
    $newPassword = getRandomWord(6,13);
    if ($newPassword == false) {
        throw new Exception("Could not generate new password");
    }
    $randNumber = rand(0,999);
    //在随机单词后添加一个随机数字
    $newPassword .= $randNumber;
    $conn = dbConnect();
    $result = $conn->query("update user set passwd=sha1('".$newPassword."') where username='".$username."'");
    if (!$result) {
        throw new Exception("Could not change password");
    }else{
        return $newPassword;
    }
}
//从数据字典获取一个随机单词
function getRandomWord($minLength,$maxLength){
    $word = "";
    $dictionary = '2of4brif.txt';
    $fp = fopen($dictionary, 'r');
    if (!$fp) {
        return false;
    }
    //返回文件的字节数
    $size = filesize($dictionary);
    $randLocation = rand(0,$size);
    //从文件中的一个随机位置开始搜索
    fseek($fp, $randLocation);
    //strstr过滤带有单引号的单词
    while ((strlen($word)<$minLength) || (strlen($word)>$maxLength) || strstr($word, "'")) {
        if (feof($fp)) {
            //到达文件末尾，从头开始
            fseek($fp, 0);
        };
        //跳过开始的随机行,防止截取到的单词不完整
        $word = fgets($fp,80);
        $word = fgets($fp,80);
    }
    $word = trim($word);
    return $word;
    
}
//将重置后的密码邮件发送给用户
function mailPassword($username,$newPassword) {
    $conn = dbConnect();
    $result = $conn->query("select email from user where username='".$username."'");
    if (!$result) {
        throw new Exception('Could not find email address');
    }elseif ($result->num_rows == 0) {
        throw new Exception('Could not find email address');;
    }else {
        //fetch_assoc()返回结果到一个关联数组,fetch_row()返回到一个列举数组
        //返回结果到一个相关对象中
        $row = $result->fetch_object();
        $email = $row->email;
        $from = "From:shechuan001@163.com\r\n";
        $message = "Your PHPBookmark password has been changed to ".$newPassword."\r\n"
            ."Please change it next time you log in.\r\n";
        if (mail($email, 'PHPBookmark login iniformation', $message,$from)) {
            return true;
        }else {
            throw new Exception('Could not send email!');
        }
    }
}