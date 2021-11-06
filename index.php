<?php
/* 
  Задание 1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:
  если $a и $b положительные, вывести их разность;
  если $а и $b отрицательные, вывести их произведение;
  если $а и $b разных знаков, вывести их сумму;
*/

$randMinEdge = -100;
$randMaxEdge = 100;
$a = rand($randMinEdge, $randMaxEdge);
$b = rand($randMinEdge, $randMaxEdge);

echo "<span>a = $a, b = $b</span></br>";

if($a >= 0 and $b >= 0) {
  echo $a != $b ? abs($a - $b) : 'Числа равны';
} else if($a < 0 and $b < 0) {
  echo $a * $b;
} else {
  echo $a + $b;
};
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
  
</body>
</html>