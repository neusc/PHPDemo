<?php
session_start();

echo 'The content of $_session[\'sess_var\'] is '
    .$_SESSION['sess_var'].'<br/>';
    
//首先注销所有变量,然后才能销毁会话  
session_destroy();
?>