<?php
class employee{
    public  $name;
    public  $employee_id;
}

$emp = new employee();
$emp->name = "Fred";
$emp->employee_id = 5324;
//���л������������ת��Ϊ�ֽ������ڱ��浽�ļ������ݿ���
echo serialize($emp);
echo '<br/><br/>';
//�ҵ��Ѽ��ص�php��չ����
// echo 'Function sets supported in this install are:<br/>';
// $extensions = get_loaded_extensions();
// foreach ($extensions as $ext){
//     echo "$ext <br/>";
//     echo '<ul>';
//     $extFuncs = get_extension_funcs($ext);
//     foreach ($extFuncs as $func){
//         echo "<li>$func</li>";
//     }
//     echo '</ul>';
// }
// echo '<br/><br/>';
//ʶ��ű�������
echo get_current_user();
echo '<br/>';
//����޸�ʱ��
echo date('g:i a, j M Y',getlastmod());
echo '<br/>';
$oldMaxExecTime = ini_set('max_execution_time', 120);
echo "Old timeout is $oldMaxExecTime<br/>";
$maxExecTime = ini_get('max_execution_time');
echo "New timeout is $maxExecTime<br/>";
//Դ���������ʾ�������
show_source('authmain.php');
highlight_file('authmain.php');