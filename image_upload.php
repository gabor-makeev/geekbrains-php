<?php 

$uploadedImage = $_FILES['user_image'];
$parsedUploadedImageName = explode('.', $uploadedImage['name']);
$tmpImageDir = $uploadedImage['tmp_name'];
$allowedFileSize = 5242880;
$errors = [];

if (str_contains($uploadedImage['type'], 'image') and $uploadedImage['size'] <= $allowedFileSize) {
  $imageExt = end($parsedUploadedImageName);
  $newImageName = uniqid('', true) . '.' . $imageExt;
  $imageDir = __DIR__ . '/images/';
  move_uploaded_file($tmpImageDir, $imageDir . $newImageName);
  header('Location: index.php');
} else {
  str_contains($uploadedImage['type'], 'image') ? '' : $errors[] = 'Загружаемый файл должен быть изображением!';
  $uploadedImage['size'] <= $allowedFileSize ? '' : $errors[] = 'Файл должен весить не более 5 МБ!';
  header('Location: index.php?errors=' . implode(';', $errors));
}