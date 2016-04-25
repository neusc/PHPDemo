<?php
function dbConnect() {
   $conn = new mysqli('localhost','book_sc','password','book_sc');
   if (!$conn) {
       throw new Exception('Could not connect to database.');
   }else {
       return $conn;
   }
}
//将数据库查询结果转换为数组
//当查询结果只有一项时，不需要使用此函数
//为了foreach循环遍历
function dbResultToArray($result) {
    $resultArray = array();
    //将查询结果的每一行作为关联数组返回
    for ($count = 0; $row = $result->fetch_assoc(); $count++) {
        $resultArray[$count] = $row;
    }
    return $resultArray;
}