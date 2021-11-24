<?php
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
    $_SESSION['cart'][] = $newCartItem;
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

var_dump($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GB</title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <ul class="header__menu">
        <li class="header__menu-item"><a href="#" class="header__menu-link">Home</a></li>
        <li class="header__menu-item"><a href="#" class="header__menu-link">Account</a></li>
        <li class="header__menu-item"><a href="#" class="header__menu-link">Cart</a></li>
      </ul>
    </header>
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

<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  .wrapper {
    width: 1000px;
    margin: 0 auto;
  }

  .catalog {
    display: flex;
    justify-content: space-between;
    padding: 50px 0;
  }

  .catalog__good-card {
    display: flex;
    flex-direction: column;
    padding: 10px;
    border: 1px solid black;
    border-radius: 15px;
  }

  .catalog__good-title {
    margin: 0 0 10px 0;
  }

  .catalog__good-button {
    cursor: pointer;
  }

  .header {
    padding: 20px 0;
  }

  .header__menu {
    display: flex;
    justify-content: space-evenly;
  }

  .header__menu-item {
    list-style-type: none;
  }

  .header__menu-link {
    text-decoration: none;
    cursor: pointer;
    padding: 10px 30px;
    background-color: grey;
    color: white;
    outline: 1px solid black;
    outline-offset: -1px;
    transition: 0.3s;
  }

  .header__menu-link:hover {
    background-color: white;
    color: black;
    outline: 1px solid grey;
  }

  .header__menu-link:active {
    background-color: grey;
    color: white;
    outline: 1px solid black;
  }
</style>