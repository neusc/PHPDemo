<?php
function processCard($cardDetails) {
    // connect to payment gateway or
    // use gpg to encrypt and mail or
    // store in DB if you really want to

    return true;
}
function insertOrder($orderDetails) {
    //��ȡ�����еı���
    extract($orderDetails);
    //����ͻ���ַδ��д����������Ϊ�뵱ǰ�û���Ϣ��ͬ
    if ((!$shipName) && (!$shipAddress) && (!$shipCity) && (!$shipState) && (!$shipZip) && (!$shipCountry)) {
        $shipName = $name;
        $shipAddress = $address;
        $shipCity = $city;
        $shipState = $state;
        $shipZip = $zip;
        $shipCountry = $country;
    }
    
    $conn = dbConnect();
    //���붩����Ϊ�����������Ϊһ��������룬���ҹر��Զ��ύ
    $conn->autocommit(false);
    //����˿͵�ַ
    $query = "select customerid from customers where
            name = '".$name."' and address= '".$address."' and city ='".$city.
            "' and state ='".$state."' and zip ='".$zip."' and country ='".$country."'";
    $result = $conn->query($query);
    //�˹˿���Ϣ�Ѿ�����
    if ($result->num_rows > 0) {
        $customer = $result->fetch_object();
        $customerId = $customer->customerid;
    }else{
        //�����û���Ϣ�������ݿ�
        $query = "insert into customers values('','".$name."','".$address."','".$city."','".
            $state."','".$zip."','".$country."')";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
    }
    //������ɹ˿ͺ�
    $customerId = $conn->insert_id;
    
    $date = date("Y-m-d");
    //���붩��
    $query = "insert into orders values
            ('', '".$customerId."', '".$_SESSION['totalPrice']."', '".$date."', '".PARTIAL."',
             '".$shipName."', '".$shipAddress."', '".$shipCity."', '".$shipState."',
             '".$shipZip."', '".$shipCountry."')";
    
    $result = $conn->query($query);
    if (!$result) {
        return false;
    }
    //��ȡϵͳ���ɵĶ�����
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
    
    // ���붩����ϸ��order_item��
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
    
    //��������
    $conn->commit();
    $conn->autocommit(TRUE);
    
    return $orderid;
}