<?php
require_once("page.inc");

$class = new ReflectionClass("page");   //使用Reflection类的__toString()方法打印Page类的详细信息

echo "<pre>".$class."</pre>";