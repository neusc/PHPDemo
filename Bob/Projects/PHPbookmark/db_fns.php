<?php
//�������ݿ�
//��Ҫ�޸�����ֻ���޸�һ���ļ�����
function dbConnect() {
    $conn = new mysqli('localhost','book','mark','bookmarks');
    if (!$conn) {
        throw new Exception('Could not connect to database');
    }else {
        return $conn;
    }
}