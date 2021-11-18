<?php

$gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
$uploadedImage = $_FILES['user_image'];
$allowedFileSize = 5242880;
$errors = [];

function getNewImageProps()
{
  global $uploadedImage;
  $imageNameParse = explode('.', $uploadedImage['name']);
  $imageExt = end($imageNameParse);
  $newImageName = uniqid('', true) . '.' . $imageExt;
  return [
    'name' => $newImageName,
    'localhost_url' => 'http:\/\/localhost/gb/geekbrains-php/images/' . $newImageName,
    'harddrive_url' => __DIR__ . '/images/' . $newImageName,
    'size' => $uploadedImage['size']
  ];
}

function insertImageIntoDB($imageName, $imageUrl, $imageSize)
{
  global $gallery_db;
  $insertQuery = "INSERT INTO images (`name`, `url`, size) VALUES ('$imageName', '$imageUrl', $imageSize);";
  mysqli_query($gallery_db, $insertQuery);
}

if ($gallery_db) {
  if (str_contains($uploadedImage['type'], 'image') and $uploadedImage['size'] <= $allowedFileSize) {
    $newImage = getNewImageProps();
    move_uploaded_file($uploadedImage['tmp_name'], $newImage['harddrive_url']);
    insertImageIntoDB($newImage['name'], $newImage['localhost_url'], $newImage['size']);
    header('Location: index.php');
  } else {
    str_contains($uploadedImage['type'], 'image') ? '' : $errors[] = 'Загружаемый файл должен быть изображением!';
    $uploadedImage['size'] <= $allowedFileSize ? '' : $errors[] = 'Файл должен весить не более 5 МБ!';
    header('Location: index.php?errors=' . implode(';', $errors));
  }
  mysqli_close($gallery_db);
}
