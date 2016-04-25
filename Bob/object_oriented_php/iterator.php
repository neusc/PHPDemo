<?php

//php��ʵ�����������ַ��������Ϊiterator
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
    
    //�ڲ�����ָ�����û����ݿ�ʼ��
    function rewind()  
    {
        $this->currentIndex = 0;
    }
    
    //�ж��Ƿ���ں���Ԫ��
    function valid()
    {
        return $this->currentIndex < $this->count;
    }
    
    //��������ָ���ֵ
    function key()
    {
        return $this->currentIndex;
    }
    
    //���ر����ڵ�ǰ����ָ���ֵ
    function current()
    {
        return $this->obj->data[$this->currentIndex];
    }
    
    //���������ƶ�����ָ���λ��
    function next()
    {
        $this->currentIndex++;
    }
    
    
}

//����iterator���๹��Ϊiterator
class Object implements IteratorAggregate
{
    public $data = array();
    
    function __construct($in)
    {
        $this->data = $in;
    }
    
    function getIterator() 
    {
        //ע��ArrayIterator()��ʹ��
        return new ObjectIterator($this);
    }
}

$myObject = new Object(array(2,4,6,8,10));

$myIterator = $myObject->getIterator();

//ֱ�ӽ����鴫��������Ҳ����
//$myIterator = new ObjectIterator(array(2,4,6,8,10));  

for ($myIterator->rewind();$myIterator->valid();$myIterator->next())
{
    $key = $myIterator->key();
    $value = $myIterator->current();
    echo $key."=>".$value."<br/>";
    
}