<?php
include ('book_sc_fns.php');
session_start();
doHtmlHeader('Welcome to Book-O-Rama');

echo 'Please choose a category';
//�����ݿ���ͼ��Ŀ¼������
$catArray = getCategories();
//��ʾ��ǰͼ�������Ŀ¼
displayCategories($catArray);
//�����Ϊ����Ա�û���¼,��Ҫ��ʾ��ӡ�ɾ���ͱ༭Ŀ¼������
if (isset($_SESSION['admin'])) {
    displayButton('admin.php','admin-menu','Admin Menu');
}
doHtmlFooter();
?>
      