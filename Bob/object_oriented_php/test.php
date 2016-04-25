<?php
/* ʹ�÷�װ��ͨ��ʹ����ķ����������ԣ�������ⲿֱ�ӷ������������� */
/* class classname
{
    public $attribute;
    function __get($name)
    {
        return $this->attribute;
    }
    
    function __set($name,$value)
    {
        $this->$name=$value;
    }
}

$a=new classname();
$a->attribute=5;    //����佫��ӵ���__set()����  */

/* ���ּ̳йؼ���ʵ�ֿ��Ʒ��� */
/* class A
{
    private function operation1() {     //���ܱ��̳�
        echo "operation1 called";
    }
    
    protected function operation2(){    //���Ա��̳е�ֻ���������ڲ�ʹ��
        echo "operation2 called";
    }
    
    public function operation3() {      //�����̳к͵���
        echo "operation3 called";
    }
}

class B extends A
{
    function __construct()
    {
        //$this->operation1();
        $this->operation2();
        $this->operation3();
    }
}

$b = new B();
$b->operation2();       //protected���������������ⲿ���� */

/* ���ص�ʹ�� */
class A
{
    public $attribute="default value";
    final function operation()      //final�ؼ��ֿ��Խ�ֹ������غͼ̳�
    {
        echo "something<br/>";
        echo "The value of \$attribute is ".$this->attribute."<br/>";
    }
}

class B extends A
{
    public $attribute="different value";
    function operation() {
        parent::operation();    //���ø���Ĳ�������php��ʹ�õ�ǰ������
        /* echo "something else<br/>";
        echo "The value of \$attribute is ".$this->attribute."<br/>"; */
    }
}

$a=new A();
$a->operation();    //something   default value

$b=new B();
$b->operation();    //something   different value
