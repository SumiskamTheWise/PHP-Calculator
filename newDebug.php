<?php
//add splice so that after counting the result is placed on the place of brackets
    $input = "11-(1*111-(10*10))+((10*10)+11)-1*111";

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
    print_r($inputForSimpleCalculate);
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
                echo $result;
                $replacement = array($result);
                $expression = array_splice($expressionInBrackets, $position - 1, 3, $replacement);
            }
            $bracketsResult = array($result);
            //slice&dice in order to create a new array(new-corrected)
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
        echo "\n".$result;
    }


function calc(array $expressionInBrackets, int $position, string $operator): float
{
    $firstNumber = $expressionInBrackets[$position - 1];
    $secondNumber = $expressionInBrackets[$position + 1];

    return match ($operator) {
        '/' => $firstNumber / $secondNumber,
        '*' => $firstNumber * $secondNumber,
        '+' => $firstNumber + $secondNumber,
        '-' => $firstNumber - $secondNumber,
    };

}

