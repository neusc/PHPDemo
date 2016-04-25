<?php
function processCard($cardDetails) {
    // connect to payment gateway or
    // use gpg to encrypt and mail or
    // store in DB if you really want to

    return true;
}
function insertOrder($orderDetails) {
    //提取订单中的变量
    extract($orderDetails);
    //如果送货地址未填写，将其设置为与当前用户信息相同
    if ((!$shipName) && (!$shipAddress) && (!$shipCity) && (!$shipState) && (!$shipZip) && (!$shipCountry)) {
        $shipName = $name;
        $shipAddress = $address;
        $shipCity = $city;
        $shipState = $state;
        $shipZip = $zip;
        $shipCountry = $country;
    }
    
    $conn = dbConnect();
    //插入订单分为几步，因此作为一个事务插入，并且关闭自动提交
    $conn->autocommit(false);
    //插入顾客地址
    $query = "select customerid from customers where
            name = '".$name."' and address= '".$address."' and city ='".$city.
            "' and state ='".$state."' and zip ='".$zip."' and country ='".$country."'";
    $result = $conn->query($query);
    //此顾客信息已经存在
    if ($result->num_rows > 0) {
        $customer = $result->fetch_object();
        $customerId = $customer->customerid;
    }else{
        //将新用户信息插入数据库
        $query = "insert into customers values('','".$name."','".$address."','".$city."','".
            $state."','".$zip."','".$country."')";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
    }
    //随机生成顾客号
    $customerId = $conn->insert_id;
    
    $date = date("Y-m-d");
    //插入订单
    $query = "insert into orders values
            ('', '".$customerId."', '".$_SESSION['totalPrice']."', '".$date."', '".PARTIAL."',
             '".$shipName."', '".$shipAddress."', '".$shipCity."', '".$shipState."',
             '".$shipZip."', '".$shipCountry."')";
    
    $result = $conn->query($query);
    if (!$result) {
        return false;
    }
    //获取系统生成的订单号
    $query = "select orderid from orders where
               customerid = '".$customerId."' and
               amount > (".$_SESSION['total_price']."-.001) and
               amount < (".$_SESSION['total_price']."+.001) and
               date = '".$date."' and
               order_status = 'PARTIAL' and
               ship_name = '".$shipName."' and
               ship_address = '".$shipAddress."' and
               ship_city = '".$shipCity."' and
               ship_state = '".$shipState."' and
               ship_zip = '".$shipZip."' and
               ship_country = '".$shipCountry."'";
    
    $result = $conn->query($query);
    
    if($result->num_rows>0) {
        $order = $result->fetch_object();
        $orderid = $order->orderid;
    } else {
        return false;
    }
    
    // 插入订单明细到order_item表
    foreach($_SESSION['cart'] as $isbn => $quantity) {
        $detail = getBookDetails($isbn);
        $query = "delete from order_items where
              orderid = '".$orderid."' and isbn = '".$isbn."'";
        $result = $conn->query($query);
        $query = "insert into order_items values
              ('".$orderid."', '".$isbn."', ".$detail['price'].", $quantity)";
        $result = $conn->query($query);
        if(!$result) {
            return false;
        }
    }
    
    //结束事务
    $conn->commit();
    $conn->autocommit(TRUE);
    
    return $orderid;
}