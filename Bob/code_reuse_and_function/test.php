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
    $numargs=func_num_args();       //����Ĳ�������
    echo "Numbers of parameters:".$numargs."<br/>";
    $args=func_get_args();      //���ز���������(��Ӧfunc_get_arg()ÿ�λ��һ������)
    foreach ($args as $arg)
    {
        echo $arg."<br/>";
    }
    
}
var_args(1,2,3); */

//������Ҫ��require��include���֮ǰ����
$name="chuan";
require('reuseable.php');   


//ע��ֵ���ݺ����ô���(&$value)������
function increment(&$value,$amount=1)   
{
    $value=$value+$amount;
}


$value=10;
increment($value);      //����ֵ���ݣ��˴�һ���µİ����ô���ֵ�ı�������������������ԭ�������ĸ�����ԭ��������ֵ�����ı�
echo $value."<br/>";

//return���÷�
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

//�ݹ���ѭ��
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













