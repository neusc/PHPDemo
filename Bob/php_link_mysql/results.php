<html>
<head>
	<title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
    $searchtype=$_POST["searchtype"];
    $searchterm=trim($_POST["searchterm"]);
    
    if (!$searchtype||!$searchterm){
        echo "You have not entered search details.Please go back and try again.";
        exit;       //终止php脚本的执行
    }
    //判读是否开启魔术引号,先版本已经废除
    if (!get_magic_quotes_gpc()){
        $searchtype=addslashes($searchtype);
        $searchterm=addslashes($searchterm);
    }
    //面向对象连接数据库方法
    @ $db = new mysqli('localhost','bookorama','same','books');
    //面向过程连接,返回一个资源句柄,表示到数据库的连接
    //@ $db = mysqli_connect('localhost','bookorama','same','books');
    if(mysqli_connect_errno()){
        echo 'Error:Could not connect to database.Please try again later.';
        exit;
    }
    
//     $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
//     $result = $db->query($query);
   
//     //面向对象版本
//     $num_results = $result->num_rows;
//     echo "<p>Number of books found: ".$num_results."</p>";
    
//     for ($i=0;$i<$num_results;$i++){
//         $row = $result->fetch_assoc();
//         echo "<p><strong>".($i+1).". Title: ";
//         echo htmlspecialchars(stripslashes($row['title']));
//         echo "</strong><br/>Author: ";
//         //从数据库读出数据此处可以不用stripslashes
//         echo stripslashes($row['author']);
//         echo "<br/>ISBN: ";
//         echo stripslashes($row['isbn']);
//         echo "<br/>Price: ";
//         echo stripslashes($row['price']);
//         echo "</p>";
//     }
//     $result->free();
//     $db->close();
       
       //prepared语句绑定结果列 
       $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
       $stmt = $db->prepare($query);
       $stmt->bind_result($isbn,$author,$title,$price);
       $stmt->execute();
       //每循环一次，fetch()函数获得结果集下一行结果行
       while ($stmt->fetch()){
           echo "<p><strong>"." Title: ";
           echo htmlspecialchars(stripslashes($title));
           echo "</strong><br/>Author: ";
           echo stripslashes($author);
           echo "<br/>ISBN: ";
           echo stripslashes($isbn);
           echo "<br/>Price: ";
           echo stripslashes($price);
           echo "</p>";
       }
       $stmt->close();
     //面向过程版本
    /* $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    echo "<p>Number of books found: ".$num_results."</p>";
    for ($i=0;$i<$num_results;$i++){
        $row = mysqli_fetch_assoc($result);
        echo "<p><strong>".($i+1).". Title: ";
        echo htmlspecialchars(stripslashes($row['title']));
        echo "</strong><br/>Author: ";
        echo stripslashes($row['author']);
        echo "<br/>ISBN: ";
        echo stripslashes($row['isbn']);
        echo "<br/>Price: ";
        echo stripslashes($row['price']);
        echo "</p>";
    } */
    
    
    
?>
</body>
</html>