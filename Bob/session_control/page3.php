<?php
session_start();

echo 'The content of $_session[\'sess_var\'] is '
    .$_SESSION['sess_var'].'<br/>';
    
//����ע�����б���,Ȼ��������ٻỰ  
session_destroy();
?>