<?php
    $DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
?>
<html>
<head>
    <title>Bob's Auto Parts - Customer Orders</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <h2>Customer Orders</h2>

<?php 
    //�ļ���ȡ�Ĳ�ͬ����
    /* @$fp=fopen("$DOCUMENT_ROOT/orders.txt", 'rb') or die("<p><strong>No orders pending.
         Please try again later.</strong></p>");
    
    flock($fp, LOCK_SH);
    
    while (!feof($fp))
    {
        $orders=fgets($fp,999);         //���ж�ȡ�ļ�
        echo $orders."<br/>";
    }
    
    echo "Final position of the file pointer is ". ftell($fp);      //���ֽ���ʽ�����ļ�ָ�뵱ǰλ��
    echo "<br/>";
    rewind($fp);        //�ļ�ָ�븴λ���ļ���ʼλ��
    echo "After rewind, the position is ".ftell($fp);
    echo "<br/>";
    flock($fp, LOCK_UN);
    fclose($fp);  */
    
    $orders=file("$DOCUMENT_ROOT/orders.txt");      //�ļ���ÿ����Ϊ�����һ��Ԫ��
    $ordernum=count($orders);
    if ($ordernum==0)
    {
        echo '<p><strong>No orders pending.Please try again later.</strong></p>';
    }
    
    
    for ($i=0;$i<$ordernum;$i++)
    {
        echo $orders[$i].'<br/>';
    }
    
    
    /* if(file_exists("$DOCUMENT_ROOT/orders.txt")) //�ж��ļ��Ƿ����
    {
        echo "There are orders waiting to be processed!<br/>";
    }
    else 
    {
        echo "There are currently no orders!<br/>";
    }
    @$fp=fopen("$DOCUMENT_ROOT/orders.txt", 'rb') or die("<p><strong>No orders pending.
                Please try again later.</strong></p>");
    
    echo nl2br(fread($fp, filesize("$DOCUMENT_ROOT/orders.txt")));      //nl2br()������ʹ��
    fclose($fp); */
    
  
    
    /* /*readfile("$DOCUMENT_ROOT/orders.txt");  */        //��ȡ�����ļ�
     
    /* while (!feof($fp))
    {
        $char=fgetc($fp);           //�������ַ���ȡ�����ı��е��н�����\n�滻ΪHTML���з�<br/>
        if (!feof($fp))
        {
            echo ($char=="\n"?"<br/>":$char);
        }
    }       */                                      
    
   /*  $filearray=file("$DOCUMENT_ROOT/orders.txt");   //�ļ���ÿ����Ϊ�����һ��Ԫ��
    foreach($filearray as $value)
    {
        echo $value."<br/>";
    }    */
    
            
       
?>
</body>
</html>