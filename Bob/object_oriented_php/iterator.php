<?php

//php将实现了如下五种方法的类成为iterator
class ObjectIterator implements Iterator
{
    private $obj;
    private $count;
    private $currentIndex;
    
    function __construct($obj)
    {
        $this->obj = $obj;
        $this->count = count($this->obj->data);
    }
    
    //内部数据指针设置回数据开始处
    function rewind()  
    {
        $this->currentIndex = 0;
    }
    
    //判断是否存在后续元素
    function valid()
    {
        return $this->currentIndex < $this->count;
    }
    
    //返回数据指针的值
    function key()
    {
        return $this->currentIndex;
    }
    
    //返回保存在当前数据指针的值
    function current()
    {
        return $this->obj->data[$this->currentIndex];
    }
    
    //在数据中移动数据指针的位置
    function next()
    {
        $this->currentIndex++;
    }
    
    
}

//将非iterator的类构造为iterator
class Object implements IteratorAggregate
{
    public $data = array();
    
    function __construct($in)
    {
        $this->data = $in;
    }
    
    function getIterator() 
    {
        //注意ArrayIterator()的使用
        return new ObjectIterator($this);
    }
}

$myObject = new Object(array(2,4,6,8,10));

$myIterator = $myObject->getIterator();

//直接将数组传给迭代器也可以
//$myIterator = new ObjectIterator(array(2,4,6,8,10));  

for ($myIterator->rewind();$myIterator->valid();$myIterator->next())
{
    $key = $myIterator->key();
    $value = $myIterator->current();
    echo $key."=>".$value."<br/>";
    
}