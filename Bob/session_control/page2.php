<?php
//再次调用session_start()函数，该变量被重新载入
session_start();
echo 'The content of $_session[\'sess_var\'] is '
      .$_SESSION['sess_var'].'<br/>';
//注销会话变量      
unset($_SESSION['sess_var']);
?>
<a href="page3.php">Next page</a>