<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=hiroshinakano;host=localhost';
    try {
        $pdo = new PDO($param, 'root', 'root');
        return $pdo;

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

//ログインチェック
function loginCheck(){
    $_SESSION["chk_ssid"]  = session_id();
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
        header("Location: logout.php");
        exit;
    } else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
  }







?>