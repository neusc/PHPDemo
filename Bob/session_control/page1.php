<?php
session_start();
$_SESSION['sess_var'] = "Hello world!";

echo 'The content of $_session[\'sess_var\'] is '
        .$_SESSION['sess_var'].'<br/>';
//�ڽű�ĩβ,�Ự�����ᣬֱ���ٴε���
//session_start()����֮�󣬸ñ���������
?>
<a href="page2.php">Next page</a>