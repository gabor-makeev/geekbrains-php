<?php

// страница просмотра фотографии (для первого задания)
$gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
$requestedImageId = $_GET['imageId'];

if ($gallery_db) {
  // обновление показателя просмотров фотографии
  mysqli_query($gallery_db, "UPDATE images SET view_count = view_count + 1 WHERE id = $requestedImageId;");
  $dbRequestResult = mysqli_query($gallery_db, "SELECT `name`, `url`, view_count FROM images WHERE id = $requestedImageId;");
  $image = mysqli_fetch_assoc($dbRequestResult);
  mysqli_close($gallery_db);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Изображение <?= $requestedImageId ?></title>
</head>

<body>
  <div class="image-preview">
    <a href="index.php" class="image-preview__to-home">На главную</a>
    <img src=<?= $image['url'] ?> alt=<?= 'Name ' . $image['name'] ?> class="image-preview__image">
    <div class="image-preview__info">
      <span class="image-preview__info-name">
        <?= $image['name'] ?>
      </span>
      <span class="image-preview__info-views">
        <!-- число просмотров фотографии для 3-го задания -->
        Количество просмотров: <?= $image['view_count'] ?>
      </span>
    </div>
  </div>
</body>

</html>

<style>
  .image-preview {
    height: 85vh;
    padding: 50px 0;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
  }

  .image-preview__to-home {
    position: absolute;
    top: 20px;
    left: 20px;
  }

  .image-preview__image {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
  }

  .image-preview__info {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>