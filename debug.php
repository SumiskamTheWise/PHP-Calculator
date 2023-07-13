<?php
//simple brackets solution
$input = "11-11-11-11+11*3-1*111+(10*10)";
$noWhiteSpacesInput = str_replace(' ', '', $input);
$choppedInput = str_split($noWhiteSpacesInput);
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
$operators = ["+", "-", "*", "/", "(", ")"];
$whiteSpace = " ";
$operatorsSpace = [
    " + ",
    " - ",
    " * ",
    " / ",
    " ( ",
    " ) ",
];
$inputNumbers = str_replace($operators, $whiteSpace, $noWhiteSpacesInput);
$inputOperators = str_replace($numbers, "", $noWhiteSpacesInput);

//both are needed. First - setting, Second - correcting

$inputForMultiCalculate = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
$inputForMultiCalculate = explode($whiteSpace, $inputForMultiCalculate);

$firstBracket = array_search("(", $inputForMultiCalculate);
$secondBracket = array_search(")", $inputForMultiCalculate) + 1;

//first to calculate
$expressionInBrackets = array_slice($inputForMultiCalculate, $firstBracket+1, 3);


//counting part for brackets
for ($i = 0; $i <= count($expressionInBrackets); $i++) {
    $e = $expressionInBrackets;
    switch (true) {
        case $position = array_search("*", $e):
            $result = calc($e, $position, '*');
            break;
        case $position = array_search("/", $e):
            $result = calc($e, $position, '/');
            break;
        case $position = array_search("-", $e):
            $result = calc($e, $position, '-');
            break;
        case $position = array_search("+", $e):
            $result = calc($e, $position, '+');
            break;
    }
}
$bracketsResult = [$result];
print_r($noBracketsPart = array_slice($inputForMultiCalculate, 0, $firstBracket - 1));
print_r($finalExpression = array_merge($noBracketsPart, $bracketsResult));


for ($i = 0; $i < 100; $i++) {
    switch (true) {
        case $position = array_search("*", $finalExpression):
            $result = calc($finalExpression, $position, '*');
            break;
        case $position = array_search("/", $finalExpression):
            $result = calc($finalExpression, $position, '/');
            break;
        case $position = array_search("-", $finalExpression):
            $result = calc($finalExpression, $position, '-');
            break;
        case $position = array_search("+", $finalExpression):
            $result = calc($finalExpression, $position, '+');
            break;
    }
    array_splice($finalExpression, $position - 1, 3, $result);
}
echo $result;
function calc(array $choppedInput, int $position, string $operator): float
{
    $firstNumber = $choppedInput[$position - 1];
    $secondNumber = $choppedInput[$position + 1];

    return match ($operator) {
        '*' => $firstNumber * $secondNumber,
        '/' => $firstNumber / $secondNumber,
        '+' => $firstNumber + $secondNumber,
        '-' => $firstNumber - $secondNumber,
    };

}