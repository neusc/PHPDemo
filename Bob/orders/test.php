<?php
    $array=array(1,2,3,2,3,2);
    /* $value=end($array);     //�����������һ��Ԫ��
    while ($value)
    {
        echo $value."<br/>";
        $value=prev($array);    //ָ�������ƶ�һ�β�������Ԫ��
    } */
    
    //echo current($array)."<br/>";   //����ָ��ָ��ĵ�ǰԪ��
    //echo next($array)."<br/>";        //ָ��ǰ�ƣ����ص�ǰ��Ԫ��
    //echo each($array)."<br/>";    //���ص�ǰԪ�أ�ǰ��һ��λ��
    //echo current($array)."<br/>";
    //echo reset($array)."<br/>";     //���ص�һ��Ԫ��
    
    /* function my_multiply(&$value,$key,$factor)
    {
        $value*=$factor;
    }
    array_walk($array, 'my_multiply',3);//�û��Զ��庯��������array_walk()�Ƕ�Ӧ��
    foreach ($array as $a)
    {
        echo $a."<br/>";
    } */
    $ac=array_count_values($array);
    print_r($ac);       //int print()��bool print_r()�Ǻ����з���ֵ,echo��php����޷���ֵ
    
?>