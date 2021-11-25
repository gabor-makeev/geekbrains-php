<?php

if (isset($_POST['username'], $_POST['password'])) {
  require_once 'db.php';
  if ($shop_db) {
    $query = "SELECT username, password FROM users WHERE username ='" . $_POST['username'] . "';";
    $query = mysqli_query($shop_db, $query);
    $queryResult = mysqli_fetch_assoc($query);
    if (password_verify($_POST['password'], $queryResult['password'])) {
      setcookie('loggedIn', '1');
      setcookie('user', $queryResult['username']);
      header('location: account.php');
      die;
    } else {
      $loginStatus = 'Failed to log in. Either your username or password is not correct.';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <div class="login">
      <a href="registration.php" class="header__menu-item header__menu-link login__registration-link">Register</a>
      <h1 class="login__title">Log in to your account</h1>
      <form action="login.php" method="POST" class="login__form">
        <label>Username: <input type="text" name="username" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <input type="submit" value="Log in">
      </form>
      <?php if (isset($loginStatus)) : ?>
        <h2><?= $loginStatus ?></h2>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>