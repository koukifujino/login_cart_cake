<?php
session_start();
require_once '../classes/UserLogic.php';
$result = UserLogic::checkLogin();
if($result) {
    header('Location: shopping.php');
    return;
}
$err = $_SESSION;

//セッションを消す
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h2>ログインフォーム</h2>
            <?php if (isset($err['msg'])) : ?>
                <p style="color:red;"><?php echo $err['msg']; ?></p>
            <?php endif; ?>
    <form action="login.php" method="POST">
        <p>
            <label for="email">メールアドレス：</label>
            <input type="email" name="email">
            <?php if (isset($err['email'])) : ?>
                <p style="color:red;"><?php echo $err['email']; ?></p>
            <?php endif; ?>
        </p>
        <p>
            <label for="password">パスワード：</label>
            <input type="password" name="password">
            <?php if (isset($err['password'])) : ?>
                <p style="color:red;"><?php echo $err['password']; ?></p>
            <?php endif; ?>
        </p>
        <p><input type="submit" value="ログイン"></p>
        <p><a href="signup_form.php">新規登録はこちら</a></p>
    </form>
</body>

</html>