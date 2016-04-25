<?php
//文件无法打开
class FileOpenException extends Exception
{
    function __toString()
    {
        return "FileOpenException ".$this->getCode().": ".
           $this->getMessage()."<br/>"."in ".$this->getFile()." on line ".
           $this->getLine()."<br/>";
    }
}

//文件无法写入
class FileWriteException extends Exception
{
    function __toString()
    {
        return "FileWriteException ".$this->getCode().": ".
            $this->getMessage()."<br/>"."in ".$this->getFile()." on line ".
            $this->getLine()."<br/>";
    }
}

//无法获得文件写锁
class FileLockException extends Exception
{
    function __toString()
    {
        return "FileLockException ".$this->getCode().": ".
            $this->getMessage()."<br/>"."in ".$this->getFile()." on line ".
            $this->getLine()."<br/>";
    }
}