<?php
//Fileが送信されてきているのか？チェック！
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    $upload = "upload";
    $file_name = $upload.$file_name;


    // FileUpload [--Start--]
    $img="";

if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path,$file_name)){
    chmod($file_name,0644);
    $img = $file_name;
    };
}

  // FileUpload [--End--]
 }else{
     $img = "画像が送信されていません";
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <main>
    <!-- ヘッダー -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="file_view.php">写真アップロード</a></div>
            </div>
        </nav>
    </header>
    <!-- ヘッダー -->
    <?php echo $img; ?>
</main>
<script src="js/jquery-2.1.3.min.js"></script>
<script>
    
</script>
</body>
</html>