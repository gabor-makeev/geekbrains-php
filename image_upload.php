<?php 

// $uploadedImage - файл, который пользователь загрузил и отправил
$uploadedImage = $_FILES['user_image'];
/* 
  $parsedUploadedImageName - распарсенное имя файла. 
  Мне было необходимо для создания уникального мени для файл,
  чтобы была возможность загрузить несколько одинаковых файлов
*/
$parsedUploadedImageName = explode('.', $uploadedImage['name']);
$tmpImageDir = $uploadedImage['tmp_name'];
// $allowedFileSize - максимальный разрешенный для загрузки размер файла 
$allowedFileSize = 5242880;
// $errors - массив собирающий ошибки после обработки файла
$errors = [];

if (str_contains($uploadedImage['type'], 'image') and $uploadedImage['size'] <= $allowedFileSize) {
  $imageExt = end($parsedUploadedImageName);
  $newImageName = uniqid('', true) . '.' . $imageExt;
  // $imageDir - адрес конечной директории для хранения изображений
  $imageDir = __DIR__ . '/images/';
  move_uploaded_file($tmpImageDir, $imageDir . $newImageName);
  header('Location: index.php');
} else {
  /*
    В случае несоответствия условиям для загрузки файла, пользователь возвращается
    на index.php вместе с информацией о проблемах возникших при загрузке
  */
  str_contains($uploadedImage['type'], 'image') ? '' : $errors[] = 'Загружаемый файл должен быть изображением!';
  $uploadedImage['size'] <= $allowedFileSize ? '' : $errors[] = 'Файл должен весить не более 5 МБ!';
  header('Location: index.php?errors=' . implode(';', $errors));
}