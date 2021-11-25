<?php

if (!isset($_COOKIE['loggedIn'])) {
  header('location: login.php');
}

require_once './db.php';

session_start();

if ($_POST) {
  $newCartItem = [
    'name' => $_POST['good_name'],
    'id' => $_POST['good_id']
  ];
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  } else {
    $is_in_array = false;
    foreach ($_SESSION['cart'] as $idx => $cartItem) {
      if ($cartItem['id'] === $newCartItem['id']) {
        $is_in_array = !$is_in_array;
        $existingItemIdx = $idx;
      }
    }
    if ($is_in_array) {
      $_SESSION['cart'][$existingItemIdx]['quantity']++;
    } else {
      $newCartItem['quantity'] = 1;
      $_SESSION['cart'][] = $newCartItem;
    }
  }
}

if ($shop_db) {
  $goodsQuery = "SELECT id, name FROM goods WHERE 1;";
  $goodsQueryResult = mysqli_query($shop_db, $goodsQuery);
  if (mysqli_num_rows($goodsQueryResult)) {
    while ($good = mysqli_fetch_assoc($goodsQueryResult)) {
      $goods[] = $good;
    }
  } else {
    echo 'There are no goods available';
  }
}

if (isset($_POST['log_out'])) {
  setcookie('loggedIn', '0', time() - 3600);
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GB</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <?php require_once './components/Header.php' ?>
    <form action="index.php" method="POST" class="log_out">
      <input type="hidden" name="log_out" value="1">
      <input type="submit" value="log out" class="header__menu-item header__menu-link">
    </form>
    <div class="catalog">
      <?php if ($goods) : ?>
        <?php foreach ($goods as $good) : ?>
          <form class="catalog__good-card" action="index.php" method="POST">
            <input type="hidden" name="good_name" value=<?= $good['name'] ?>>
            <input type="hidden" name="good_id" value=<?= $good['id'] ?>>
            <span class="catalog__good-title"><?= $good['name'] ?></span>
            <input type="submit" value="Buy" class="catalog__good-button">
          </form>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>