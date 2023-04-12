<?php

// データを取得するクエリを実行する
namespace board;
require_once dirname(__FILE__) . '/Bootstrap.class.php';


// use board\Database;
use board\Bootstrap;

$db = new Database(Bootstrap::DB_HOST, Bootstrap::DB_USER, Bootstrap::DB_PASS, Bootstrap::DB_NAME);


$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
    'cache' => Bootstrap::CACHE_DIR
]);




// データを取得するクエリを実行する

$msg = '';
$err_msg = '';
if (isset($_POST['send']) === true) {
    $name = $_POST['name'];
    $contents = $_POST['contents'];
    if ($name !== '' && $contents !== '') {
        $query = " INSERT INTO board ("
        . "name,"
        . "contents"
        . ") VALUES ("
        . $db->str_quote($name) . ","
        . $db->str_quote($contents) . ")";
        $res = $db->execute($query);
        if ($res !== false) {
            $msg = '書き込みに成功しました';
        } else {
            $err_msg = '書き込みに失敗しました';
        }
    } else {$err_msg = '名前とコメントを記入してください';
    }
}


$query = " SELECT "
        ." id, "
        ." name, "
        ." contents "
        ." FROM "
        ." board ";

$data = $db->select($query);

$db->close();
//変数の設定

$context = [];

$context['msg'] = $msg;
$context['err_msg'] = $err_msg;
$context['data'] = $data;

// $template = $twig->loadTemplate('board5.html.twig');
$template = $twig->load('board5.html.twig');
$template->display($context);

//下記のような記述でも可
// echo $twig->render('board.html.twig', $data);
