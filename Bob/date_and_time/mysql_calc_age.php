<?php
$day = 18;
$month = 9;
$year = 1972;

//�����ո�ʽ��ΪISO 8601��׼���ڣ��˸�ʽ��MySQL���ݿ�ı�׼��ʽ
$bdayISO = date("c",mktime(0,0,0,$month,$day,$year));

//�������
$db = new mysqli('localhost','same','same');
$query = "select datediff(now(),'$bdayISO')";
$res = $db->query($query);
$age = $res->fetch_array();

//�������
// $db = mysqli_connect('localhost','same','same');
// $res = mysqli_query($db, "select datediff(now(),'$bdayISO')");
// $age = mysqli_fetch_array($res);

echo "Age is ".floor($age[0]/365.25);