<?php
require_once('bookmark_fns.php');
//�����ݿ�ע�����û�
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
//����û��Ƿ�ӵ���Ѿ�ע��ĻỰ,���Ƿ��Ѿ���¼
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
//���û���д����Ϣ�����ݿ���Ϣ���жԱ�
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
//�ѵ�¼�û���������
function changePassword($username,$oldPassword,$newPassword) {
    //�жϾ������Ƿ���ȷ
    login($username, $oldPassword);
    $conn = dbConnect();
    $result = $conn->query("update user set passwd=sha1('".$newPassword."') where username='".$username."'");
    if (!$result) {
        throw new Exception('Password could not be changed');
    }else {
        return true;
    }
}
//��������
function resetPassword($username) {
    //�������ֵ��л�ȡ������������������
    $newPassword = getRandomWord(6,13);
    if ($newPassword == false) {
        throw new Exception("Could not generate new password");
    }
    $randNumber = rand(0,999);
    //��������ʺ����һ���������
    $newPassword .= $randNumber;
    $conn = dbConnect();
    $result = $conn->query("update user set passwd=sha1('".$newPassword."') where username='".$username."'");
    if (!$result) {
        throw new Exception("Could not change password");
    }else{
        return $newPassword;
    }
}
//�������ֵ��ȡһ���������
function getRandomWord($minLength,$maxLength){
    $word = "";
    $dictionary = '2of4brif.txt';
    $fp = fopen($dictionary, 'r');
    if (!$fp) {
        return false;
    }
    //�����ļ����ֽ���
    $size = filesize($dictionary);
    $randLocation = rand(0,$size);
    //���ļ��е�һ�����λ�ÿ�ʼ����
    fseek($fp, $randLocation);
    //strstr���˴��е����ŵĵ���
    while ((strlen($word)<$minLength) || (strlen($word)>$maxLength) || strstr($word, "'")) {
        if (feof($fp)) {
            //�����ļ�ĩβ����ͷ��ʼ
            fseek($fp, 0);
        };
        //������ʼ�������,��ֹ��ȡ���ĵ��ʲ�����
        $word = fgets($fp,80);
        $word = fgets($fp,80);
    }
    $word = trim($word);
    return $word;
    
}
//�����ú�������ʼ����͸��û�
function mailPassword($username,$newPassword) {
    $conn = dbConnect();
    $result = $conn->query("select email from user where username='".$username."'");
    if (!$result) {
        throw new Exception('Could not find email address');
    }elseif ($result->num_rows == 0) {
        throw new Exception('Could not find email address');;
    }else {
        //fetch_assoc()���ؽ����һ����������,fetch_row()���ص�һ���о�����
        //���ؽ����һ����ض�����
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