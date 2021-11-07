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

echo "<h3>Задание 1.</h3>" . "<span>a = $a, b = $b</span></br>";

if($a >= 0 and $b >= 0) {
  echo $a != $b ? abs($a - $b) : 'Числа равны';
} else if($a < 0 and $b < 0) {
  echo $a * $b;
} else {
  echo $a + $b;
};

/* 
  Задание 2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.
*/

/* 
  Мне кажется, что самым рациональным методом решения данной задачи является использование switch БЕЗ break,
  так как ее описание так и намекает на эту особенность оператора switch. Также я вспомнил что подобное задание было на первом
  курсе по JavaScript и там ПРАВИЛЬНЫМ решением являлось именно использование switch ВМЕСТЕ С break.

  Но так как вы указали, что данное задание должно быть выполненым без использования break,
  Я пришел к двум инным вариантам решения данной задачи.
*/

$a = rand(0, 15);

echo "<h3>Задание 2.</h3>" . "<span>a = $a</span></br>";

switch ($a) {
  case 0:
    echo "0 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15"; // Первый и самый простой вариант решения
    break;
  case 1:
    for($a; $a <= 15; $a++) { // Второй и более логичный вариант решения как по мне (также можно создать функцию, чтобы не копировать данный код для каждого case)
      echo $a . " ";
    };
    break;
  case 2:
    echo "2 3 4 5 6 7 8 9 10 11 12 13 14 15";
    break;
  case 3:
    echo "3 4 5 6 7 8 9 10 11 12 13 14 15";
    break;
  case 4:
    echo "4 5 6 7 8 9 10 11 12 13 14 15";
    break;
  case 5:
    echo "5 6 7 8 9 10 11 12 13 14 15";
    break;
  case 6:
    echo "6 7 8 9 10 11 12 13 14 15";
    break;
  case 7:
    echo "7 8 9 10 11 12 13 14 15";
    break;
  case 8:
    echo "8 9 10 11 12 13 14 15";
    break;
  case 9:
    echo "9 10 11 12 13 14 15";
    break;
  case 10:
    echo "10 11 12 13 14 15";
    break;
  case 11:
    echo "11 12 13 14 15";
    break;
  case 12:
    echo "12 13 14 15";
    break;
  case 13:
    echo "13 14 15";
    break;
  case 14:
    echo "14 15";
    break;
  case 15:
    echo "15";
    break;
};

/* 
  Задание 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
*/

function addNumbers($firstNumber, $secondNumber) {
  return $firstNumber + $secondNumber;
};

function subtractNumbers($firstNumber, $secondNumber) {
  return $firstNumber - $secondNumber;
};

function multiplyNumbers($firstNumber, $secondNumber) {
  return $firstNumber * $secondNumber;
};

function divideNumbers($firstNumber, $secondNumber) {
  return $firstNumber / $secondNumber;
};

/* 
  Задание 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов,
  $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций 
  (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).
*/

function mathOperation($arg1, $arg2, $operation) {
  switch ($operation) {
    case "add":
      return addNumbers($arg1, $arg2);
    case "subtract":
      return subtractNumbers($arg1, $arg2);
    case "multiply":
      return multiplyNumbers($arg1, $arg2);
    case "divide":
      return divideNumbers($arg1, $arg2);
  };
};

echo "<h3>Задание 3-4. (Пример работы функций)</h3>";
// числа для примера работы функции
$a = rand(1, 10);
$b = rand(1, 10);
echo "<p>Допустим первый аргумент = $a, а второй = $b</p><p>Результат:</p>";
echo "$a + $b = " . mathOperation($a, $b, "add") . "</br>";
echo "$a - $b = " . mathOperation($a, $b, "subtract") . "</br>";
echo "$a * $b = " . mathOperation($a, $b, "multiply") . "</br>";
echo "$a / $b = " . mathOperation($a, $b, "divide") . "</br>";

// Решение 5-го задания находится в теле HTML-кода

/* 
  Задание 6. *С помощью рекурсии организовать функцию возведения числа в степень. 
  Формат: function power($val, $pow), 
  где $val – заданное число, $pow – степень.
*/

// [add script here]

/*
  Задание 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
  22 часа 15 минут
  21 час 43 минуты
*/

// [add script here]

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
  <!-- 
    Задание 5. Посмотреть на встроенные функции PHP. 
    Используя имеющийся HTML-шаблон, 
    вывести текущий год в подвале при помощи встроенных функций PHP. 
  -->
  <footer class="footer">Задание 5 ==> <?= date('Y') ?></footer>
</body>
</html>

<style>
  body {
    position: relative;
    padding-bottom: 20vh;
    background-color: #B9B7BD;
  }
  .footer {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    bottom: 0;
    height: 20vh;
    width: 100%;
    background-color: #868B8E;
    color: #EEEDE7;
  }
</style>
