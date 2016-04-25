<?php
include ('book_sc_fns.php');
session_start();
//��ȡ��Ҫ��ʾ��ϸ��Ϣ��ͼ���isbn��
$isbn = $_GET['isbn'];
//��ȡͼ�����ϸ��Ϣ,����title��isbn��author�ȣ�
$book = getBookDetails($isbn);
doHtmlHeader($book['title']);
//isbn��SQL����в���Ҫ������
//echo $isbn;
//echo $book['title'];
displayBookDetails($book);
$target = "index.php";
if ($book['catid']) {
    $target = "showCat.php?catid=".$book['catid'];
}
//�ж��Ƿ��Թ���Ա��ݵ�¼,��ʾ��ͬ�Ĺ��ܲ˵�
if (checkAdminUser()) {
    displayButton("editBookForm.php?isbn=".$isbn,'edit-item','Edit Item');
    displayButton('admin.php', 'admin-menu','Admin Menu');
    displayButton($target,'continue','Continue');
}else {
    //����ͼ����ӵ����ﳵ��ť
    displayButton("showCart.php?new=".$isbn, "add-to-cart",
                   "Add".$book['title']." To My Shopping Cart");
    displayButton($target, "continue-shopping", "Continue Shopping");
}
doHtmlFooter();
?>