<?php

if ($_POST) {
  $gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
  $image_id = $_POST['image_id'];
  $body = $_POST['comment'];
  if ($gallery_db) {
    $insertQuery = "INSERT INTO comments (image_id, body) VALUES ('$image_id', '$body');";
    mysqli_query($gallery_db, $insertQuery);
    header('Location: image_preview.php?imageId=' . $image_id);
    mysqli_close($gallery_db);
  }
}
