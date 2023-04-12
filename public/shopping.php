<?php
session_start();
require "component.php";
require_once '../classes/UserLogic.php';
require_once '../functions.php';

$result = UserLogic::checkLogin();
if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください!';
  header('Location: signup_form.php');
  return;
}
$login_user = $_SESSION['login_user'];
?>


<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello, shpping!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #ffffe9;">
  <div class="container">

    <header class="py-3 m-4">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6">
            <h1 class="m-0">マイページ</h1>
          </div>
          <div class="col-6 text-end">
            <p class="m-0">ログインユーザ：<strong><?php echo h($login_user['name']) ?></strong></p>
            <p class="m-0">メールアドレス：<strong><?php echo h($login_user['email']) ?></strong></p>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
        <form action="logout.php" method="POST" class="float-end">
        <input type="submit" name="logout" value="ログアウト">
      </form>
      <p class="clearfix"><a href="../board/board5.php" class="btn btn-primary">掲示板へ</a></p>
    </div>
    <p><strong class="h6 tex-danger"><a href="cart.php" class="text-danger">買い物カゴ</a>は、
        <?php
        if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
          echo count($_SESSION["cart"]);
          echo "商品が入っています。";
        } else {
          echo "空です。";
        }
        ?></p>
    </strong>
    <div class="row">
      <?php for ($i = 0; $i < 4; $i++) { ?>
        <div class="col-md-3">
          <img src="<?php echo $product[$i]["img"]; ?>" class="card-img-top img-fluid" alt="...">
          <h5 class="card-title"><?php echo $product[$i]["product_name"]; ?></h5>
          <p class="card-text text-danger"><?php echo number_format($product[$i]["price"]); ?>円</p>

          <form action="cart.php" class="mt-3" method="post">
            <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
            <select name="num" class="form-select mb-3" aria-label="数量">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <button type="submit" class="btn btn-primary">カゴに入れる</button>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </div>
</body>

</html>