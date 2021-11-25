<?php
session_start();

if (isset($_SESSION['cart'])) {
  $cartItems = $_SESSION['cart'];
}

if ($_POST) {
  foreach ($_SESSION['cart'] as $idx => $cartItem) {
    if ($cartItem['id'] == $_POST['good_id']) {
      if ($cartItem['quantity'] > 1) {
        $_SESSION['cart'][$idx]['quantity']--;
        header('location: cart.php');
      } else {
        array_splice($_SESSION['cart'], $idx, 1);
        header('location: cart.php');
      }
    }
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
  <title>Cart</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <?php require_once './components/Header.php' ?>
    <form action="cart.php" method="POST" class="log_out">
      <input type="hidden" name="log_out" value="1">
      <input type="submit" value="log out" class="header__menu-item header__menu-link">
    </form>
    <h2 class="cart__title">Shopping Cart</h2>
    <div class="cart">
      <?php if (isset($cartItems)) : ?>
        <?php foreach ($cartItems as $cartItem) : ?>
          <form action="cart.php" method="POST" class="cart__item-card">
            <input type="hidden" name="good_id" value=<?= $cartItem['id'] ?>>
            <input type="submit" value="X" class="cart__item-cross">
            <span class="cart__item-title"><?= $cartItem['name'] ?></span>
            <span class="cart__item-quantity">Quantity: <?= $cartItem['quantity'] ?></span>
          </form>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>