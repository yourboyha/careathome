<?php
$file = "src/view/counter.txt";
$current_count = file_get_contents($file);
$current_count = intval($current_count);
$current_count++;
file_put_contents($file, $current_count);
echo $current_count;
