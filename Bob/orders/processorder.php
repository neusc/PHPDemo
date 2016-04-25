<html>
<head>
<title>Bob's Auto Parts - Order Resaults</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Resaults</h2>

<?php 
//header("Content-Type:text/html;charset=gb2312");    //改变字符集编码
//$tireqty=$_POST['tireqty'];
//$varname='tireqty';         // $$varname可以代替变量$tireqty;
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
$tireqty=$_POST['tireqty'];
$oilqty=$_POST['oilqty'];
$sparkqty=$_POST['sparkqty'];
$address=$_POST['address'];
$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
$date=date('H:i, jS F Y');
echo "<p> Order processed at ".$date."</p>";

echo 'Your order is as follows:</br>';
$totalqty = $tireqty+$oilqty+$sparkqty;
if ($totalqty==0)
{
    echo '<p style="color:red">';
    echo 'You did not order anything on the previous page!</br>';
    echo '</p>';
    
}
else 
{
    if ($tireqty>0)
    {
        echo $tireqty.' tires<br/>';
    }
    if ($oilqty>0)
    {
        echo $oilqty.' bottles of oil<br/>';
    }
    if ($sparkqty>0)
    {
        echo $sparkqty.' spark plugs<br/>';
    }
    echo "Items ordered: ".$totalqty."<br/><br/>";
    
    $totalamount=$tireqty*TIREPRICE+$oilqty*OILPRICE+$sparkqty*SPARKPRICE;
    echo "Subtotal: $".number_format($totalamount,2)."<br/><br/>";
    
    $taxrate=0.1;
    $totalamount=$totalamount*(1+$taxrate);
    echo "Total including tax: $".number_format($totalamount,2)."<br/><br/>";
    if(empty($address)!=true)
    {
        echo 'Address to ship to is '.$address.'<br/>';
    }
}
    //文件的操作
    $outputstring=$date."\t".$tireqty." tires\t ".$oilqty." oil\t".$sparkqty." spark plugs\t\$ "
                     .$totalamount."\t".$address."\r\n";
    @$fp=fopen("orders.txt", 'ab');
    flock($fp, LOCK_EX);
    if (!$fp)
    {
        echo "<p><strong>Your order could not be processed at this time,please try again later.
                </strong></p></body></html><br/>";
        exit;
                
    }
    fwrite($fp, $outputstring,strlen($outputstring));
    flock($fp, LOCK_UN);
    fclose($fp);
    echo "<p>Order written.</p>";
    
     //数组的使用
    $prices=array('Tires'=>100,'Oil'=>10,'Spark Plugs'=>4);
    ksort($prices);     //关联数组的两种排序
    krsort($prices);    //关联数组的降序排序
    /* foreach ($prices as $key=>$value)
    {
        echo $key.'-'.$value.'<br/>';
    }
    
    while ($element=each($prices))
    {
        echo $element['key'];
        echo "-";
        echo $element['value'];
        echo "<br/>";
    } */
    reset($prices);     //each()函数将记录当前元素，reset()将当前元素重新设置到数组开始处
    while (list($product,$price)=each($prices))
    {
        echo "$product - $price<br/>";
    }
    echo "<br/>";
    //二维数组
    $products=array(array('Code'=>'TIR','Description'=>'Tires','Price'=>100),
                    array('Code'=>'OIL','Description'=>'Oil','Price'=>10),
                    array('Code'=>'SPK','Description'=>'Spark Plugs','Price'=>4)
    );
 /*    for ($row=0;$row<3;$row++)
    {
        echo "|".$products[$row]['Code']."|".$products[$row]['Description']."|".$products[$row]['Price']."<br/>";
    } */
    
    //usort()用户自定义函数排序
    function compare($x,$y)     
    {
        if($x['Description']==$y['Description'])
        {
            return 0;
        }   
        else if($x['Description']<$y['Description'])
        {
            return -1;
        }
        else 
        {
            return 1;
        }
        
    }
    uksort($products, 'compare');    //按照二维关联数组第二列Description排序
    
    //根据二维关联数组取得列的列表
    /* foreach ($products as $key=>$row)
    {
        $Code[$key]=$row['Code'];
        $Description[$key]=$row['Description'];
        $Price[$key]=$row['Price'];
    }
    
    array_multisort($Code,SORT_ASC,$Price,SORT_DESC,$products); */   
    for ($row=0;$row<3;$row++)
    {
        while (list($key,$value)=each($products[$row]))
        {
            echo "|".$value;
        }
        echo "<br/>";
    }
    /* echo gettype($taxrate)."<br/>";
    settype($taxrate, int);
    echo  gettype($taxrate);   //变量数据类型的获取和改变
    echo 'isset($tireqty):'.isset($tireqty).'<br/>';
    echo 'empty($tireqty):'.empty($tireqty).'<br/>';
    $string="2a";
    $string1=intval($string); 
    echo '$string1的值:'.$string1.'<br/>';
    $string2=(int)$string;      //类型转换的两种方式
    echo $string2;  */ 
?>


</body>
</html>