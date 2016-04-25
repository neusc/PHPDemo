<html>
<head>
    <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
    //使用scandir()函数对文件名称排序
    $dir = '../uploads/';
    //scandir()默认是字母表升序,返回文件名称的数组
    $file1 = scandir($dir);
    $file2 = scandir($dir,1);
    
    echo "<p>Upload directory is $dir</p>";
    echo "<p>Directory Listing in alphabetical order,ascending:</p><ul>";
    //升序显示
    foreach ($file1 as $file){
        if ($file != "." && $file != ".."){
            echo "<li>$file</li>";
        }
    }
    echo '</ul>';
    
    echo "<p>Upload directory is $dir</p>";
    echo "<p>Directory Listing in alphabetical order,ascending:</p><ul>";
    //降序显示
    foreach ($file2 as $file){
        if ($file != "." && $file !=".."){
            echo "<li>$file</li>";
        }
    }
    echo '</ul>';
    
    
?>
</body>
</html>
