<?php
require_once("page.inc");

$class = new ReflectionClass("page");   //ʹ��Reflection���__toString()������ӡPage�����ϸ��Ϣ

echo "<pre>".$class."</pre>";