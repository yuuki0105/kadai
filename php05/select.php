<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
include "../../includes/funcs.php";
sessChk();


$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
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


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1>アンケート一覧</h1>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(function() {
            //この中に処理を記述 開始

            //Ajax（非同期通信）//AJAX通信(ver1.5...)
            $.ajax({
                type: 'POST', //GET,POST
                url: 'ajax.php', //通信先URL
                data: { //Dataプロパティはデータを送信（渡す）役目
                    id: 1,
                    mode: 'hoge',
                    type: 'entry',
                    sleep: 0 //Timeoutテスト用
                },
                dataType: 'html', //text, html, xml, json, jsonp, script
                timeout: 3000,
                success: function(data) {
                    $("#ajax_status").text("通信完了！");
                    console.log(data);
                },
                error: function(error) {
                    console.log(error); //戻り値Allオブジェクト
                },
                complete: function() {
                    //成功＆エラー処理後に必ず実行したい処理を記述する
                    $("body").append("完了"); //戻り値Allオブジェクト
                }
            });


            //この中に処理を記述 終了
        });
    </script>