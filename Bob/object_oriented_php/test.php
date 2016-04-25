<?php
/* 使用封装，通过使用类的方法访问属性，从类的外部直接访问属性是糟糕的 */
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
$a->attribute=5;    //该语句将间接调用__set()函数  */

/* 三种继承关键字实现控制访问 */
/* class A
{
    private function operation1() {     //不能被继承
        echo "operation1 called";
    }
    
    protected function operation2(){    //可以被继承但只能在子类内部使用
        echo "operation2 called";
    }
    
    public function operation3() {      //正常继承和调用
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
$b->operation2();       //protected方法不能再子类外部调用 */

/* 重载的使用 */
class A
{
    public $attribute="default value";
    final function operation()      //final关键字可以禁止类的重载和继承
    {
        echo "something<br/>";
        echo "The value of \$attribute is ".$this->attribute."<br/>";
    }
}

class B extends A
{
    public $attribute="different value";
    function operation() {
        parent::operation();    //调用父类的操作，但php将使用当前的属性
        /* echo "something else<br/>";
        echo "The value of \$attribute is ".$this->attribute."<br/>"; */
    }
}

$a=new A();
$a->operation();    //something   default value

$b=new B();
$b->operation();    //something   different value
