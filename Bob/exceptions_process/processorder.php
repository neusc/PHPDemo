<?php 

require_once("file_exception.php");


//创建短变量名
$tireqty=$_POST['tireqty'];
$oilqty=$_POST['oilqty'];
$sparkqty=$_POST['sparkqty'];
$address=$_POST['address'];

$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
?>

<html>
<head>
<title>Bob's Auto Parts - Order Resaults</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Resaults</h2>

<?php
$date=date('H:i, jS F Y');

echo "<p> Order processed at ".$date."</p>";

echo 'Your order is as follows:</br>';
$totalqty = $tireqty+$oilqty+$sparkqty;

echo "Items ordered: ".$totalqty."<br/><br/>";

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
}
    
    
    
    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);
    
    $totalamount=$tireqty*TIREPRICE+$oilqty*OILPRICE+$sparkqty*SPARKPRICE;
    
    echo "Subtotal: $".number_format($totalamount,2)."<br/><br/>";
    
    $taxrate=0.1;
    $totalamount=$totalamount*(1+$taxrate);
    echo "Total including tax: $".number_format($totalamount,2)."<br/><br/>";
    if(empty($address)!=true)
    {
        echo 'Address to ship to is '.$address.'<br/>';
    }

    //文件的操作
    $outputstring=$date."\t".$tireqty." tires\t ".$oilqty." oil\t".$sparkqty." spark plugs\t\$ "
                     .$totalamount."\t".$address."\r\n";
    
    //文件追加写
    try {
        if(!($fp=@fopen("$DOCUMENT_ROOT/order.txt",'ab')))
        {
            throw new FileOpenException();
        }
        
        if (!flock($fp, LOCK_EX))
        {
            throw new FileLockException();
        }
        
        if (!fwrite($fp, $outputstring,strlen($outputstring)))
        {
            throw new FileWriteException();
        }
        
        flock($fp, LOCK_UN);
        fclose($fp);
        echo "<p>Order written.</p>";
    }
    catch (FileOpenException $foe)
    {
        echo "<p><strong>Orders file could not be opened.
                Please contact our webmaster for help.</strong></p>";
    }
    catch (Exception $e)
    { 
        echo "<P><strong>Your order could not be processed at this time.
                Please try again later.</strong></p>";
    }
    
 
    
    
?>


</body>
</html>