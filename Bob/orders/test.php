<?php
    $array=array(1,2,3,2,3,2);
    /* $value=end($array);     //返回数组最后一个元素
    while ($value)
    {
        echo $value."<br/>";
        $value=prev($array);    //指针往回移动一次并返回新元素
    } */
    
    //echo current($array)."<br/>";   //返回指针指向的当前元素
    //echo next($array)."<br/>";        //指针前移，返回当前新元素
    //echo each($array)."<br/>";    //返回当前元素，前移一个位置
    //echo current($array)."<br/>";
    //echo reset($array)."<br/>";     //返回第一个元素
    
    /* function my_multiply(&$value,$key,$factor)
    {
        $value*=$factor;
    }
    array_walk($array, 'my_multiply',3);//用户自定义函数参数与array_walk()是对应的
    foreach ($array as $a)
    {
        echo $a."<br/>";
    } */
    $ac=array_count_values($array);
    print_r($ac);       //int print()和bool print_r()是函数有返回值,echo是php语句无返回值
    
?>