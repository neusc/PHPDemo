<?php
function dbConnect() {
   $conn = new mysqli('localhost','book_sc','password','book_sc');
   if (!$conn) {
       throw new Exception('Could not connect to database.');
   }else {
       return $conn;
   }
}
//�����ݿ��ѯ���ת��Ϊ����
//����ѯ���ֻ��һ��ʱ������Ҫʹ�ô˺���
//Ϊ��foreachѭ������
function dbResultToArray($result) {
    $resultArray = array();
    //����ѯ�����ÿһ����Ϊ�������鷵��
    for ($count = 0; $row = $result->fetch_assoc(); $count++) {
        $resultArray[$count] = $row;
    }
    return $resultArray;
}