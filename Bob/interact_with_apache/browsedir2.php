<html>
<head>
    <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
    $dir = dir("../uploads/");
    
    echo "<p>Handdle is $dir->handle</p>";
    echo "<p>Upload directory is $dir->path</p>";
    echo "<p>Directory Listing:</p><ul>";
    
    while (($file = $dir->read()) !== false){
        if ($file != "." && $file != ".."){
            echo "<li>$file</li>";
        }
    }
    
    echo '</ul>';
    $dir->close();
?>
</body>
</html>

