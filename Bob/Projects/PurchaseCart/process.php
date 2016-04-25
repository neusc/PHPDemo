<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader('Checkout');

$cardType = $_POST['cardType'];
$cardNumber = $_POST['cardNumber'];
$cardMonth = $_POST['cardMonth'];
$cardYear = $_POST['cardYear'];
$cardName = $_POST['cardName'];

if (($_SESSION['cart']) && ($cardType) && ($cardNumber) && ($cardYear) && ($cardMonth) && ($cardName)) {
    displayCart($_SESSION['cart'],false,0);
    displayShipping(calculateShippingCost());
    
    if ((processCard($_POST))) {
        //销毁用户会话
        session_destroy();
        echo "<p>Thank you for shopping with us. Your order has been placed!</p>";
        displayButton("index.php", "continue-shopping", "Continue Shopping");
    }else {
        echo "<p>Could not process your card.Please contact the card issuer or try again.</>";
        displayButton("purchase.php", "back", "Back");
    }
}else {
    echo "<p>You did not fill in all the fields,please try again.</p><hr/>";
    displayButton("purchase.php", "back", "Back");
}
doHtmlFooter();

?>