<html>
<head>
	<title>Book-O-Rama Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Entry Results</h1>
<?php
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    
    if (!$isbn||!$author||!$title||!$price){
        echo "You have not entered all the required details.
                Please go back and try again.";
    }
    
    if (!get_magic_quotes_gpc()){
        $isbn = addslashes($_POST['isbn']);
        $author = addslashes($_POST['author']);
        $title = addslashes(($_POST['title']));
        $price = addslashes($_POST['price']);
    }
    
    @ $db = new mysqli('localhost','bookorama','same','books');
    if (mysqli_connect_errno()){
        echo "Error: Could not connect to database.Please try again later.";
        exit;
    }
    
//     $query = "insert into books values
//                 ('".$isbn."', '".$author."', '".$title."', '".$price."')";
//     $result = $db->query($query);
//     if($result){
//         echo $db->affected_rows." book inserted into database.";
//     }else {
//         echo "An error has occurred. The item was not added.";
//     }
//     $db->close();

    //preparedÓï¾äµÄÓÃ·¨
    $query = "insert into books value(?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sssd",$isbn,$author,$title,$price);
    $stmt->execute();
    echo $stmt->affected_rows.' book inserted into database.';    
    $stmt->close();
    
    
?>
</body>
</html>