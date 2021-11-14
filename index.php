<?php

function fetchImages() {
  global $images;
  $images = [];
  foreach(scandir('images') as $file) {
    !is_dir($file) ? array_push($images, "images/$file") : 'This is a dir';
  }
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
</head>
<body>
  <div class="wrapper">
    <header class="header">
      <h1>My images</h1>
    </header>
    <main class="main">
      <div class="gallery">
      <?php foreach($images as $image_url): ?>
        <a href=<?= $image_url ?> target="blank" class ="gallery__image-container"><img src=<?= $image_url ?> alt="" class="gallery__image"></a>
      <?php endforeach; ?>
      </div>
      <div class="gallery-image-uploader">
        <form action="image_upload.php" method="POST" enctype="multipart/form-data" class="gallery-image-uploader__form">
          <input type="file" name="user_image" class="gallery-image-uploader__input">
          <input type="submit" value="Загрузить" class="gallery-image-uploader__submit">
        </form>
      </div>
      <?php if($errors): ?>
      <div class="error-info">
        <h3>Файл, который вы загрузили не соответствует следующим параметрам:</h3>
        <?php foreach($errors as $error): ?>
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
    color: #252B31;
  }

  .gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 25px 25px 0 25px;
    background-color: #C1C8C7;
  }

  .gallery__image-container {
    transition: 0.3s;
  }

  .gallery__image-container:hover {
    transform: scale(1.025);
  }

  .gallery__image {
    width: 200px;
    height: 134px;
    margin-bottom: 20px;
    object-fit: cover;
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

  .error-info {
    display: flex;
    flex-direction: column;
  }

  .error-info__error-message {
    padding: 10px;
  }
</style>