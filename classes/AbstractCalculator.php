<?php

namespace classes;
require_once 'NestedBracketsCalculator.php';
require_once 'SimpleBracketsCalculator.php';
require_once 'SimpleCalculator.php';
require_once 'MultiCalculator.php';
abstract class AbstractCalculator
{
    abstract public function calculate (string $input): float;


    public static function getCalculator($input): AbstractCalculator
    {
        self::validation($input);

        return match (true) {
            self::hasNestedBrackets($input) => new NestedBracketsCalculator(),
            in_array("(", str_split($input)) => new SimpleBracketsCalculator(),
            self::getAmountOfOperators($input) == 1 => new SimpleCalculator(),
            self::getAmountOfOperators($input) > 1 => new MultiCalculator(),
        };
    }


    static function validation(string $input): void
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

    static function hasNestedBrackets($input): bool
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
            } elseif ($individual == ")") {
                $bracketsCounter = $bracketsCounter - 1;
            }
        }
        return $result;
    }

    static function getAmountOfOperators(string $input): int
    {
        $noWhiteSpacesInput = str_replace(' ', '', $input);
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $inputOperators = str_replace($numbers, "", $noWhiteSpacesInput);
        $arrayOfOperators = str_split($inputOperators);
        $amountOfOperators = count($arrayOfOperators);
        return ($amountOfOperators);
    }

    static public function calc(array $choppedInput, int $position, string $operator): float
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

    static public function creatingInputForCalculating($input): array
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

    static public function multiCalculate($input): float|int
    {
        $inputForMultiCalculate = !is_array($input) ? creatingInputForCalculating($input) : $input;
        while (count($inputForMultiCalculate) > 1) {
            switch (true) {
                case $position = array_search("/", $inputForMultiCalculate):
                    $result = static::calc($inputForMultiCalculate, $position, "/");
                    break;
                case $position = array_search("*", $inputForMultiCalculate):
                    $result = static::calc($inputForMultiCalculate, $position, "*");
                    break;
                case $position = array_search("-", $inputForMultiCalculate):
                    $result = static::calc($inputForMultiCalculate, $position, "-");
                    break;
                case $position = array_search("+", $inputForMultiCalculate):
                    $result = static::calc($inputForMultiCalculate, $position, "+");
                    break;
            }
            array_splice($inputForMultiCalculate, $position - 1, 3, array($result));
        }
        return $result;
    }

    static public function creatingArrayForBracketsCalculators($input, $result, $firstBracket, $secondBracket): array
    {
        $bracketsResult = array($result);
        $beforeBrackets = array_slice($input, 0, $firstBracket);
        $afterBrackets = array_slice($input, $secondBracket + 1);
        return array_merge($beforeBrackets, $bracketsResult, $afterBrackets);
    }



}