<?php
    $name=stripslashes(addslashes(trim($_POST['name'])));
    $email=stripslashes(addslashes(trim($_POST['email'])));
    $feedback=stripslashes(addslashes(trim($_POST['feedback'])));//�ڽ��ַ���д�����ݿ�֮ǰ������ʹ��addslasher()���и�ʽ��
    
    /* if(get_magic_quotes_gpc())
    {
        $name=stripslashes(addslashes(trim($_POST['name'])));
        $email=stripslashes(addslashes(trim($_POST['email'])));
        $feedback=stripslashes(addslashes(trim($_POST['feedback'])));   //��������Ƕ���addslashes(),��ΪONʱ,����ʹ��stri
                                                                            pslasher(),ΪOffʱ������ʹ��
    }  */
    
    /* $email_array=explode('@', $email);      //���ַ������ݷָ����Ϊ�����ַ��ص�������(implode()��join()�÷�����)
    if(strtolower($email_array[1])=="bigcustomer.com")
    {
        $toaddress="bob@example.com";
    }
    else {
        $toaddress="feedback@example.com";
    } */
    
    //���û������ֶν���������ʽƥ��ʵ�ֲ�ͬĿ��
    if (!eregi('^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$', $email))
    {
        echo 'Invalid!Please return and try again!'.'<br/>';
    }
    
    $toaddress="feedback@example.com";
    if (eregi("shop|customer service|retail", $feedback))
    {
        $toaddress="retail@example.com";
    }
    elseif (eregi("deliver|fullfill", $feedback))
    {
        $toaddress="fullfillment@example.com";
    }
    elseif (eregi("bill|account", $feedback))
    {
        $toaddress="accounts@example.com";
    }
    if (eregi("bigcustomer\.com", $email))
    {
        $toaddress="bob@example.com";
    }
    $subject="Feedback from Bob's web site";
    
    $mailcontent="Customer name:".$name."\n".
                 "Customer email:".$email."\n".
                 "Customer comments:\n".$feedback."\n";
    
    $fromaddress="From:webserver@example.com";
    mail($toaddress, $subject, $mailcontent,$fromaddress);
    
    
?>
<html>
<head>
<title>Bob's Auto Parts - Feedback Submitted</title>
</head>
<body>
<h1>Feedback submitted</h1>
<p>Your feedback has been sent.</p>
<?php 
    echo nl2br($mailcontent);      //���ַ����еĻ��з�\n�滻ΪHTML���<br/>
    echo $toaddress.'<br/>';
    
    print_r($_POST);
    /* $token=strtok($feedback, ",");
    echo $token."<br/>";
    while ($token!==false)      //strtok()������ʹ��
    {
        $token=strtok(",");
        echo $token."<br/>";
    }
    
    echo strcmp("hello", "hfllo"); 
    
    if(strstr($feedback, 'shop'))   //��һ���ַ����ڲ�����һ���ַ���
    {
        echo strstr($feedback, 'shop').'<br/>';         //�����״γ��ֵ�λ������β
        echo strpos($feedback, 'shop').'<br/>';         //���ص�һ�γ��ֵ�λ��
    }
    
    $letters=array('a','p');
    $fruit=array('apple','pear');
    $text='a p';
    $output=str_replace($letters, $fruit, $text);       //�滻���ַ���
    echo $output.'<br/>';
    $test=substr_replace($feedback, 'X', 8,2);      //��ָ��λ���滻
    echo $test.'<br/>';     */
?>
</body>
</html>