<?php
class Calculator {

  public array $arr;

  public function sumEvenNumbers($arr) {
    try {
      $sum = 0;
      foreach ($arr as $value) {
        if ($value % 2 == 0) {
          $sum += $value;
        }
      }
      return $sum;
    } catch (Exception $e) {
      echo "An error occurred: " . $e->getMessage();
      return null;
    }
  }
}

$c = new Calculator();
$result = $c->sumEvenNumbers([1, 2, 3, 4, 5, 6, 7, 8, 9]);

if ($result !== null) {
  echo "Sum of even numbers: " . $result;
  echo "<br>";
}
?>
