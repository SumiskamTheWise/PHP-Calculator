<?php

namespace classes;

class NestedBracketsCalculator extends AbstractCalculator
{
    private static function getBracketKeys($input): ?array
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
    public function calculate(string $input): float
    {
        $inputForNestedBracketsCalculate = static::creatingInputForCalculating($input);
        again:
        $bracketKeys = static::getBracketKeys($inputForNestedBracketsCalculate);
        if ($bracketKeys !== null) {
            foreach ($bracketKeys as $openingKeys => $closingKeys) {
                $firstBracket = $openingKeys;
                $secondBracket = $closingKeys;
                $expressionInBrackets = array_slice($inputForNestedBracketsCalculate, $firstBracket + 1, $secondBracket - $firstBracket - 1);
                $result = static::multiCalculate($expressionInBrackets);
                $inputForNestedBracketsCalculate = static::creatingArrayForBracketsCalculators($inputForNestedBracketsCalculate, $result, $firstBracket, $secondBracket);
                goto again;
            }
        }
        echo "Nested";
        return static::multiCalculate($inputForNestedBracketsCalculate);
    }

}