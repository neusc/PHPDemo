<?php
$dbConn = new mysqli('localhost','root','root','auth');
if (mysqli_connect_errno()){
    echo 'Connection to database failed: '.mysqli_connect_error();
    exit;
}
// $name = "O'reilly";
// $password = 'same';
// $name = addslashes($name);
// $query = "insert into authorized_users values('".$name."','".$password."')";
// $result = $dbConn->query($query);
// if ($result){
//     echo 'insert successful!';
// }else {
//     echo 'failed!';
// }
$query = "select * from authorized_users";
$result = $dbConn->query($query);
$numResults = $result->num_rows;
for ($i=0;i<4;$i++){
        $rows = $result->fetch_assoc();
        echo "Username: ";
        echo $rows['name'];
        echo '   ';
        echo "Password: ";
        echo $rows['password'];
        echo '<br/>';
    
}