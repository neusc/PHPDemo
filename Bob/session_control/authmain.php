<?php
session_start();
require('dump_variables.php');

if (isset($_POST['userid']) && isset($_POST['password'])){
    $userid = $_POST['userid'];
    $password = $_POST['password'];
}
$conn = new mysqli('localhost','webauth','webauth','auth');
if (mysqli_connect_errno()){
    echo 'Connection to database failed: '.mysqli_connect_error();
    exit;
}
$query = "select * from authorized_users where name='".$userid."' and password='".sha1($password)."'";
// $query = "select * from authorized_users "
//       ."where name = '$userid' "."and password = sha1($password)";  
$result = $conn->query($query);
if ($result->num_rows){
    //echo '1';
    //����session����
    $_SESSION['validUser'] = $userid;
    //����cookie����
    setcookie('validUser',$userid,time()+24*60*60);
    //headerͷ��Ϣ����λ���κ����֮ǰ����
     $homeUrl = 'members_only.php';
    //�ض�������Ա�ѵ�¼����,cookieֵ������Ч
     header('Location: '.$homeUrl);
}
$conn->close();
?>
<html>
<head>
    <title>Home page</title>
</head>
<body>
<h1>Home page</h1>
<?php 
if (isset($_SESSION['validUser'])){
    echo 'You are logged in as: '.$_SESSION['validUser'].'<br/>';
    echo '<a href="logout.php">Log out</a>';
}
else {
    //��¼ʧ��
    if (isset($userid)){
        echo 'Could not log you in'.'<br/>';
    }
    //�û�����δ��д
    else {
        echo 'You are not logged in'.'<br/>';
    }
    //Ϊ�û��ṩ��¼��
    echo '<form method="post" action="authmain.php">';
    echo '<table>';
    echo '<tr><td>Userid:</td>';
    echo '<td><input type="text" name="userid"></td></tr>';
    echo '<tr><td>Password:</td>';
    echo '<td><input type="password" name="password"></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Log in"></td></tr>';
    echo '</table></form>';
}
?>
<br/>
<a href="members_only.php">Members section</a>
</body>
</html>