<html>
<head>
    <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
    $currentDir = '../uploads/';
    $dir = opendir($currentDir);
    
    echo "<p>Upload directory is $currentDir</p>";
    echo '<p>Directory Listing:</p><ul>';
    //���˳������嵥�е�.��..
    while (($file = readdir($dir)) !== false) {
//         if ($file != "." && $file != ".."){
//             echo "<li>$file</li>";
//         }
            if ($file != '.' && $file != '..'){
                echo '<a href="filedetails.php?file='.$file.'">'.$file.'</a><br/>';
            }
    }
    echo '</ul>';
    closedir($dir);
?>
</body>
</html>

