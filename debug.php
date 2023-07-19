<?php
$input = "11-(1*111-(10*10))";
$noWhiteSpacesInput = str_replace(' ', '', $input);
$operators = ["+", "-", "*", "/", "(", ")"];
$whiteSpace = " ";
$bracketsCounter = 0;
$operatorsSpace = [
    " + ",
    " - ",
    " * ",
    " / ",
    " ( ",
    " ) ",
];

//both are needed. First - setting, Second - correcting
$inputForSimpleBrackets = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
$inputForSimpleBrackets = explode($whiteSpace, $inputForSimpleBrackets);
print_r($inputForSimpleBrackets);
//check if the amount of () is valid
foreach ($inputForSimpleBrackets as $individual) {
    if ($individual == "(") {
        $bracketsCounter++;
    } elseif ($individual == ")") {
        $bracketsCounter = $bracketsCounter - 1;
    }
}
if ($bracketsCounter !== 0) {
    echo "\n"."Nuh uh!";
    die();
}
// count till there are no brackets left, Mr.While will assist you
while (in_array("(", $inputForSimpleBrackets)){
$firstBracket = array_search("(", $inputForSimpleBrackets);
$secondBracket = array_search(")", $inputForSimpleBrackets);

//brackets are first to calculate
print_r($expressionInBrackets = array_slice($inputForSimpleBrackets, $secondBracket - 3, $secondBracket - $firstBracket - 3));
if (array_search(")" || "(", $expressionInBrackets)) {
    echo "Hello there!" . "\n";
}
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
    $e = array_splice($expressionInBrackets, $position - 1, 2, $result);
}
$bracketsResult = array($result);

$beforeBracketsPart = array_slice($inputForSimpleBrackets, 0, $firstBracket - 1);
$afterBracketsPart = array_slice($inputForSimpleBrackets, $secondBracket + 2);
$inputForSimpleBrackets = array_merge($beforeBracketsPart, $bracketsResult, $afterBracketsPart);
$finalExpression = $inputForSimpleBrackets;
print_r($finalExpression);
}
// counting everything together
for ($i = 0; $i < count($finalExpression); $i++) {
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
return $result;

function calc(array $choppedInput, int $position, string $operator): float
{
    $firstNumber = $choppedInput[$position - 1];
    $secondNumber = $choppedInput[$position + 1];

    return match ($operator) {
        '/' => $firstNumber / $secondNumber,
        '*' => $firstNumber * $secondNumber,
        '+' => $firstNumber + $secondNumber,
        '-' => $firstNumber - $secondNumber,
    };

}