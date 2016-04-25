<html>
<head>
    <title>Uploading</title>
</head>
<body>
<h1>Uploading file...</h1>
<?php
    //检测上传文件发生的错误类型
    if ($_FILES['userfile']['error']>0){
        echo 'Problem:';
        switch ($_FILES['userfile']['error']){
            case 1: echo 'File exceeded upload_max_filesize';
                    break;
            case 2: echo 'File exceeded FILE_MAX_SIZE';
                    break;
            case 3: echo 'File only partially uploaded';
                    break;
            case 4: echo 'No file uploaded';
                    break;
            case 6: echo 'Cannot upload file: No temp directory specified';
                    break;
            case 7: echo 'Upload failed: Cannot write to disk';
                    break;
        }
        exit;
    }
    //检测上传文件类型是否为正确的MIME类型
    if ($_FILES['userfile']['type'] != 'text/plain'){
        echo 'Problem: file is not plain text.';
        exit;
    }
    
    echo $_FILES['userfile']['tmp_name'].'<br/>';
    echo $_FILES['userfile']['name'].'<br/>';
    echo $_FILES['userfile']['type'].'<br/>';
    echo $_FILES['userfile']['size'].'<br/>';
    echo $_FILES['userfile']['error'].'<br/>';
    
    //移动文件到指定路径
    //basename()过滤上传文件中包含的路径
    $upfile = '../uploads/'.basename($_FILES['userfile']['name']);
    
    //检查文件是否通过HTTP POST上传
    //注意此处必须使用tem_name而不能使用name代替
    // ./表示当前层，../表示上一层
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])){
        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)){
            echo 'Problem: Could not move file to destination directory';
            exit;
        }
    }else {
        echo 'Problem: Possible file upload attack. Filename:';
        echo $_FILES['userfile']['name'];
        exit;
    }
    
    echo 'File uploaded successfully<br/><br/>';
    
    //移除可能存在的html和php标记
    $contents = file_get_contents($upfile);
    $contents = strip_tags($contents);
    file_put_contents($_FILES['userfile']['name'], $contents);
        
    //输出上传文件的内容
    echo '<p>Preview of uploaded file contents:<br/><hr/>';
    echo nl2br($contents);
    echo '<br/><hr/>';
    
    
    
?>
</body>
</html>


