<?php
$rows = 5;
$count = 0;

for ($i = 15; $i >= 1; $i--) {
    echo $i . " ";
    $count++;

    if ($count == $rows) {
        echo "\n";
        $count = 0;
        $rows--;
    }
}
