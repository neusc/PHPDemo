<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader("Checkout");

$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$country = $_POST['country'];

//判断所有表单是否已经填写
if (($_SESSION['cart'])&&($name)&&($address)&&($city)&&($zip)&&($country)) {
    //将用户填写的详细信息插入数据库
    if (insertOrder($_POST) != false) {
        //插入成功后显示购物车明细,不允许修改数量,不显示图片
        displayCart($_SESSION['cart'],false,0);
        //显示运费以及总金额
        displayShipping(calculateShippingCost());
        //显示信用卡信息表格
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