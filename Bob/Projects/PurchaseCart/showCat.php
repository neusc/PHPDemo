<?php
include ('book_sc_fns.php');
session_start();
//����catidͨ��URL�в�����ʽ���ݣ�ֻ��ͨ��GET��ʽ����
$catid = $_GET['catid'];
//����Ŀ¼��ʶ����ȡĿ¼��
$catname = getCategoryName($catid);
//�����ݿ��ȡ��ǰĿ¼�µ�ͼ����Ϣ
$bookArray = getBooks($catid);
//��ʾ��ǰĿ¼�µ�ͼ����Ϣ
displayBooks($bookArray);
//�ж��Ƿ��Թ���Ա��ݵ�¼,��ʾ��ͬ�Ĺ��ܲ˵�
if (isset($_SESSION['admin'])) {
    displayButton('index.php','continue','Continue Shopping');
    displayButton('admin.php', 'admin-menu','Admin Menu');
    displayButton("editCategoryForm.php?catid=".$catid,'edit-category','Edit Category');
}else {
    displayButton('index.php','continue','Continue Shopping');
}
doHtmlFooter();
?>