<?php
// По ходу выполнения 2-го задания, заметил что начал выполнять и 4-е. Оставил комменты там где код для 4-го задания :)

// Задание 1. Я решил поставить XAMPP так как слышал много хорошего о нем. Скриншот с работающим XAMPP-ом находится в корне репозитория.

// Задание 2. Выполнить примеры из методички и разобраться, как это работает.
$first_name = "Gabor";
$last_name = "Makeyev";
$my_age = 24;
$hello = "Привет, XAMPP заработал!</br>Кстати, меня зовут $first_name $last_name и мне $my_age года...";
define('FAVORITE_FOOD', "Pizza");
$precises = [1.5, 1.5e4, 6E-8];
$a = 6;
$b = 3;
// немного кода для 4-го задания:
$h1 = 'Я самый крупный заголовок из всех возможных';
$title = 'GB. Базовый курс PHP';
$currentYear = date('Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title> <!-- КОД от 4-го задания -->
</head>
<body>
  <div class="wrapper">
    <h1><?= $h1 ?></h1><!-- КОД от 4-го задания -->
    <h2>Сейчас на дворе <?= $currentYear ?>!</h2><!-- КОД от 4-го задания -->

    <!-- выполнение примеров из методички - старт -->
    <h1><?= $hello ?></h1>
    <h2>Вот пример использования константы — <?= FAVORITE_FOOD ?></h2>
    <h3>Работа с массивом:</h3>
    <?php foreach ($precises as $precise): ?>
      <p>- <?= $precise ?></p>
    <?php endforeach; ?>
    <h2>Немного математических примеров из методички:</h2>
    <span>a = <?= $a ?>. </span><span>b = <?= $b ?>.</span>
    <p>(Но не всегда)</p>
    <ul>
      <li><?= $a ?> + <?= $b ?> = <?= $a + $b ?></li>
      <li><?= $a ?> * <?= $b ?> = <?= $a * $b ?></li>
      <li><?= $a ?> - <?= $b ?> = <?= $a - $b ?></li>
      <li><?= $a ?> / <?= $b ?> = <?= $a / $b ?></li>
      <li><?= $a + 1 ?> % <?= $b ?> = <?= ($a + 1) % $b ?></li>
      <li><?= $a ?> ** <?= $b ?> = <?= $a ** $b ?></li>
      <li>a *= 2 >>> a = <?= $a *= 2 ?></li>
      <li>a /= 2 >>> a = <?= $a /= 2 ?></li>
      <li>a += 2 >>> a = <?= $a += 2 ?></li>
      <li>a = 2 >>> a = <?= $a = 2 ?></li>
      <li>a++ >>> a = <?= $a++ ?> (в случае вывода переменной с постинкрементом, сначала выводится значение и только потом оно меняется)</li>
      <li>++a >>> a = <?= ++$a ?> (а вот преинкремент сначала делает манипуляцию с переменной и она выводится уже измененной)</li>
      <li>a-- >>> a = <?= $a-- ?></li>
      <li>--a >>> a = <?= --$a ?></li>
    </ul>
    <!-- выполнение примеров из методички - конец -->

    <!-- Задание 3. Объяснить, как работает данный код: -->
    <?php
      $a = 5;
      $b = '05';
      var_dump($a == $b);         // Почему true? — потому что это не строгое сравнение и сравниваются только значения переменных но не их типы. А если привести значение переменной $b к целочисленному типу, например (integer)$b, то при выводе мы увидим просто 5 что равно значению переменной $a
      var_dump((int)'012345');     // Почему 12345? — кажется я частично ответил на этот вопрос в предыдущем примере. В данном случае, '012345' приведется к числовому значению, а так как целые числа больше 0 не могут начинатся с 0, мы увидим 12345
      var_dump((float)123.0 === (int)123.0); // Почему false? — потому что тут происходит строгое сравнение, а это значит что сравниваются также типы сравниваемых значений. Не смотря на то, что при выводе мы увидим 123 в обоих случаях, типы данных значений были обозначены заранее
      var_dump((int)0 === (int)'hello, world'); // Почему true? — потому что результатом приведения строки 'hello, world' к целочисленному значению будет целочисленное значение 0. Если бы в начале строки находились какие-то цифры — результатом приведение строки к целочисленному типу было бы число (Например: (int)'222Something' === (int)222 >>> true).
    ?>

    <!-- Задание 5. *Используя только две переменные, поменяйте их значение местами. Например, если a = 1, b = 2, надо, чтобы получилось b = 1, a = 2. Дополнительные переменные использовать нельзя. -->
    <div>
      <?php 
        $a = 321;
        $b = 123;
      ?>
      <p><?= "a = $a" ?></p>
      <p><?= "b = $b" ?></p>
      <p>Тут происходит смена значений</p>
      <?php 
        $a = $a + $b;
        $b = $a - $b;
        $a = $a - $b;
      ?>
      <p><?= "a = $a" ?></p>
      <p><?= "b = $b" ?></p>
    </div>
  </div>
</body>
</html>

<style>
  body {
    background-color: #444444;
    color: #B1B1B1;
    font-family: Arial;
  }
  .wrapper {
    width: 1000px;
    margin: 0 auto;
    padding: 20px 0;
  }
</style>