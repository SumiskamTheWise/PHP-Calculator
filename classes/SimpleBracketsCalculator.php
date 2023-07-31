<?php

namespace classes;

class SimpleBracketsCalculator extends AbstractCalculator
{
    public function calculate(string $input):  float
    {
        $inputForSimpleBrackets = static::creatingInputForCalculating($input);
        while (in_array("(", $inputForSimpleBrackets)) {

            $firstBracket = array_search("(", $inputForSimpleBrackets);
            $secondBracket = array_search(")", $inputForSimpleBrackets);
            $expressionInBrackets = array_slice($inputForSimpleBrackets, $firstBracket + 1, $secondBracket - $firstBracket - 1);
            $result = static::multiCalculate($expressionInBrackets);
            $inputForSimpleBrackets = static::creatingArrayForBracketsCalculators($inputForSimpleBrackets, $result, $firstBracket, $secondBracket);
        }
        echo "Brackets";
        return static::multiCalculate($inputForSimpleBrackets);
    }

}