<?php

// страница просмотра фотографии (для первого задания)
$gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
$requestedImageId = $_GET['imageId'];
$comments = null;

if ($gallery_db) {
  // обновление показателя просмотров фотографии
  mysqli_query($gallery_db, "UPDATE images SET view_count = view_count + 1 WHERE id = $requestedImageId;");
  $dbRequestResult = mysqli_query($gallery_db, "SELECT `name`, `url`, view_count FROM images WHERE id = $requestedImageId;");
  $image = mysqli_fetch_assoc($dbRequestResult);
  $dbCommentsRequestResult = mysqli_query($gallery_db, "SELECT body FROM comments WHERE image_id = $requestedImageId;");
  while ($comment = mysqli_fetch_assoc($dbCommentsRequestResult)) {
    $comments[] = $comment;
  }
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
    <form action="image_comment.php" method="POST" class="image-preview__comment">
      <label for="comment">Оставьте отзыв:</label>
      <textarea name="comment" id="comment" cols="30" rows="5" required></textarea>
      <input type="hidden" name="image_id" value=<?= $requestedImageId ?>>
      <input type="submit" value="Отправить">
    </form>
    <div class="image-preview__comments">
      <?php if ($comments) : ?>
        <h2>Комментарии:</h2>
        <?php foreach ($comments as $comment) : ?>
          <p>-<?= $comment['body'] ?>-</p>
        <?php endforeach; ?>
      <?php else : ?>
        <h2>У этого изображения пока что нет комментариев...</h2>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>

<style>
  .image-preview {
    min-height: 85vh;
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

  .image-preview__comment {
    display: flex;
    flex-direction: column;
  }
</style>