<?php

$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
$result = NULL;

foreach ($x as $value) {
    $result = [$value => $result];
}
$x = $result;
unset($result);
print_r($x);
