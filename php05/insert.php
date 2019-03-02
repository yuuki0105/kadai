<?php
//1. POSTデータ取得
$name   = filter_input( INPUT_POST, "name" );
$email  = filter_input( INPUT_POST, "email" );
$naiyou = filter_input( INPUT_POST, "naiyou" );
$age    = filter_input( INPUT_POST, "age" );

//2. DB接続します
include "funcs.php";
$pdo = db_con();

//Fileが送信されてきているのか？チェック！
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    $upload = "upload";
    $file_name = $upload.$file_name;


    // FileUpload [--Start--]
    $img="";

if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path,$file_name)){
    chmod($file_name,0644);
    // $img = $file_name;
    };
}

  // FileUpload [--End--]
 }else{
     $img = "画像が送信されていません";
 }

//３．データ登録SQL作成
$sql = "INSERT INTO gs_an_table(name,email,naiyou,indate,age,:filename,indate )VALUES(:name,:email,:naiyou,sysdate(),:age)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':filename,$file_name); //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    echo "false";
} else {
    //５．index.phpへリダイレクト
    header("Location: index.php");
    exit;
}
