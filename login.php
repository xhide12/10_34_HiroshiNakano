<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用

// セッション開始
session_start();


$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "hiroshinakano";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }


    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM userData WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM userData WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: top.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
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

      .signup{
        padding-top:40px;
        padding-left:100px
      }

      .btn{
        margin-left:60px;
        margin-right:80px;
        margin-top:10px;   
      }

      .sign {
        display: inline-grid;
      }

      #loginForm {
        margin-top:40px;
        margin-left:140px;    

    }

    .youser {
        padding-top:10px;
      }



    </style>
</head>

    <body style="padding-top:4.5rem;">


    <nav class="navbar navbar-dark bg-dark text-white fixed-top">
        <div class="container youser">
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
            <strong><p>ようこそ「ライブハウス大作戦」へ</p></strong>  <!-- ユーザー名をechoで表示 -->
            <strong><p>　　　　　</p></strong>
        </div>
    </nav>


    <div class="container text-center mt-5">
        <div class="text-center bg-dark h-100 pt-4 pb-4 jumbotron">
            <p class="display-3 center-block text-white">ライブハウス大作戦</p>
            <p class="display-4 text-white">with コロナ</p>
        </div>
    </div>

<!-- Main[Start] -->

    <div class="container">
      
        <div class="row">
            <div class="col">
                <form id="loginForm" name="loginForm" action="" method="POST">
                    <strong>ログインはこちらから</strong>
                    <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                    <label for="userid">ユーザーID：</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                    <br>
                    <label for="password">パスワード：</label>
                    <input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                    <br>
                    <input type="submit" id="login" name="login" value="ログイン" class="btn-primary">
                </form>
            </div>

            <div class="col">
                <form action="SignUp.php" class="signup">
                    <div class="sign">          
                        <strong>\\\はじめての方はこちらから///</strong>
                        <input type="submit" value="新規登録" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>




  </body>
</html>