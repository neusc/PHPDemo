<?php
/*
 * �鿴���ﳵ�������Ʒ�����ﳵ������ô��ļ�,�������Ƿ񴫵�new����,��isbn��
 * ���ﳵΧ�ƻỰ����cartչ��������cart['isbn'] = qty;
 * */
include ('book_sc_fns.php');
session_start();
//��ȡ�����Ʒ��isbn��,��showBook.php���ݶ���
@$new = $_GET['new'];
//�ж���ʾ���ﳵ���ݻ��������Ʒ�����ﳵ
if ($new) {
    if (!isset($_SESSION['cart'])) {
        //����cart�Ự����
        $_SESSION['cart'] = array();
        $_SESSION['items'] = 0;
        $_SESSION['totalPrice'] = 0.00;
    }
    //�ж���ӵ���Ʒ�ڹ��ﳵ���Ƿ��Ѿ�����
    if (isset($_SESSION['cart'][$new])) {
        $_SESSION['cart'][$new]++;
    }else {
        $_SESSION['cart'][$new] = 1;
    }
    //���㹺�ﳵ��������Ʒ�����������ܼ۸�    
    $_SESSION['items'] = calculateItems($_SESSION['cart']);
    $_SESSION['totalPrice'] = calculatePrice($_SESSION['cart']);
}
//������ﳵ����Ʒ����ʱ����
if (isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $isbn => $qty) {
        //�������Ϊ0�����ﳵ�����ٴ���Ʒ
        if ($_POST[$isbn] == 0) {
            unset($_SESSION['cart'][$isbn]);
        }else {
            //��ӦdisplayCart�������޸��������������
            $_SESSION['cart'][$isbn] = $_POST[$isbn];
        }
    }
    //���¼���������������������ܼ۸�
    $_SESSION['items'] = calculateItems($_SESSION['cart']);
    $_SESSION['totalPrice'] = calculatePrice($_SESSION['cart']);
}

doHtmlHeader('Your shopping cart');
if ($_SESSION['cart'] && array_count_values($_SESSION['cart'])) {
    //��ʾ���ﳵ��Ʒ��ϸ
    displayCart($_SESSION['cart']);
}else {
    echo "<p>There are no items </p>";
}

$target = "index.php";
if ($new) {
    $details = getBookDetails($new);
    if ($details['catid']) {
        $target = "showCat.php?catid=".$details['catid'];
    }
}
displayButton($target, 'continue-shopping', 'Continue Shopping');
displayButton('checkout.php', 'go-to-checkout', 'Go To Checkout');

doHtmlFooter();
?>