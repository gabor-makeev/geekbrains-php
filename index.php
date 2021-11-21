<?php
$result = null;

function addition($firstNum, $secondNum)
{
  return $firstNum + $secondNum;
}

function subtraction($firstNum, $secondNum)
{
  return $firstNum - $secondNum;
}

function multiplication($firstNum, $secondNum)
{
  return $firstNum * $secondNum;
}

function division($firstNum, $secondNum)
{
  if ($secondNum == 0) {
    return "В данном примере ($firstNum / $secondNum) производится деление на ноль!<br>" . 'Деление на ноль приводит к неопределенному результату или же к значению близкому к беcконечности';
  } else {
    return $firstNum / $secondNum;
  }
}

function calculate($firstNum, $secondNum, $operation)
{
  switch ($operation) {
    case 'addition':
      return addition($firstNum, $secondNum);
    case 'subtraction':
      return subtraction($firstNum, $secondNum);
    case 'multiplication':
      return multiplication($firstNum, $secondNum);
    case 'division':
      return division($firstNum, $secondNum);
  }
}

if ($_POST) {
  $result = calculate($_POST['num_1'], $_POST['num_2'], $_POST['operation']);
}
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
  <form method="POST" class="form">
    <label for="num_1">First number:
      <input type="number" name="num_1" required>
    </label><br>
    <label for="num_2">Second number:
      <input type="number" name="num_2" required>
    </label><br>
    <label for="operation">Operation:
      <select name="operation">
        <option value="0" selected>Выберите операцию</option>
        <option value="addition">Сложение</option>
        <option value="subtraction">Вычитание</option>
        <option value="multiplication">Умножение</option>
        <option value="division">Деление</option>
      </select>
    </label><br>
    <input type="submit">
  </form>
  <?php if ($result or $result == 0) : ?>
    <p>Result: <?= $result ?></p>
  <?php endif; ?>
</body>

</html>