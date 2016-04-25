<?php
class MyException extends Exception
{
    function __toString()
    {
        return "<table border=\"1\">
        <tr>
        <td><strong>Exception ".$this->getCode()."
        </strong>: ".$this->getMessage()."<br/>"."
        in ".$this->getFile()." on line ".$this->getLine()."
        </td>
        </tr>
        </table><br/>";
    }
}
try 
{
    throw new MyException("A terrible error has occurred",42);
}
catch (MyException $e)
{
    echo $e;
}

