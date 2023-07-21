<?php

namespace classes;

class SimpleCalculator extends AbstractCalculator
{
    public function calculate(string $input):  float
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
}