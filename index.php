<?php
$catalog_db = mysqli_connect('localhost', 'root', '', 'catalog');

if ($catalog_db) {
  $selectGoods = mysqli_query($catalog_db, 'SELECT name, description, image_id, price FROM goods WHERE 1;');
  $selectImages = mysqli_query($catalog_db, 'SELECT id, url FROM images WHERE 1;');
  if ($selectGoods) {
    $goods = [];
    while ($row = mysqli_fetch_assoc($selectGoods)) {
      $goods[] = $row;
    }
    while ($image = mysqli_fetch_assoc($selectImages)) {
      foreach ($goods as &$good) {
        if ($good['image_id'] === $image['id']) {
          $good['image_url'] = $image['url'];
        }
      }
    }
  } else {
    $goods = null;
  }
  mysqli_close($catalog_db);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GB</title>
  <script src="./script.js" defer></script>
</head>

<body>
  <div class="wrapper">
    <div class="catalog">
      <?php foreach ($goods as $good) : ?>
        <div class="catalog__item" data-image-src=<?= $good['image_url'] ?> data-good-name=<?= $good['name'] ?> data-good-price=<?= $good['price'] ?> data-good-description='<?= $good['description'] ?>'>
          <img src=<?= $good['image_url'] ?> alt=<?= $good['name'] ?>>
          <span><?= $good['name'] ?></span>
          <span><?= $good['price'] ?></span>
        </div>
      <?php endforeach; ?>
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
    width: 1100px;
    margin: 0 auto;
  }

  .catalog {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
  }

  .catalog__item {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 400px;
    margin: 20px;
    outline: 1px solid black;
    border-radius: 15px;
  }

  .catalog__item:hover {
    cursor: pointer;
  }

  .catalog__item img {
    max-width: 80%;
  }

  .catalog__modal {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: RGB(112, 112, 112, 0.5);
  }

  .catalog__modal-close {
    position: absolute;
    top: 50px;
    right: 50px
  }
</style>