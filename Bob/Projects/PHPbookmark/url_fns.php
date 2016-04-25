<?php
require_once('bookmark_fns.php');
//获取用户的所有书签
function getUserUrls($user) {
    $conn = dbConnect();
    $result = $conn->query("select bmURL from bookmark where username='".$user."'");
    if (!$result) {
        return false;
    }
    //将获取到的用户标签存放到数组中
    //fetch_row()得到的是枚举数组,使用fetch_assoc()得到的是关联数组
    $urlArray = array();
    for ($count = 0; $row = $result->fetch_row(); $count++) {
        $urlArray[$count] = $row[0];
    }
    return $urlArray;
}
//添加书签
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
//删除书签
function deleteBM($user,$url) {
    $conn = dbConnect();
    $result = $conn->query("delete from bookmark where username='".$user."' and bmURL='".$url."'");
    if (!$result) {
        throw new Exception('Bookmark could not be deleted!');
    }
    return true;
}
//推荐书签
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