<?php
/*
 * ҳ����Դ��룬���ض����������ݴ�ӡ����Ļ���ڵ���
 */
echo "\n<!--BEGIN VARIABLE DUMP-->\n\n";

echo "<!--BEGIN GET VARS-->\n";
echo "<!--".dumpArray($_GET)."-->\n";

echo "<!--BEGIN POST VARS-->\n";
echo "<!--".dumpArray($_POST)."-->\n";

echo "<!--BEGIN SESSION VARS-->\n";
echo "<!--".dumpArray($_SESSION)."-->\n";

echo "<!--BEGIN COOKIES VARS-->\n";
echo "<!--".dumpArray($_COOKIE)."-->\n";

echo "\n<!--END VARIABLE DUMP-->\n\n";

function dumpArray($array){
    if (is_array($array)){
        $size = count($array);
        $string = "";
        if ($size){
            $count = 0;
            $string .= "{";
            foreach ($array as $var=>$value){
                $string .= $var."=".$value;
                if ($count++ < $size-1){
                    $string .= ",";
                }
                
            }
            $string .= "}";
        }
        return $string;
    }else {
        return $array;
    }
        
}
?>