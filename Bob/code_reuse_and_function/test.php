<?php
/* function create_table($data)
{
    echo "<table border=\"1\">";
    reset($data);
    foreach ($data as $current)
    {
        echo "<tr><td>".$current."</tr></td>";
    }
    echo "</table>";
} */

function create_table2($data,$border,$cellpadding,$cellspacing)
{
    echo "<table border=\"".$border."\" cellpadding=\"".$cellpadding."\" cellspacing=\"".$cellspacing."\">";
    reset($data);
    foreach ($data as $current)
    {
        echo "<tr><td>"."$current"."</tr></td>";
    }
    
    echo "</table>";
}
$my_array=array("linda","noe","summer");
create_table2($my_array,3,8,8);

/* function var_args()
{
    $numargs=func_num_args();       //输入的参数个数
    echo "Numbers of parameters:".$numargs."<br/>";
    $args=func_get_args();      //返回参数的数组(对应func_get_arg()每次获得一个参数)
    foreach ($args as $arg)
    {
        echo $arg."<br/>";
    }
    
}
var_args(1,2,3); */

//变量需要在require或include语句之前声明
$name="chuan";
require('reuseable.php');   


//注意值传递和引用传递(&$value)的区别
function increment(&$value,$amount=1)   
{
    $value=$value+$amount;
}


$value=10;
increment($value);      //对于值传递，此处一个新的包含该传入值的变量参数被创建，它是原来变量的副本，原来变量的值并不改变
echo $value."<br/>";

//return的用法
function larger($x,$y)
{
    if ((!isset($x))||(!isset($y)))
    {
        return false;
    }
    elseif ($x>=$y)
    {
        return $x;
    }
    else 
    {
        return $y;
    }
}

$a=1; $b=2.5; $c=1.9;
echo larger($a, $b)."<br/>";
echo larger($c, $a)."<br/>";
echo larger($d, $a);

//递归与循环
function reverse_r($str)
{
    if (strlen($str)>0)
    {
        reverse_r(substr($str, 1));
    }
    echo substr($str, 0,1);
    return; 
    
}
function reverse_i($str)
{
    for ($i=1;$i<=strlen($str);$i++)
    {
        echo substr($str, -$i,1);
    }
    echo "<br/>";
    return; 
    
}
reverse_i("hello");
reverse_r('hello');













