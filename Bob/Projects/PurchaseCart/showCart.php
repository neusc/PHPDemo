<?php
/*
 * 查看购物车或添加商品到购物车都会调用此文件,区别是是否传递new参数,即isbn号
 * 购物车围绕会话变量cart展开，其中cart['isbn'] = qty;
 * */
include ('book_sc_fns.php');
session_start();
//获取添加商品的isbn号,从showBook.php传递而来
@$new = $_GET['new'];
//判断显示购物车内容还是添加商品到购物车
if ($new) {
    if (!isset($_SESSION['cart'])) {
        //设置cart会话变量
        $_SESSION['cart'] = array();
        $_SESSION['items'] = 0;
        $_SESSION['totalPrice'] = 0.00;
    }
    //判断添加的商品在购物车中是否已经存在
    if (isset($_SESSION['cart'][$new])) {
        $_SESSION['cart'][$new]++;
    }else {
        $_SESSION['cart'][$new] = 1;
    }
    //计算购物车中所有商品的总数量和总价格    
    $_SESSION['items'] = calculateItems($_SESSION['cart']);
    $_SESSION['totalPrice'] = calculatePrice($_SESSION['cart']);
}
//变更购物车中商品数量时触发
if (isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $isbn => $qty) {
        //数量变更为0，购物车中销毁此商品
        if ($_POST[$isbn] == 0) {
            unset($_SESSION['cart'][$isbn]);
        }else {
            //对应displayCart函数中修改数量后的新数量
            $_SESSION['cart'][$isbn] = $_POST[$isbn];
        }
    }
    //重新计算变更数量后的总数量和总价格
    $_SESSION['items'] = calculateItems($_SESSION['cart']);
    $_SESSION['totalPrice'] = calculatePrice($_SESSION['cart']);
}

doHtmlHeader('Your shopping cart');
if ($_SESSION['cart'] && array_count_values($_SESSION['cart'])) {
    //显示购物车商品明细
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