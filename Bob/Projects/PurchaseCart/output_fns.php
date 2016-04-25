<?php
//显示当前所有的目录
function displayCategories($catArray) {
    if (!is_array($catArray)) {
        echo "<p>No categories currently available</p>";
        return ;
    }
    echo "<ul>";
    //$catArray每一项都是一个关联数组
    foreach ($catArray as $row) {
        $url = "showCat.php?catid=".$row['catid'];
        $title = $row['catname'];
        echo "<li>";
        doHtmlUrl($url, $title);
        echo "</li>";
    }
    echo "</ul>";
    echo "<hr/>";
}
//显示某个目录下的所有图书
function displayBooks($bookArray) {
    if (!is_array($bookArray)) {
        echo "<p>No books currently available in current category<p/>";
        return ;
    }
    echo "<ul>"; 
    foreach ($bookArray as $row) {
        $url = "showBook.php?isbn=".$row['isbn'];
        $title = $row['title'];
        echo "<li>";
        doHtmlUrl($url, $title);
        echo "</li>";
    }
    echo "</ul>";
    echo "<hr/>";
}
//显示图书的详细信息
function displayBookDetails($book) {
    if (is_array($book)) {
        echo "<table><tr>";
        echo "<td><ul>";
        echo "<li><strong>Author: </strong>";
        echo $book['author'];
        echo "</li><li><strong>ISBN: </strong>";
        echo $book['isbn'];
        echo "</li><strong>Our Price: </strong>";
        echo $book['price'];
        echo "</li><li><strong>Description: </strong>";
        echo $book['description'];
        echo "</li></ul></td></tr></table>";
        
    }else {
        echo "<p>The details of the book cannot be displayed this time!</p>";
    }
    echo "<hr/>";
}
function doHtmlHeader($title) {
    //使用items和totalPrice两个会话变量来控制标题栏的显示
    if (!$_SESSION['items']) {
        $_SESSION['items'] = 0;
    }
    if (!$_SESSION['totalPrice']) {
        $_SESSION['totalPrice'] = 0.00;
    }

?>
<html>
<head>
	<title><?php echo $title;?></title>
	<style>
        
    </style>
</head>
<body>
	<table width="100%" border="0" cellspacing="0" bgcolor="#cccccc">
		<tr>
		<td rowspan="2"><a href="index.php"><img alt="Bookorama" src="images/Book-O-Rama.gif" align="left" height="55" width="325"></a></td>
		<td align="right">
		<?php 
		  if (isset($_SESSION['admin'])) {
		      //html中&nbsp;表示空格，在html中不管都少个空格或空行都显示为一个空格
		      echo "&nbsp;";
		  }else {
		      echo "Total Items = ".$_SESSION['items'];
		  }
		?>
		</td>
		<td align="right">
		<?php 
		  if (isset($_SESSION['admin'])) {
		      displayButton('logout.php','log-out','Log Out');
		  }else {
		      //显示查看购物车按钮
		      displayButton('showCart.php','view-cart','View Cart');
		  }
		?>
		</td>
		</tr>
		<tr>
		<td align="right">
		<?php 
		  if (isset($_SESSION['admin'])) {
		      echo "&nbsp;";
		  }else {
		      echo "Total Price = $".number_format($_SESSION['totalPrice'],2);
		  }
		?>
		</td>
		</tr>
	</table>
<?php 
if ($title) {
    doHtmlHeading($title);
}
?>

<?php
}
function doHtmlHeading($heading) {
?>
<h2><?php echo $heading;?></h2>
<?php
}
function doHtmlUrl($url,$name) {
?>
<br/><a href="<?php echo $url;?>"><?php echo $name;?></a><br/>
<?php 
}
function displayButton($target,$image,$alt) {
    echo "<div align=\"center\"><a href=\"".$target."\"><img src=\"images/".$image.".gif\" alt=\"".$alt."\"></a></div>";
}
function doHtmlFooter() {
?>
</body>
</html>
<?php 
}
function displayCart($cart,$change=true,$image=1) {
    //显示购物车明细，有选择地显示图片或更改数量
    echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
          <form action=\"showCart.php\" method=\"post\">
          <tr><th colspan=\"".(1+$image)."\" bgcolor=\"#cccccc\">Item</th>
          <th bgcolor=\"#cccccc\">Price</th>
          <th bgcolor=\"#cccccc\">Quantity</th>
          <th bgcolor=\"#cccccc\">Total</th>
          </tr>";
    //遍历显示每一种商品的明细
    foreach ($cart as $isbn=>$qty) {
        $book = getBookDetails($isbn);
        echo "<tr>";
        //判断商品对应的图片是否存在便于控制显示格式
        if ($image == true) {
            echo "<td align=\"left\">";
            if (file_exists("image/".$isbn.".jpg")) {
                $size = getimagesize("image/".$isbn.".jpg");
                if (($size[0] > 0) && ($size[1] >0)) {
                    echo "<img src=\"images/".$isbn.".jpg\" 
                            style=\"border: 1px solid black\"
                            width=\"".($size[0]/3)."\"
                            height=\"".($size[1]/3)."\"/>";
                }
            }else {
                echo "&nbsp;";
            }
            echo "</td>";
        }
        //显示商品的名称和单价
        echo "<td align=\"left\">
              <a href=\"showBook.php?isbn=".$isbn."\">".$book['title']."</a>
              by ".$book['author']."</td>
              <td align=\"center\">\$".number_format($book['price'],2)."</td>
              <td align=\"center\">";
        //根据需要设置商品的数量是否允许被更改
        if ($change == true) {
            //当文本框中数量被修改时,showCart.php中通过$_POST['$isbn']得到新的数量
            echo "<input type=\"text\" name=\"".$isbn."\" value=\"".$qty."\"
                  size=\"3\">";
        }else {
            echo $qty;
        }
        //求某一商品的总价
        echo "</td>
              <td align=\"center\">\$".number_format($book['price']*$qty,2)."</td></tr></n>";
       
    }
    //汇总所有商品的总数目和总价格
    echo "<tr>
	       <th colspan=\"".(2+$image)."\" bgcolor=\"#cccccc\">&nbsp;</th>
		   <th align=\"center\" bgcolor=\"#cccccc\">".$_SESSION['items']."</th>
		   <th align=\"center\" bgcolor=\"cccccc\">\$".number_format($_SESSION['totalPrice'],2)."</th></tr>";
    //显示save changes按钮,type="image"也可以提交表单，不一定必须使用submit类型
    //根据页面需要确定是否需要显示save changes按钮
    if ($change == true) {
        echo "<tr>
		      <td colspan=\"".(2+$image)."\">&nbsp;</td>
		      <td align=\"center\">
		          <input type=\"hidden\" name=\"save\" value=\"true\"/>
		          <input type=\"image\" src=\"images/save-changes.gif\" border=\"0\" alt=\"Save Changes\"/>
		      </td>
		      <td>&nbsp;</td>
		      </tr>";
    }
    echo "</form></table>";
}
function displayCheckoutForm() {
    
?>
<br />
  <table border="0" width="100%" cellspacing="0">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Your Details</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cccccc">Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="ship_country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p><strong>Please press Purchase to confirm
         your purchase, or Continue Shopping to add or remove items.</strong></p>
     <?php displayFormButton("purchase", "Purchase These Items"); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php 
}
function displayFormButton($image,$alt) {
    echo "<div align=\"center\"><input type=\"image\"
           src=\"images/".$image.".gif\"
           alt=\"".$alt."\" border=\"0\" height=\"50\"
           width=\"135\"/></div>";;
}
//显示计算运费后的总价格
function displayShipping($shipping) {
?>
  <table border="0" width="100%" cellspacing="0">
  <tr><td align="left">Shipping</td>
      <td align="right"> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cccccc" align="left">TOTAL INCLUDING SHIPPING</th>
      <th bgcolor="#cccccc" align="right">$ <?php echo number_format($shipping+$_SESSION['totalPrice'], 2); ?></th>
  </tr>
  </table><br />
<?php 
}
function displayCardForm($name) {
    //显示编辑信用卡详细信息的表格
    ?>
  <table border="0" width="100%" cellspacing="0">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name="cardType">
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="cardNumber" value="" maxlength="16" size="40"></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type="text" name="amexCode" value="" maxlength="4" size="4"></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month
       <select name="cardMonth">
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Year
       <select name="cardYear">
       <?php
       for ($y = date("Y"); $y < date("Y") + 10; $y++) {
         echo "<option value=\"".$y."\">".$y."</option>";
       }
       ?>
       </select>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type="text" name="cardName" value = "<?php echo $name; ?>" maxlength="40" size="40"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <p><strong>Please press Purchase to confirm your purchase, or Continue Shopping to
      add or remove items</strong></p>
     <?php displayFormButton('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </table>
<?php
}
function displayLoginForm() {
?>
 <form method="post" action="admin.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Username:</td>
     <td><input type="text" name="userName"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passWord"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
 </table></form>
<?php
}
function displayAdminMenu() {
?>
<br />
<a href="index.php">Go to main site</a><br />
<a href="insert_category_form.php">Add a new category</a><br />
<a href="insert_book_form.php">Add a new book</a><br />
<a href="change_password_form.php">Change admin password</a><br />
<?php
}

?>

