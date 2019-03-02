<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$age    = $_POST["age"];
$naiyou = $_POST["naiyou"];

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

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db_php05;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table( name, email, naiyou, age, indate )VALUES(:name, :email, :naiyou, :age, sysdate())");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':naiyou', $naiyou);
$stmt->bindValue(':age', $age);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
