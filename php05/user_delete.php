<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
include "../../includes/funcs.php";
sessChk();

//1. DB接続します
$id = filter_input( INPUT_GET, "id" );
$pdo = db_con();

//2．データ登録SQL作成
$sql = "DELETE FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//3．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: user_select.php");
    exit;
}









?>