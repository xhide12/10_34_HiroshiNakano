<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用

// セッション開始
session_start();


// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "functions.php";
$pdo = connectDB();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM images WHERE image_id = :id");
$stmt ->bindvalue(":id",$id,PDO::PARAM_INT);//PDO::PARAM_STR
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
  //SQLエラー関数
  sql_error($stmt);
}else{
  $images = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
      .text{
        margin-top: 20px;
      }
      .onamae{
      padding-top: 20px;
      }
      .livehouse{
        width:250px;
      }

      .jumbotron {
        background-image: url("img/top00.jpg");
        background-size: cover;
        background-position: center 60%;
      }

      .youser {
        padding-top:10px;
      }

      /* fieldset{
      display: flex;
      } */

      /* label{
        text-align: center;
      }

      .button{
        margin: 0 auto;
      } */

    </style>
</head>
<body style="padding-top:4.5rem;">

<nav class="navbar navbar-dark bg-dark text-white fixed-top">
  <div class="container youser">
  <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
      <strong><p>ようこそ <u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u> さん</p></strong>  <!-- ユーザー名をechoで表示 -->
      <strong><p>ログアウトは<a href="Logout.php">こちら</a>から</p></strong>
  </div>
</nav>

<div class="container text-center mt-5">
  <div class="text-center bg-dark h-100 pt-4 pb-4 jumbotron">
      <p class="display-3 center-block text-white">ライブハウス大作戦</p>
      <p class="display-4 text-white">with コロナ</p>
  </div>
</div>

<!-- Main[Start] -->


<form method="post" action="update.php">
  <div class="card">
   <fieldset>
    <div class="card-header">投稿の編集</div>
     <label>名前：<br><input type="text" name="toukou" value="<?=$images['image_toukou']?>"></label><br>
     <label>ライブハウス名：<br><input type="text" name="house" value="<?=$images['image_house']?>"></label><br>
     <label>応援コメント：<br><textArea name="coment" rows="4" cols="40"><?=$images['image_coment']?></textArea></label><br>
    <input type="hidden" name="id" value="<?=$images['image_id']?>">
    <input type="submit" value="送信" class="button">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>