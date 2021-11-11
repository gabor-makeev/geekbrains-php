<?php

/*
  Задание 1. С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.
*/

echo '<h3>Задание 1.</h3>';

$i = 0;

while ($i <= 100) {
  if ($i % 3 === 0) {
    echo $i . '<br>';
  }
  $i++;
}

/*
  Задание 2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так:
  0 – ноль.
  1 – нечетное число.
  2 – четное число.
  3 – нечетное число.
  …
  10 – четное число.
*/

echo '<h3>Задание 2.</h3>';

$j = 0;

do {
  if ($j === 0) {
    echo $j . ' - ' . 'ноль.' . '<br>';
  } else if ($j % 2 === 0) {
    echo $j . ' - ' . 'четное число' . '<br>'; 
  } else {
    echo $j . ' - ' . 'нечетное число' . '<br>';
  }
  $j++;
} while ($j <= 10);

/*
  Задание 3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким:
  Московская область:
  Москва, Зеленоград, Клин
  Ленинградская область:
  Санкт-Петербург, Всеволожск, Павловск, Кронштадт
  Рязанская область … (названия городов можно найти на maps.yandex.ru)
*/

echo '<h3>Задание 3.</h3>';

$provinces = [
  'Московская область' => [
    'Москва',
    'Зеленоград',
    'Клин'
  ],
  'Ленинградская область' => [
    'Санкт-Петербург',
    'Всеволожск',
    'Павловск',
    'Кронштадт'
  ],
  'Рязанская область' => [
    'Рязань',
    'Рыбное',
    'Ряжск',
    'Михайлов',
    'Кораблино'
  ]
];

foreach ($provinces as $province => $value) {
  echo "<h4>$province:</h4>";
  foreach ($value as $idx => $city) {
    echo "<span>$city</span>";
    echo $idx !== (count($value) - 1) ? ', ' : '';
  }
}

/*
  Задание 4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
*/

echo '<h3>Задание 4.</h3>';

$myName = 'Габор';

echo "<p>Меня зовут $myName, а транслитерация моего имени будет выглядеть следующим образом:</p>";

$letters = [
  'а' => 'a',
  'б' => 'b',
  'в' => 'v',
  'г' => 'g',
  'д' => 'd',
  'е' => 'ye',
  'ё' => 'e',
  'ж' => 'zh',
  'з' => 'z',
  'и' => 'i',
  'й' => 'y',
  'к' => 'k',
  'л' => 'l',
  'м' => 'm',
  'н' => 'n',
  'о' => 'o',
  'п' => 'p',
  'р' => 'r',
  'с' => 's',
  'т' => 't',
  'у' => 'u',
  'ф' => 'f',
  'х' => 'kh',
  'ц' => 'ts',
  'ч' => 'ch',
  'ш' => 'sh',
  'щ' => 'shch',
  'ъ' => '',
  'ы' => 'y',
  'ь' => '',
  'э' => 'e',
  'ю' => 'iu',
  'я' => 'ia'
];

function translit($text) {
  global $letters;
  $word = mb_strtolower($text); 
  for ($idx = 0; $idx < mb_strlen($word); $idx++) {
    foreach($letters as $cyrLetter => $latLetter){
      if (mb_substr($word, $idx, 1) === $cyrLetter) {
        echo $latLetter;
      } else if (mb_substr($word, $idx, 1) === $latLetter) {
        echo $cyrLetter;
      }
    }
    if (mb_substr($word, $idx, 1) === ' ') {
      echo ' ';
    }
  }
}

echo translit($myName);

/*
  Задание 5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.
*/

echo '<h3>Задание 5.</h3>';

echo '<p>Допустим изменяем следующую строку: "Привет, как дела?"</p><p>Результат:</p>';

function spaceToUnderscore($text) {
  $changedText = '';
  for($idx = 0; $idx < mb_strlen($text); $idx++) {
    if(mb_substr($text, $idx, 1) === ' ') {
      $changedText .= '_';
    } else {
      $changedText .= mb_substr($text, $idx, 1);
    }
  }
  return $changedText;
}

echo spaceToUnderscore('Привет, как дела?');

/*
  Задание 6. В имеющемся шаблоне сайта заменить статичное меню (ul – li) на генерируемое через PHP. Необходимо представить пункты меню как элементы массива и вывести их циклом. Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.
*/

echo '<h3>Задание 6.</h3>';

// Массив с элементами меню и подменю
$menu = [
  'Home',
  'Catalog' => [
    'PCs',
    'Laptops',
    'Gaming consoles'
  ],
  'Locations' => [
    'London',
    'New York',
    'Paris'
  ]
];

// мне в голову пришло два варианта
// первый реализовал с помощью функции renderMenu,
// которая находится ниже
function renderMenu($menuContent) {
  echo '<ul>';
  foreach($menuContent as $menuTitle => $menuContent) {
    echo "<li>" . ($menuTitle ? $menuTitle : $menuContent) . "</li>";
    if (is_array($menuContent)) {
      echo '<ul>';
      foreach($menuContent as $submenu) {
        echo "<li>$submenu</li>";
      }
      echo '</ul>';
    }
  }
  echo '</ul>';
}

renderMenu($menu);

// второй вариант решения данной задачи находится в самом hmtl-блоке ниже

/*
  Задание 7. *Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:
  for (…){ // здесь пусто}
*/

echo '<h3>Задание 7.</h3>';

for($i = 0; $i <=9; print $i++);

/*
  Задание 8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
*/

echo '<h3>Задание 8.</h3>';

foreach ($provinces as $province => $value) {
  foreach ($value as $idx => $city) {
    if (mb_substr($city, 0, 1) === 'К') {
      echo "<span>$city </span>";
    }
  }
}

/*
  Задание 9. *Объединить две ранее написанные функции в одну, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).
*/

echo '<h3>Задание 9.</h3>';

echo '<p>Допустим мы изменяем строку `лучший рецепт пиццы`</p><p>Результат:</p>';

function translitWithUnderscore($text) {
  global $letters;
  $word = mb_strtolower($text); 
  for ($idx = 0; $idx < mb_strlen($word); $idx++) {
    foreach($letters as $cyrLetter => $latLetter){
      if (mb_substr($word, $idx, 1) === $cyrLetter) {
        echo $latLetter;
      } else if (mb_substr($word, $idx, 1) === $latLetter) {
        echo $cyrLetter;
      }
    }
    if (mb_substr($word, $idx, 1) === ' ') {
      echo '_';
    }
  }
}

echo translitWithUnderscore('лучший рецепт пиццы');
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
  <h3>Задание 6.</h3>
  <ul>
  <?php foreach($menu as $menuItemTitle => $menuItemContent): ?>
    <li>
      <?= $menuItemTitle ? $menuItemTitle : $menuItemContent ?>
      <?php if(is_array($menuItemContent)): ?>
        <ul>
        <?php foreach($menuItemContent as $submenu): ?>
          <li><?= $submenu ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
  </ul>
</body>
</html>