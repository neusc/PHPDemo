<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader('Checkout');
if (($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    displayCart($_SESSION['cart'],false,0);
    displayCheckoutForm();
}else {
    echo "<p>There are no items in your cart!</p>";
}

displayButton("showCart.php", "continue-shopping", "Continue Shopping");
doHtmlFooter();

?>