<?php

if (!isset($_COOKIE['loggedIn'])) {
  header('location: login.php');
}

require_once 'db.php';

if ($shop_db) {
  $query = "SELECT firstname, lastname, username FROM users WHERE username ='" . $_COOKIE['user'] . "';";
  $query = mysqli_query($shop_db, $query);
  $user = mysqli_fetch_assoc($query);
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
  <title>Account</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <?php require_once './components/Header.php' ?>
    <form action="index.php" method="POST" class="log_out">
      <input type="hidden" name="log_out" value="1">
      <input type="submit" value="log out" class="header__menu-item header__menu-link">
    </form>
    <h1><?= $user['firstname'] . ' ' . $user['lastname'] . ' (' . $user['username'] . ')' ?>, welcome to your account's page!</h1>
  </div>
</body>

</html>