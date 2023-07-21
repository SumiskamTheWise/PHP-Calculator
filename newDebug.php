<?php
//determines which calculate function to use
function distributor ($input, $brackets, $operators):float {
    if (hasNestedBrackets($input)) {
        $result = calcNestedBrackets($input);
        echo "\n". "Nested";
    } elseif (in_array($brackets, str_split($input))){
        $result = simpleBracketsCalculate($input);
        echo "\n". "SimpleBrackets";
    } elseif ($operators == 1) {
        $result = simpleCalculate($input);
        echo "\n". "Simple";
    } elseif ($operators > 1) {
        $result = multiCalculate($input);
        echo "\n". "Multi";
    }
    return $result;
}
function hasNestedBrackets ($input): bool
{
    $result = false;
    $bracketsCounter = 0;
    $checkInput = str_split($input);
    foreach ($checkInput as $individual) {
        if ($individual == "(") {
            $bracketsCounter++;
            if ($bracketsCounter > 1) {
                $result = true;
            }
        }
        elseif ($individual == ")") {
            $bracketsCounter = $bracketsCounter - 1;
        }
    }
    return $result;
}
function getAmountOfOperators(string $input): int
{
    $noWhiteSpacesInput = str_replace(' ', '', $input);
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
    $inputOperators = str_replace($numbers, "", $noWhiteSpacesInput);
    $arrayOfOperators = str_split($inputOperators);
    $amountOfOperators = count($arrayOfOperators);
    return ($amountOfOperators);
}

// it is a backbone of every calculating function, calculates with multiple operators,
// used in simpleBracketsCalculate & calcNestedBrackets
function calc(array $choppedInput, int $position, string $operator): float
{
    $firstNumber = $choppedInput[$position - 1];
    $secondNumber = $choppedInput[$position + 1];

    return match ($operator) {
        "/" => $firstNumber / $secondNumber,
        "*" => $firstNumber * $secondNumber,
        "+" => $firstNumber + $secondNumber,
        "-" => $firstNumber - $secondNumber,
    };

}
function creatingInputForCalculating($input): array
{
    $whiteSpace = " ";
    $operatorsSpace = [
        " + ",
        " - ",
        " * ",
        " / ",
        "( ",
        " )",
    ];
    $noWhiteSpacesInput = str_replace(' ', '', $input);
    $operators = ["+", "-", "*", "/", "(", ")"];
    $input = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
    return explode($whiteSpace, $input);
}
function multiCalculate($input): float|int
{
    $inputForMultiCalculate = !is_array($input) ? creatingInputForCalculating($input) : $input;
    while (count($inputForMultiCalculate) > 1) {
        switch (true) {
            case $position = array_search("/", $inputForMultiCalculate):
                $result = calc($inputForMultiCalculate, $position, "/");
                break;
            case $position = array_search("*", $inputForMultiCalculate):
                $result = calc($inputForMultiCalculate, $position, "*");
                break;
            case $position = array_search("-", $inputForMultiCalculate):
                $result = calc($inputForMultiCalculate, $position, "-");
                break;
            case $position = array_search("+", $inputForMultiCalculate):
                $result = calc($inputForMultiCalculate, $position, "+");
                break;
        }
        array_splice($inputForMultiCalculate, $position - 1, 3, array($result));
    }
    return $result;
}

//slice 'n dice, used in simpleBracketsCalculate & calcNestedBrackets
function creatingArrayForBracketsCalculators($input, $result, $firstBracket, $secondBracket) : array
{
    $bracketsResult = array($result);
    $beforeBrackets = array_slice($input, 0, $firstBracket);
    $afterBrackets = array_slice($input, $secondBracket + 1);
    return array_merge($beforeBrackets, $bracketsResult, $afterBrackets);
}

// calculates simple brackets
function simpleBracketsCalculate($input): float
{
    $inputForSimpleBrackets = creatingInputForCalculating($input);
    while (in_array("(", $inputForSimpleBrackets)) {

        $firstBracket = array_search("(", $inputForSimpleBrackets);
        $secondBracket = array_search(")", $inputForSimpleBrackets);
        $expressionInBrackets = array_slice($inputForSimpleBrackets, $firstBracket + 1, $secondBracket - $firstBracket - 1);
        $result = multiCalculate($expressionInBrackets);
        $inputForSimpleBrackets = creatingArrayForBracketsCalculators($inputForSimpleBrackets, $result, $firstBracket, $secondBracket);
    }
    return multiCalculate($inputForSimpleBrackets);
}

// calculates nested brackets, simple and multiple also
function calcNestedBrackets($input): float
{
    $inputForNestedBracketsCalculate = creatingInputForCalculating($input);
    again:$bracketKeys = getBracketKeys($inputForNestedBracketsCalculate);
    if ($bracketKeys !== null) {
        foreach ($bracketKeys as $openingKeys => $closingKeys) {
            $firstBracket = $openingKeys;
            $secondBracket = $closingKeys;
            $expressionInBrackets = array_slice($inputForNestedBracketsCalculate, $firstBracket + 1, $secondBracket - $firstBracket - 1);
            $result = multiCalculate($expressionInBrackets);
            $inputForNestedBracketsCalculate = creatingArrayForBracketsCalculators($inputForNestedBracketsCalculate, $result, $firstBracket, $secondBracket);
            goto again;
        }
    }

    return multiCalculate($inputForNestedBracketsCalculate);
}
function getBracketKeys($input): ?array
{
    $stack = [];
    $keys = [];
    for ($i = 0; $i < count($input); $i++) {
        if ($input[$i] === '(') {
            $stack[] = $i;
        } elseif ($input[$i] === ')') {
            if (!empty($stack)) {
                $openingKey = array_pop($stack);
                $keys[$openingKey] = $i;
            } else {
                echo "Nuh uh $i";
                return null;
            }
        }
    }
    return $keys;
}

function validation(string $input): void
{
    $validNumbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, ".", " ");
    $validOperators = array("+", "-", "*", "/", "(", ")");
    $all_characters = array_merge($validNumbers, $validOperators);
    $test_value = $input;
    $user_input = str_split($test_value);
    for ($i = 0; $i < strlen($test_value); $i++) {

        if (!in_array($user_input[$i], $all_characters)) {
            die("Invalid Input, check for spaces and letters");
        }
    }
}

//a+b calculator, can or SHOULD be replaced with multiCalculate
function simpleCalculate($input): float
{
    $result = 0;
    $numbers = array();
    $expression = str_split($input);
    if (in_array("+", $expression)) {
        $numbers = explode("+", $input);
    } elseif (in_array("-", $expression)) {
        $numbers = explode("-", $input);
    } elseif (in_array("*", $expression)) {
        $numbers = explode("*", $input);
    } elseif (in_array("/", $expression)) {
        $numbers = explode("/", $input);
    }

    $number1 = floatval($numbers[0]);
    $number2 = floatval($numbers[1]);

    if (in_array("+", $expression)) {
        $result = $number1 + $number2;
    } elseif (in_array("-", $expression)) {
        $result = $number1 - $number2;
    } elseif (in_array("*", $expression)) {
        $result = $number1 * $number2;
    } elseif (in_array("/", $expression)) {
        $result = $number1 / $number2;
    }
    return ($result);
}