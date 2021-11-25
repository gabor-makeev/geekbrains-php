<?php
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $_POST['password'])) {
  require_once 'db.php';
  if ($shop_db) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "', '" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $password . "');";
    mysqli_query($shop_db, $query);
    $registrationStatus = "Your account was created!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <div class="registration">
      <a href="login.php" class="header__menu-item header__menu-link registration__login-link">Login</a>
      <h1 class="registration__title">Register your account</h1>
      <form action="registration.php" method="POST" class="registration__form">
        <label>First name: <input type="text" name="first_name" required></label>
        <label>Last name: <input type="text" name="last_name" required></label>
        <label>Username: <input type="text" name="username" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <input type="submit" value="Create account">
      </form>
      <?php if (isset($registrationStatus)) : ?>
        <h2><?= $registrationStatus ?></h2>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>