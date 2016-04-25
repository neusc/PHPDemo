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
    //文件读取的不同方法
    /* @$fp=fopen("$DOCUMENT_ROOT/orders.txt", 'rb') or die("<p><strong>No orders pending.
         Please try again later.</strong></p>");
    
    flock($fp, LOCK_SH);
    
    while (!feof($fp))
    {
        $orders=fgets($fp,999);         //按行读取文件
        echo $orders."<br/>";
    }
    
    echo "Final position of the file pointer is ". ftell($fp);      //以字节形式返回文件指针当前位置
    echo "<br/>";
    rewind($fp);        //文件指针复位到文件开始位置
    echo "After rewind, the position is ".ftell($fp);
    echo "<br/>";
    flock($fp, LOCK_UN);
    fclose($fp);  */
    
    $orders=file("$DOCUMENT_ROOT/orders.txt");      //文件中每行作为数组的一个元素
    $ordernum=count($orders);
    if ($ordernum==0)
    {
        echo '<p><strong>No orders pending.Please try again later.</strong></p>';
    }
    
    
    for ($i=0;$i<$ordernum;$i++)
    {
        echo $orders[$i].'<br/>';
    }
    
    
    /* if(file_exists("$DOCUMENT_ROOT/orders.txt")) //判断文件是否存在
    {
        echo "There are orders waiting to be processed!<br/>";
    }
    else 
    {
        echo "There are currently no orders!<br/>";
    }
    @$fp=fopen("$DOCUMENT_ROOT/orders.txt", 'rb') or die("<p><strong>No orders pending.
                Please try again later.</strong></p>");
    
    echo nl2br(fread($fp, filesize("$DOCUMENT_ROOT/orders.txt")));      //nl2br()函数的使用
    fclose($fp); */
    
  
    
    /* /*readfile("$DOCUMENT_ROOT/orders.txt");  */        //读取整个文件
     
    /* while (!feof($fp))
    {
        $char=fgetc($fp);           //按单个字符读取，将文本中的行结束符\n替换为HTML换行符<br/>
        if (!feof($fp))
        {
            echo ($char=="\n"?"<br/>":$char);
        }
    }       */                                      
    
   /*  $filearray=file("$DOCUMENT_ROOT/orders.txt");   //文件中每行作为数组的一个元素
    foreach($filearray as $value)
    {
        echo $value."<br/>";
    }    */
    
            
       
?>
</body>
</html>