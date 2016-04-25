<?php
//从数据库获得目录的数组
function getCategories() {
    $conn = dbConnect();
    $query = 'select catid,catname from categories';
    $result = $conn->query($query);
    if (!$result) {
        return false;
    }
    $numCats = @$result->num_rows;
    if ($numCats == 0) {
        return false;
    }
    //$result数组的每一项都是一个包含catid和catname的关联数组
    $result = dbResultToArray($result);
    return $result;
}
//根据目录标识符从数据库查询对应的目录名称
function getCategoryName($catid) {
    $conn = dbConnect();
    $query = "select catname from categories where catid='".$catid."'";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    }
    $numCats = @$result->num_rows;
    if ($numCats == 0) {
        return false;
    }
    $row = $result->fetch_assoc();
    return $row['catname'];
}
//根据目录标识符获取目录下的所有图书
function getBooks($catid) {
    $conn = dbConnect();
    $query = "select * from books where catid='".$catid."'";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    }
    $numBooks = @$result->num_rows;
    if ( $numBooks== 0) {
        return false;
    }
    $result = dbResultToArray($result);
    return $result;
}
//根据isbn号从数据库获取图书的详细信息
function getBookDetails($isbn) {
    if ((!$isbn) || ($isbn == '')) {
        return false;
    }
    $conn = dbConnect();
    //注意isbn号不需要加引号
    $query = "select * from books where isbn=".$isbn;
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    //返回一个关于isbn号图书的关联数组
    $result = $result->fetch_assoc();
    return $result;
    
}
//计算购物车中商品的总数量
function calculateItems($cart) {
    $items = 0;
    if (is_array($cart)) {
        foreach ($cart as $isbn => $qty) {
            $items += $qty;
        }
    }
    return $items;
}
//计算购物车中商品的总价格
function calculatePrice($cart) {
    $price = 0.0;
    if (is_array($cart)) {
        $conn = dbConnect();
        foreach ($cart as $isbn => $qty) {
            $query = "select price from books where isbn='".$isbn."'";
            $result = $conn->query($query);
            if ($result) {
                //SQL查询结果的两种处理方式
                $item = $result->fetch_assoc();
                $itemPrice = $item['price'];
                //$item = $result->fetch_object();
                //$itemPrice = $item->price;
                $price += $itemPrice*$qty;
            }
        }
    }
    return $price;
}
function calculateShippingCost() {
    return 20.00;
}