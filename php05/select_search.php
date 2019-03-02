<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
include "../../includes/funcs.php";
sessChk();


$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE email LIKE :s");
Value(":s")

$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    echo "false";
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';

        if($_SESSION["kanri_flg"]=="1"){
            $view .= '<a href="delete.php?id=' . $result["id"] . '">';
            $view .= "[☓]";
            $view .= '</a>';
        }

        if($_SESSION["kanri_flg"]=="1"){
            $view .= '<a href="detail.php?id=' . $result["id"] . '">';
            $view .= $result["name"] . "," . $result["email"] . "<br>";
            $view .= '</a>';
        }else{
            $view .= $result["name"] . "," . $result["email"] . "<br>";
        }

        $view .= '</p>';

    }

}
?>
