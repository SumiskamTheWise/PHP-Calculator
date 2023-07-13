<?php
function MainDistributor($input): float
{
    $symbols = regex();
    echo $numbers = $symbols[0];
    echo $operators = $symbols[1];
    $plus = substr_count($input, "+");
    $minus = substr_count($input, "-");
    $multiply = substr_count($input, "*");
    $division = substr_count($input, "/");
    $operators = "\n" . $plus + $minus + $multiply + $division;
    $finalResult = simpleCalculate();
    return $finalResult;
}


function validation(string $input): void
{
    $validNumbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
    $validOperators = array("+", "-", "*", "/", "(", ")");
    $all_characters = array_merge($validNumbers, $validOperators);
    $test_value = $input;
    $user_input = str_split($test_value);
    for ($i = 0; $i < strlen($test_value); $i++) {

        if (!in_array($user_input[$i], $all_characters)) {
            die("Invalid Input");
        }
    }
}

function regex(string $input): array
{

    $symbols = [];
    if (preg_match_all("/\d", $input, $numbers)) {
        $numbers = $numbers[0];
    }
    $operators = preg_replace("/\d", "", $input);
    $symbols[0] = $numbers;
    $symbols[1] = str_split($operators);

    if (count($symbols[1]) == 1) {
        echo "Simple Calculator";
    } elseif (count($symbols[1]) > 1) {
        echo "Multi Calculator";
    }
    return ($symbols);
}

// no regex function here
//function stringChopping (string $input) : array {
//    $choppedInput = str_split($input);
//    $numbers = [1,2,3,4,5,6,7,8,9,0,"."];
//    $operators = ["+","-","/","*"];
//    $sortedNumbers = [];
//    for ($i=0; $i< strlen($input); $i++) {
//        echo $i,$choppedInput[$i];
//        if ($choppedInput[$i] == "6")
//        {
//            array_push($sortedNumbers[0], $choppedInput[$i]);
//        }
//        else
//        {
//            array_push($sortedNumbers[1], $choppedInput[$i]);
//        }
//    }
//    print_r($sortedNumbers);
//    return ($choppedInput);
//}
// solves a simple equation like a(+-*/)b
function simpleCalculate($input): float
{
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

function CalculateMultiple($input): float
{
    $choppedInput = str_split($input);
    print_r($choppedInput);
//half-solution to a problem bellow, now work on splitting the numbers correctly (10,100,1000, etc.)
    for ($i = 0; $i <= count($choppedInput); $i++)
        if ($position = array_search("*", $choppedInput)) {
            echo "First number:" . $firstNumber = $choppedInput[$position - 1] . "\n";
            echo "Second number:" . $secondNumber = $choppedInput[$position + 1] . "\n";
            echo "Result:" . $result = $firstNumber * $secondNumber;
            array_splice($choppedInput, $position - 1, $position + 2, $result);
            print_r($choppedInput);
        } elseif ($position = array_search("/", $choppedInput)) {
            echo "\n" . "First number:" . $firstNumber = $choppedInput[$position - 1] . "\n";
            echo "Second number:" . $secondNumber = $choppedInput[$position + 1] . "\n";
            echo "Result:" . $result = $firstNumber / $secondNumber;
            array_splice($choppedInput, $position - 1, $position + 2, $result);
            print_r($choppedInput);
        } elseif ($position = array_search("+", $choppedInput)) {
            echo "\n" . "First number:" . $firstNumber = $choppedInput[$position - 1] . "\n";
            echo "Second number:" . $secondNumber = $choppedInput[$position + 1] . "\n";
            echo "Result:" . $result = $firstNumber + $secondNumber;
            array_splice($choppedInput, $position - 1, $position + 2, $result);
            print_r($choppedInput);
        } else {
            $position = array_search("-", $choppedInput);
            echo "\n" . "First number:" . $firstNumber = $choppedInput[$position - 1] . "\n";
            echo "Second number:" . $secondNumber = $choppedInput[$position + 1] . "\n";
            echo "Result:" . $result = $firstNumber - $secondNumber;
            array_splice($choppedInput, $position - 1, $position + 2, $result);
            print_r($choppedInput);

        }
        $result = $choppedInput[0];
        return($result);
}