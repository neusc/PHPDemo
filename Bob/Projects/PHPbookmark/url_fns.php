<?php
require_once('bookmark_fns.php');
//��ȡ�û���������ǩ
function getUserUrls($user) {
    $conn = dbConnect();
    $result = $conn->query("select bmURL from bookmark where username='".$user."'");
    if (!$result) {
        return false;
    }
    //����ȡ�����û���ǩ��ŵ�������
    //fetch_row()�õ�����ö������,ʹ��fetch_assoc()�õ����ǹ�������
    $urlArray = array();
    for ($count = 0; $row = $result->fetch_row(); $count++) {
        $urlArray[$count] = $row[0];
    }
    return $urlArray;
}
//�����ǩ
function addBM($url) {
    $validUser = $_SESSION['validUser'];
    $conn = dbConnect();
    $result = $conn->query("select * from bookmark where username='".$validUser.
                "' and bmURL='".$url."'");
    if ($result && ($result->num_rows) > 0) {
        throw new Exception('The bookmark already exists.');
    }
    $insertResult = $conn->query("insert into bookmark values('".$validUser."','".$url."')");
    if (!$insertResult) {
        throw new Exception('Bookmark could not be inserted.');
    }
    return true;
}
//ɾ����ǩ
function deleteBM($user,$url) {
    $conn = dbConnect();
    $result = $conn->query("delete from bookmark where username='".$user."' and bmURL='".$url."'");
    if (!$result) {
        throw new Exception('Bookmark could not be deleted!');
    }
    return true;
}
//�Ƽ���ǩ
function recommendURLs($user,$popularity=1) {
    $query="select bmURL from bookmark where username in
            (select distinct(b2.username) from bookmark b1,bookmark b2
            where b1.username = '".$user."' and b1.username != b2.username
             and b1.bmURL = b2.bmURL)
            and bmURL not in 
            (select bmURL from bookmark where username='".$user."')
             group by bmURL
            having count(bmURL)>=".$popularity;
    $conn = dbConnect();
    $result = $conn->query($query);
    if (!$result) {
        throw new Exception('Could not find any bookmarks to recommend.');
    }
    if ($result->num_rows == 0) {
        throw new Exception('Could not find any bookmarks to recommend.');
    }
    $urls = array();
    for ($count = 0; $row = $result->fetch_row(); $count++) {
        $urls[$count] = $row[0];
    }
    
    return $urls;
}