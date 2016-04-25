<?php
    $name=stripslashes(addslashes(trim($_POST['name'])));
    $email=stripslashes(addslashes(trim($_POST['email'])));
    $feedback=stripslashes(addslashes(trim($_POST['feedback'])));//在将字符串写到数据库之前，必须使用addslasher()进行格式化
    
    /* if(get_magic_quotes_gpc())
    {
        $name=stripslashes(addslashes(trim($_POST['name'])));
        $email=stripslashes(addslashes(trim($_POST['email'])));
        $feedback=stripslashes(addslashes(trim($_POST['feedback'])));   //添加数据是都用addslashes(),当为ON时,必须使用stri
                                                                            pslasher(),为Off时，不必使用
    }  */
    
    /* $email_array=explode('@', $email);      //将字符串根据分割符分为几部分返回到数组中(implode()和join()用法相似)
    if(strtolower($email_array[1])=="bigcustomer.com")
    {
        $toaddress="bob@example.com";
    }
    else {
        $toaddress="feedback@example.com";
    } */
    
    //对用户输入字段进行正则表达式匹配实现不同目的
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
    echo nl2br($mailcontent);      //把字符串中的换行符\n替换为HTML标记<br/>
    echo $toaddress.'<br/>';
    
    print_r($_POST);
    /* $token=strtok($feedback, ",");
    echo $token."<br/>";
    while ($token!==false)      //strtok()函数的使用
    {
        $token=strtok(",");
        echo $token."<br/>";
    }
    
    echo strcmp("hello", "hfllo"); 
    
    if(strstr($feedback, 'shop'))   //在一个字符串在查找另一个字符串
    {
        echo strstr($feedback, 'shop').'<br/>';         //返回首次出现的位置至结尾
        echo strpos($feedback, 'shop').'<br/>';         //返回第一次出现的位置
    }
    
    $letters=array('a','p');
    $fruit=array('apple','pear');
    $text='a p';
    $output=str_replace($letters, $fruit, $text);       //替换子字符串
    echo $output.'<br/>';
    $test=substr_replace($feedback, 'X', 8,2);      //按指定位置替换
    echo $test.'<br/>';     */
?>
</body>
</html>