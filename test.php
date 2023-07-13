<?php
require 'distributor.php';
$tests = [
    "1+3" => 4,
    "3+4" => 7,
    "7+5"=> 12,
    "88.6+11" => 99.6,
    "901-1" => 900,
    "123*3" => 369,
    "696/6" => 116,
    "1+3-4/4+6*3+111-121/11+3*777" => 2452,
    "1*1-1/1+1*1+11-11/11+1*12" => 23,
    "5/5/5*125"=> 25,
    "5*5*5/125" => 1,
    "11-1*111+(10*10)" => 0,
    "11+(10*10)-1*111" => 0,
    "(10*10)+11-1*111" => 0,

];
foreach ($tests as $input => $expectedResult) {
    validation($input);
}
foreach ($tests as $input => $expectedResult) {
    $operators = splittingTheInput($input);
    $brackets = "(";
    if (in_array($brackets, str_split($input))){
        $result = simpleBracketsCalculate($input);
        echo "\n". "Icy";
    } elseif ($operators == 1) {
        $result = simpleCalculate($input);
        echo "\n". "Sunny";
    }    else {
        $result = multiCalculate($input);
        echo "\n". "Foggy";
    }
    if ($result == $expectedResult) {
        echo "Yes" . "\n";
    } else {
        echo "No" . "\n";
    }
}



