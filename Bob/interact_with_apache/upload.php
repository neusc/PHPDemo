<html>
<head>
    <title>Uploading</title>
</head>
<body>
<h1>Uploading file...</h1>
<?php
    //����ϴ��ļ������Ĵ�������
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
    //����ϴ��ļ������Ƿ�Ϊ��ȷ��MIME����
    if ($_FILES['userfile']['type'] != 'text/plain'){
        echo 'Problem: file is not plain text.';
        exit;
    }
    
    echo $_FILES['userfile']['tmp_name'].'<br/>';
    echo $_FILES['userfile']['name'].'<br/>';
    echo $_FILES['userfile']['type'].'<br/>';
    echo $_FILES['userfile']['size'].'<br/>';
    echo $_FILES['userfile']['error'].'<br/>';
    
    //�ƶ��ļ���ָ��·��
    //basename()�����ϴ��ļ��а�����·��
    $upfile = '../uploads/'.basename($_FILES['userfile']['name']);
    
    //����ļ��Ƿ�ͨ��HTTP POST�ϴ�
    //ע��˴�����ʹ��tem_name������ʹ��name����
    // ./��ʾ��ǰ�㣬../��ʾ��һ��
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
    
    //�Ƴ����ܴ��ڵ�html��php���
    $contents = file_get_contents($upfile);
    $contents = strip_tags($contents);
    file_put_contents($_FILES['userfile']['name'], $contents);
        
    //����ϴ��ļ�������
    echo '<p>Preview of uploaded file contents:<br/><hr/>';
    echo nl2br($contents);
    echo '<br/><hr/>';
    
    
    
?>
</body>
</html>


