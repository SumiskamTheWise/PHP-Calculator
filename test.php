<?php

use classes\SimpleCalculator;

require 'newDebug.php';
$tests = [
    "1+3" => 4,
    "3+4" => 7,
    "7+5"=> 12,
    "88.6+11" => 99.6,
    "901-1" => 900,
    "123*3" => 369,
    "696/6" => 116,
//// yes
    "1+3-4/4+6*3+111-121/11+3*777" => 2452,
    "1*1-1/1+1*1+11-11/11+1*12" => 23,
    "5/5/5*125"=> 25,
    "5*5*5/125" => 1,
    "5.5/5-1.1+1.1" => 1.1,
//// yes
    "11.5-(1*111)+(10*10)" => 0.5,
    "11-1*111+(10*10)" => 0,
    "(10*10)+11-1*111" => 0,
    "(11+111+11)-(1*111*11/11)+(10-10-10+10)-11" => 11,
    "(11+111)-(1*111)+(10*10-111)" => 0,
//// yes
    "((10*10)+11)-1*111" => 0,
    "11-(1*111-(10*10))" => 0,
    "11-(1*111-(10*10))+((10*10)+11)" =>111,
//// no tests
    "((10*10)+11)+1*111" => 1,
    "11-(1*111*(10*10))" => 2,
    "11-(1*111/(10*10))+((10*10)+11)" =>3,
];
foreach ($tests as $input => $expectedResult) {
    validation($input);
}
$calculator = \classes\AbstractCalculator::getCalculator($input);
foreach ($tests as $input => $expectedResult) {
    $result = $calculator->calculate($input);

    if ($result == $expectedResult) {
        echo " Yes" . "\n";
    } else {
        echo " No" . "\n";
    }
}



