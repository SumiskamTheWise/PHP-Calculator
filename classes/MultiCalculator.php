<?php

namespace classes;

class MultiCalculator extends AbstractCalculator
{
    public function calculate(string $input):  float
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
}