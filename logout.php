<?php
session_start();

if (isset($_SESSION["NAME"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ログアウト</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <style>
            .jumbotron {
                background-image: url("img/top00.jpg");
                background-size: cover;
                background-position: center 60%;
            }

            .log {
                text-align:center;
            }

            .youser {
                padding-top:10px;
            }

        </style>


    </head>
    <body>

    <body style="padding-top:4.5rem;">


    <nav class="navbar navbar-dark bg-dark text-white fixed-top">
        <div class="container youser">
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
            <strong><p>今日も遊びに来てくれてありがとうございます。また来てくださいね。</p></strong>  <!-- ユーザー名をechoで表示 -->
            <strong><p>　　　　　</p></strong>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <div class="text-center bg-dark h-100 pt-4 pb-4 jumbotron">
            <p class="display-3 center-block text-white">ライブハウス大作戦</p>
            <p class="display-4 text-white">with コロナ</p>
        </div>
    </div>

        <div class="container">


            <strong><div class="log"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div></strong>
            <strong><p class="log"><a href="Login.php">ログイン画面に戻る</a></p></strong>

        </div>    

    </body>
</html>