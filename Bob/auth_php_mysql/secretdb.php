<?php
    $name = $_POST['name'];
    $password = $_POST['password'];
    if (!isset($name)||!isset($password)){
?>
    <h1>Please Log In</h1>
    <p>This page is secret.</p>
    <form action="secretdb.php" method="post">
    <p>Username:<input type="text" name="name"></p>
    <p>Password:<input type="password" name="password"></p>
    <p><input type="submit" name="submit" value="log in"></p>
    </form>
<?php 
    }else {
        $mysql = new mysqli("localhost","webauth","webauth","auth");
        if (!$mysql){
            echo "Cannot connect to database.";
            exit;
        }
        //sha1()���������������
        $query = "select count(*) from authorized_users where name='".$name."' and password='".sha1($password)."'";
        $result = $mysql->query($query);
        //mysqli_fetch_row()����ö������,mysqli_fetch_assoc()���ع�������
        $row = mysqli_fetch_row($result);
        //�˴�������������������������ַ���
        //$row = $result->fetch_row();
        $count = $row[0];
        if ($count>0){
            echo "<h1>Here it is!</h1>
                    <p>You should be very glad!</p>";
        }
        else {
            echo "<h1>Go Away!</h1>
                    <p>You are not authorized to use this resource.</p>";
        }
    }
    
?>