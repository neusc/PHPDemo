<?php
//�����ݿ���Ŀ¼������
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
    //$result�����ÿһ���һ������catid��catname�Ĺ�������
    $result = dbResultToArray($result);
    return $result;
}
//����Ŀ¼��ʶ�������ݿ��ѯ��Ӧ��Ŀ¼����
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
//����Ŀ¼��ʶ����ȡĿ¼�µ�����ͼ��
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
//����isbn�Ŵ����ݿ��ȡͼ�����ϸ��Ϣ
function getBookDetails($isbn) {
    if ((!$isbn) || ($isbn == '')) {
        return false;
    }
    $conn = dbConnect();
    //ע��isbn�Ų���Ҫ������
    $query = "select * from books where isbn=".$isbn;
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    //����һ������isbn��ͼ��Ĺ�������
    $result = $result->fetch_assoc();
    return $result;
    
}
//���㹺�ﳵ����Ʒ��������
function calculateItems($cart) {
    $items = 0;
    if (is_array($cart)) {
        foreach ($cart as $isbn => $qty) {
            $items += $qty;
        }
    }
    return $items;
}
//���㹺�ﳵ����Ʒ���ܼ۸�
function calculatePrice($cart) {
    $price = 0.0;
    if (is_array($cart)) {
        $conn = dbConnect();
        foreach ($cart as $isbn => $qty) {
            $query = "select price from books where isbn='".$isbn."'";
            $result = $conn->query($query);
            if ($result) {
                //SQL��ѯ��������ִ���ʽ
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