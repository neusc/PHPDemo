<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader("Checkout");

$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$country = $_POST['country'];

//�ж����б��Ƿ��Ѿ���д
if (($_SESSION['cart'])&&($name)&&($address)&&($city)&&($zip)&&($country)) {
    //���û���д����ϸ��Ϣ�������ݿ�
    if (insertOrder($_POST) != false) {
        //����ɹ�����ʾ���ﳵ��ϸ,�������޸�����,����ʾͼƬ
        displayCart($_SESSION['cart'],false,0);
        //��ʾ�˷��Լ��ܽ��
        displayShipping(calculateShippingCost());
        //��ʾ���ÿ���Ϣ���
        displayCardForm($name);
        displayButton('showCart.php', 'continue-shopping', 'Contine Shopping');
    }else {
        echo '<p>Could not store data,please try again!</p>';
        displayButton('checkout.php', 'back', 'Back');
    }
    
}else {
    echo "<p>You did not fill in all the fields,please try again!</p><hr/>";
    displayButton('checkout.php', 'back', 'Back');
}

doHtmlFooter();
?>