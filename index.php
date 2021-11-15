<?php

/* 
  Функция fetchImages() отвечает за сканирование директории с изображениями
  и создание массива состоящего из адресов ведущих к изображениям
*/
function fetchImages() {
  global $images;
  $images = [];
  foreach(scandir('images') as $file) {
    if (!is_dir($file) and $file !== '.gitkeep') {
      array_push($images, "images/$file");
    }
  }
}

/* 
  Тут я проверяю вернул ли image_upload.php (файл, в котором происходит обработка 
  загрузки нового файла) сообщение об ошибке. В случае если ошибки имеются
  создаю массив с сообщениями ошибок
*/
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
      <!-- Вывод всех изображений из массива images -->
      <?php foreach($images as $image_idx => $image_url): ?>
        <!-- 
          В теге img отсутствует target="blank", так как я реализовал модальное окно из третьего задания
        -->
        <img src=<?= $image_url ?> alt=<?= 'image-' . $image_idx ?> class="gallery__image">
      <?php endforeach; ?>
      </div>
      <div class="gallery-image-uploader">
        <!-- В теге form, в атрибуте action, указан файл, обрабатывающий загрузку изображений -->
        <form action="image_upload.php" method="POST" enctype="multipart/form-data" class="gallery-image-uploader__form">
          <input type="file" name="user_image" required class="gallery-image-uploader__input">
          <input type="submit" value="Загрузить" class="gallery-image-uploader__submit">
        </form>
      </div>
      <!-- 
        Тут у меня в случае наличия ошибок после загрузки файла,
        генерируется блок выводящий сообщения о причине ошибки
      -->
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

<!-- Дальше идут просто стили моей Галереи -->
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

  .gallery__image {
    width: 200px;
    height: 134px;
    margin-bottom: 20px;
    object-fit: cover;
    transition: 0.3s;
    border-radius: 10px;
    opacity: 0.9;
  }

  .gallery__image:hover {
    transform: scale(1.025);
    cursor: pointer;
    opacity: 1;
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

  .gallery__modal-window {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: RGB(113, 141, 225, 0.9);
    padding: 50px;
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