<?php

// изменил функцию fetchImages() так, чтобы она работала через базу данных
// в данной функции также рализовано 4-е задание
function fetchImages()
{
  global $images;
  $images = [];
  $gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
  if ($gallery_db) {
    $galleryImages = mysqli_query($gallery_db, "SELECT `name`, `url`, id, view_count FROM images WHERE 1 ORDER BY view_count DESC");
    if ($galleryImages) {
      while ($galleryImage = mysqli_fetch_assoc($galleryImages)) {
        $images[] = $galleryImage;
      }
    }
  }
  mysqli_close($gallery_db);
}

if ($_REQUEST) {
  $errors = explode(';', $_REQUEST['errors']);
} else {
  $errors = null;
}

fetchImages();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GB</title>
  <script src='./script.js' defer></script>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <h1>Галерея</h1>
    </header>
    <main class="main">
      <div class="gallery">
        <?php foreach ($images as $image_idx => $image) : ?>
          <a class="gallery__image-container" href=<?= 'image_preview.php?imageId=' . $image['id'] ?>>
            <img src=<?= $image['url'] ?> alt=<?= 'image-' . $image['id'] ?> class="gallery__image">
            <span><?= $image['name'] ?></span>
            <span>Количество просмотров <?= $image['view_count'] ?></span>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="gallery-image-uploader">
        <form action="image_upload.php" method="POST" enctype="multipart/form-data" class="gallery-image-uploader__form">
          <input type="file" name="user_image" required class="gallery-image-uploader__input">
          <input type="submit" value="Загрузить" class="gallery-image-uploader__submit">
        </form>
      </div>
      <?php if ($errors) : ?>
        <div class="error-info">
          <h3>Файл, который вы загрузили не соответствует следующим параметрам:</h3>
          <?php foreach ($errors as $error) : ?>
            <span class="error-info__error-message"><?= $error ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </main>
  </div>
</body>

</html>

<style>
  body {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    background-color: #F6FAFB;
  }

  .wrapper {
    width: 1000px;
    margin: 0 auto;
  }

  .header {
    display: flex;
    justify-content: center;
  }

  .header h1 {
    color: #12255C;
  }

  .gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 25px 25px 0 25px;
    background-color: #718DE1;
    border-radius: 5px;
  }

  .gallery__image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: 0.3s;
    opacity: 0.9;
    text-decoration: none;
    color: black;
    margin-bottom: 20px;
  }

  .gallery__image-container:hover {
    cursor: pointer;
    transform: scale(1.025);
    cursor: pointer;
    opacity: 1;
  }

  .gallery__image {
    width: 200px;
    height: 134px;
    object-fit: cover;
    border-radius: 10px;
    margin: 0 0 10px 0;
  }

  .gallery-image-uploader {
    display: flex;
    justify-content: center;
  }

  .gallery-image-uploader__form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    padding: 20px 0;
  }

  .gallery-image-uploader__input {
    margin-bottom: 10px;
  }

  .gallery__modal-window-img {
    max-width: 70%;
  }

  .gallery__modal-window-close {
    position: absolute;
    right: 20px;
    top: 20px;
    cursor: pointer;
  }

  .error-info {
    display: flex;
    flex-direction: column;
  }

  .error-info__error-message {
    padding: 10px;
  }
</style>