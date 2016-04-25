<?php
session_start();
$_SESSION['sess_var'] = "Hello world!";

echo 'The content of $_session[\'sess_var\'] is '
        .$_SESSION['sess_var'].'<br/>';
//在脚本末尾,会话被冻结，直到再次调用
//session_start()函数之后，该变量被载入
?>
<a href="page2.php">Next page</a>