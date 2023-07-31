<?php


use classes\AbstractCalculator;

require_once 'classes/AbstractCalculator.php';

require 'newDebug.php';
$tests = [
    "7+5"=> 12,
    "((10*10)+11)-1*111" => 0,
    "11-(1*111-(10*10))" => 0,
    "88.6+11" => 99.6,
    "901-1" => 900,
    "1*1-1/1+1*1+11-11/11+1*12" => 23,
    "5/5/5*125"=> 25,
    "123*3" => 369,
    "696/6" => 116,
//// yes
    "1+3-4/4+6*3+111-121/11+3*777" => 2452,
    "11-1*111+(10*10)" => 0,
    "(10*10)+11-1*111" => 0,
    "5*5*5/125" => 1,
    "5.5/5-1.1+1.1" => 1.1,
//// yes
    "11.5-(1*111)+(10*10)" => 0.5,
    "1+3" => 4,
    "3+4" => 7,
    "(11+111+11)-(1*111*11/11)+(10-10-10+10)-11" => 11,
    "(11+111)-(1*111)+(10*10-111)" => 0,
//// yes
    "11-(1*111-(10*10))+((10*10)+11)" =>111,
//// no-tests to be failed
    "1+7" => 5,
    "3+4+1" => 1,
    "(1*111)+(10*10)" => 0.5,
    "11-(1*111/(10*10))+((10*10)+11)" => 3,
];
foreach ($tests as $input => $expectedResult) {
    validation($input);
}

foreach ($tests as $input => $expectedResult) {
    $calculator = AbstractCalculator::getCalculator($input);
    $result = $calculator->calculate($input);

    if ($result == $expectedResult) {
        echo " Yes" . "\n";
    } else {
        echo " No" . "\n";
    }
}



