<?php

session_start();
require_once('dump_variables.php');
$oldUser = $_SESSION['validUser'];
//注销会话变量
unset($_SESSION['validUser']);
//注销cookie变量
setcookie('validUser','',time()-24*60*60);
session_destroy();
?>
<html>
<body>
<h1>Log out</h1>
<?php 
if (!empty($oldUser)){
    echo 'Logged out.<br/>';
}
else {
    echo 'You were not logged in, and so have not been logged out.<br/>';
}
?>
<a href="authmain.php">Back to main page</a>
</body>
</html>