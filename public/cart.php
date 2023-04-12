<?php
session_start();
require_once "component.php";
require_once '../classes/UserLogic.php';
require_once '../functions.php';

$result = UserLogic::checkLogin();
if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください!';
  header('Location: signup_form.php');
  exit;
}

$login_user = $_SESSION['login_user'];

$array = array();

if (isset($_SESSION["cart"])) {
  $array = $_SESSION["cart"];
}

if (isset($_POST["product_name"]) && isset($_POST["num"])) {
  $array_product_name = array_column($array, "product_name");
  if (in_array($_POST["product_name"], $array_product_name)) {
    $index = array_search($_POST["product_name"], $array_product_name);
    $array[$index]["num"] += $_POST["num"];
  } else {
    $array[] = array(
      "product_name" => $_POST["product_name"],
      "num" => $_POST["num"]
    );
  }
}

if (isset($_POST["product_name"]) && !isset($_POST["num"])) {
  $array_product_name = array_column($array, "product_name");
  if (in_array($_POST["product_name"], $array_product_name)) {
    $index = array_search($_POST["product_name"], $array_product_name);
    unset($array[$index]);
    $array = array_values($array);
  }
}

$_SESSION["cart"] = $array;
?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, shpping!</title>
</head>

<body style="background-color: #ffffe9;">
  <div class="container text-center">

    <div class="container text-center">
      <h1 class="mt-5"><?php echo h($login_user['name']) ?>様：購入カート</h1>
      <?php
      $gokei = 0;
      foreach ($array as $key => $value) {
        echo "<div class='row mt-2'>";
          echo "<div class='col-3'>";

          //商品名のカラムのみを検索
          $array_product_name = array_column( $product,"product_name" );
          if ( in_array( $value['product_name'] , $array_product_name) ){
            $index = array_search( $value['product_name'] , $array_product_name );
            $price = $product[$index]["price"];
            $img = $product[$index]["img"];
            echo "<div><img src='./$img' class='img-fluid' style='height: auto;'></div>";
          }
          echo "</div>\n";
          echo "<div class='col-3 align-self-center'>";
          //echo $key;
          echo "<h3 class='mb-0'>".$value['product_name']."</h3>";
          echo "<h4 class= 'text-danger mb-0'>".number_format($price)."円</h4>";
          echo "<h4 class='mt-1'>数量：".$value['num']."</h4>";
          echo "</div>\n";
          echo "<div class='col-3 align-self-center' style='display:inline-flex;align-items: center;'>";
          ?>
          <form action="cart.php" method="post">
            <input type="hidden" name="product_name" value="<?= $value['product_name'] ?>">
            <button type="submit" class="btn btn-outline-secondary">削除する</button>
          </form>
          <?php
          echo "</div>\n";
          echo "</div>";

          $gokei += $value['num'] * $price;
      }
      echo "<div class='h3 mt-4'>合計金額：".number_format($gokei)."円</div>";
      ?>
      <div class="mt-5"><a href="shopping.php" class="btn btn-primary btn-lg">買い物を続ける</a></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </div>
</body>

</html>
