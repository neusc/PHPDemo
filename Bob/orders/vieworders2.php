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
    $orders=file("$DOCUMENT_ROOT/orders.txt");      //文件中每行作为数组的一个元素
    $ordernum=count($orders);
    if ($ordernum==0)
    {
        echo '<p><strong>No orders pending.Please try again later.</strong></p>';
    }
    
    echo "<table border=\"1\">\n";
    echo "<tr><th bgcolor=\"#CCCCFF\">Order Date</th>
              <th bgcolor=\"#CCCCFF\">Tires</th>
              <th bgcolor=\"#CCCCFF\">Oil</th>
              <th bgcolor=\"#CCCCFF\">Spark Plugs</th>
              <th bgcolor=\"#CCCCFF\">Total</th>
              <th bgcolor=\"#CCCCFF\">Address</th>
          </tr>";
    for ($i=0;$i<$ordernum;$i++)
    {
        $line=explode("\t", $orders[$i]);   //将字符串根据分隔符分割为元素添加到数组中
        
        $line[1]=intval($line[1]);  //intval()函数智能将一个字符串转化为整数
        $line[2]=intval($line[2]);
        $line[3]=intval($line[3]);
        
        echo "<tr>
                <td>".$line[0]."</td>
                <td align=\"right\">".$line[1]."</td>
                <td align=\"right\">".$line[2]."</td>
                <td align=\"right\">".$line[3]."</td>
                <td align=\"right\">".$line[4]."</td>
                <td>".$line[5]."</td>    
             </tr>";
    }
    
    echo "</table>";
?>    
</body>
</html>