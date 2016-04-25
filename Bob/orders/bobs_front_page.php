<?php
    $pictures=array('tire.jpg','oil.jpg','spark_plug.jpg','gasket.jpg','brake_pad.jpg');
    
    shuffle($pictures);

?>
<html>
<head>
    <title>Bob's Auto Parts</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<div align="center">
<table width=100%>
<tr>
<?php 
    for ($i=0;$i<3;$i++)
    {
        echo "<td align=\"center\"><img src=\""; 
        echo $pictures[$i];
        echo "\" height=\"200\" width=\"200\"/></td>";
   
    }
    
/*     $num=range(1, 10);      //ÉýÐò
    foreach ($num as $value)
    {
        echo $value.' ';
    }
    echo '<br/>';
    $numbers=array();
    for ($i=10;$i>0;$i--)
    {
        array_push($numbers, $i);   //½µÐò
    }
    foreach ($numbers as $value)
    {
        echo $value.' ';
    }
    echo '<br/>';
    $num=array_reverse($num);       //·´Ðò
    foreach ($num as $value)
    {
        echo $value.' ';
    }
    echo '<br/>';
    $num=range(10, 1,-1);           //½µÐò
    foreach ($num as $value)
    {
        echo $value.' ';
    } */
?>
</tr>
</table>
</div>
</body>
</html>