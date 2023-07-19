<?php
//basic sub-functions
function hasNestedBrackets ($input): bool {
    $result = false;
    $bracketsCounter = 0;
    $checkInput = str_split($input);
    foreach ($checkInput as $individual) {
        if ($individual == "(") {
            $bracketsCounter++;
        }
        elseif ($bracketsCounter > 1) {
            $result = true;
        }
        elseif ($individual == ")") {
            $bracketsCounter = $bracketsCounter - 1;
        }

    }
    return $result;
}
// is used in multiple calculating
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
// is used in calcNestedBrackets
function getBracketKeys($input)
{
    $stack = [];
    $keys = [];
    for ($i = 0; $i < count($input); $i++) {
        if ($input[$i] === '(') {
            array_push($stack, $i);
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
//works
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

//works
function splittingTheInput(string $input): int
{
    $noWhiteSpacesInput = str_replace(' ', '', $input);
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
    $operators = ["+", "-", "*", "/", "(", ")"];
    $whiteSpace = " ";
    $inputNumbers = str_replace($operators, $whiteSpace, $noWhiteSpacesInput);
    $inputOperators = str_replace($numbers, "", $noWhiteSpacesInput);
    $arrayOfNumbers = explode($whiteSpace, $inputNumbers);
    $arrayOfOperators = str_split($inputOperators);
    $amountOfOperators = count($arrayOfOperators);
    return ($amountOfOperators);
}

//works
function simpleCalculate($input): float
{ //change to switch
    $result = 0;
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

//works
function multiCalculate($input): float|int
{
    $noWhiteSpacesInput = str_replace(' ', '', $input);
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
    $inputForMultiCalculate = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
    $inputForMultiCalculate = explode($whiteSpace, $inputForMultiCalculate);
    for ($i = 0; $i < 25; $i++) {
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
        array_splice($inputForMultiCalculate, $position - 1, 3, $result);

    }
    echo $result;
    return $result;
}

//works
function simpleBracketsCalculate($input): float
{
    $noWhiteSpacesInput = str_replace(' ', '', $input);
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

//both are needed. First - setting, Second - correcting
    $inputForSimpleBrackets = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
    $inputForSimpleBrackets = explode($whiteSpace, $inputForSimpleBrackets);
while (in_array("(", $inputForSimpleBrackets)){
    $firstBracket = array_search("(", $inputForSimpleBrackets);
    $secondBracket = array_search(")", $inputForSimpleBrackets);
//brackets are first to calculate
    $expressionInBrackets = array_slice($inputForSimpleBrackets, $firstBracket + 1, $secondBracket-$firstBracket-1);

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
        $e = array_splice($expressionInBrackets, $position - 1, 3, $result);
    }
    $bracketsResult = [$result];

    $noBracketsPart = array_slice($inputForSimpleBrackets, 0, $firstBracket - 1);
    $afterBracketsPart = array_slice($inputForSimpleBrackets, $secondBracket + 2);
    $inputForSimpleBrackets = array_merge($noBracketsPart, $bracketsResult, $afterBracketsPart);
    $finalExpression = $inputForSimpleBrackets;
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
}

function calcNestedBrackets($input): float {

    $noWhiteSpacesInput = str_replace(' ', '', $input);
    $operators = ["+", "-", "*", "/", "(", ")"];
    $whiteSpace = " ";
    $operatorsSpace = [
        " + ",
        " - ",
        " * ",
        " / ",
        "( ",
        " )",
    ];
    $inputForSimpleCalculate = str_replace($operators, $operatorsSpace, $noWhiteSpacesInput);
    $inputForSimpleCalculate = explode($whiteSpace, $inputForSimpleCalculate);
    again:$bracketKeys = getBracketKeys($inputForSimpleCalculate);

    if ($bracketKeys !== null) {
        foreach ($bracketKeys as $openingKeys => $closingKeys) {
            $firstBracket = $openingKeys;
            $secondBracket = $closingKeys;

//brackets are first to calculate
            $expressionInBrackets = array_slice($inputForSimpleCalculate, $firstBracket + 1, $secondBracket - $firstBracket - 1);
//counting part for brackets
            for ($i = 0; $i <= count($expressionInBrackets); $i++) {
                switch (true) {
                    case $position = array_search("*", $expressionInBrackets):
                        $result = calc($expressionInBrackets, $position, "*");
                        break;
                    case $position = array_search("/", $expressionInBrackets):
                        $result = calc($expressionInBrackets, $position, "/");
                        break;
                    case $position = array_search("-", $expressionInBrackets):
                        $result = calc($expressionInBrackets, $position, "-");
                        break;
                    case $position = array_search("+", $expressionInBrackets):
                        $result = calc($expressionInBrackets, $position, "+");
                        break;
                }
                $replacement = array($result);
                $expression = array_splice($expressionInBrackets, $position - 1, 3, $replacement);
            }
            $bracketsResult = array($result);

            //slice 'n dice in order to create a new array(new-corrected)
            $beforeBrackets = array_slice($inputForSimpleCalculate, 0, $firstBracket);
            $afterBrackets = array_slice($inputForSimpleCalculate, $secondBracket + 1);
            $inputForSimpleCalculate = array_merge($beforeBrackets, $bracketsResult, $afterBrackets);
            $inputForMultiCalculate = $inputForSimpleCalculate;
            goto again;
        }
        for ($i = 0; $i < 25; $i++) {
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
            array_splice($inputForMultiCalculate, $position - 1, 3, $result);

        }
    }
return $result;

}

