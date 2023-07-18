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
    "11-(1*111)+(10*10)",
    "11-1*111+(10*10)",
    "(10*10)+11-1*111",
    "(11+111)-(1*111)+(10-10)",
    "(11+111)-(1*111)+(10*10-111)",
//    "((10*10)+11)-1*111",
//    "11-(1*111+(10*10))",

];
foreach ($tests as $input => $expectedResult) {
    validation($input);
}
foreach ($tests as $input => $expectedResult) {
//    $expectedResult = eval($input);
//    $operators = splittingTheInput($input);
//    $brackets = "(";
//    if (hasNestedBrackets($input)) {
//        $result = calcNestedBrackets($input);
//        echo "\n". "NestedBrackets";
//    }
//    elseif (in_array($brackets, str_split($input))){
        echo $result = simpleBracketsCalculate($input);
        echo "\n". "SimpleBrackets";
//    } elseif ($operators == 1) {
//        $result = simpleCalculate($input);
//        echo "\n". "Simple";
//    } elseif ($operators > 1) {
//        $result = multiCalculate($input);
//        echo "\n". "Multi";
//    }

    if ($result == $expectedResult) {
        echo "Yes" . "\n";
    } else {
        echo "No" . "\n";
    }
}



