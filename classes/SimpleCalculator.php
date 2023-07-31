<?php

namespace classes;

class SimpleCalculator extends AbstractCalculator
{
    public function calculate(string $input):  float
    {
        $result = 0;
        $expression = str_split($input);
        $numbers = match (true) {
            in_array("+", $expression) => explode("+", $input),
            in_array("-", $expression) => explode("-", $input),
            in_array("*", $expression) => explode("*", $input),
            in_array("/", $expression) => explode("/", $input),
            default => 0,
        };

        $number1 = floatval($numbers[0]);
        $number2 = floatval($numbers[1]);

        $result = match (true) {
            in_array("+", $expression) => $number1 + $number2,
            in_array("-", $expression) => $number1 - $number2,
            in_array("*", $expression) => $number1 * $number2,
            in_array("/", $expression) => $number1 / $number2,
            default => 0,
        };
        echo "Simples";

        return $result;
    }
}