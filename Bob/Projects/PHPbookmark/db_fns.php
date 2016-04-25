<?php
//连接数据库
//需要修改密码只需修改一个文件即可
function dbConnect() {
    $conn = new mysqli('localhost','book','mark','bookmarks');
    if (!$conn) {
        throw new Exception('Could not connect to database');
    }else {
        return $conn;
    }
}