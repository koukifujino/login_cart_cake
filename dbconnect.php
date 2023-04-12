<?php

require_once './env.php';
ini_set('display_errors', true);
function connect()
{
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=xs442994_usercake', "xs442994_fujino", "28090060");
        return $pdo;
        // echo '成功です';
    } catch(PDOException $e) {
        echo '接続失敗です!'. $e->getMessage();
        exit();
    }
}


//DB接続
// try {
//     $pdo = new PDO('mysql:host=localhost;dbname=xs442994_usercake', "xs442994_fujino", "28090060");
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }