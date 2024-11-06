<?php

$lines = [];
$T = 0;

while (($line = fgets(STDIN)) !== false) {
  $lines[] = trim($line);
}

array_pop($lines); // Remove last empty line

foreach ($lines as $line) {
  $N = (int) $line;

  if ($T > 0) {
    echo PHP_EOL; // Print empty line for separation
  }

  $consumos = array_fill(0, 201, 0);
  $totalX = $totalY = 0;

  for ($i = 0; $i < $N; $i++) {
    $arr = explode(' ', fgets(STDIN));
    $X = (int) $arr[0];
    $Y = (int) $arr[1];

    $totalX += $X;
    $totalY += $Y;
    $consumos[floor($Y / $X)] += $X;
  }

  echo "Cidade#" . ($T + 1) . ":" . PHP_EOL;

  $output = [];
  foreach ($consumos as $i => $val) {
    if ($val > 0) {
      $output[] = "$val-$i";
    }
  }

  echo implode(' ', $output) . PHP_EOL;

  $consumo_total = round(100 * $totalY / $totalX, 2);
  echo "Consumo medio: $consumo_total m3." . PHP_EOL;

  $T++;
}

?>