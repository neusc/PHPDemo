<?php
//�ٴε���session_start()�������ñ�������������
session_start();
echo 'The content of $_session[\'sess_var\'] is '
      .$_SESSION['sess_var'].'<br/>';
//ע���Ự����      
unset($_SESSION['sess_var']);
?>
<a href="page3.php">Next page</a>