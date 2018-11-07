<?php

namespace Actions;

use Exceptions\CalculationException;

class Calculation
{
    private $chipCount;
    private $fieldsCount;

    public function __construct($chipCount, $fieldsCount)
    {
        $this->chetValues($chipCount, $fieldsCount);

        $this->chipCount = $chipCount;
        $this->fieldsCount = $fieldsCount;
    }

    public function getCombinations()
    {
        $listA = array_fill(0, $this->chipCount, 1);
        $listB = array_fill(0, $this->fieldsCount - $this->chipCount, 0);
        $list  = array_merge($listA, $listB);
        $arr   = [];

        foreach ($this->calcCombinations($list) as $permutation) {
            if(!in_array($permutation, $arr)) {
                $arr[] = $permutation;
            }
        }

        return $arr;
    }

    private function calcCombinations($elements)
    {
        if(count($elements) <= 1) {        
            yield $elements;
        } else {
            foreach($this->calcCombinations(array_slice($elements, 1)) as $permutation) {
                foreach(range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i), [$elements[0]], array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    private function chetValues($chipCount, $fieldsCount)
    {
        if(!is_int($chipCount) || !is_int($fieldsCount)) {
            throw new CalculationException('The number of chips and the size of the playing field can not have fractional values!');
        }

        if($chipCount < 1 || $fieldsCount < 1) {
            throw new CalculationException('The number of chips and the size of the playing field can not be negative or equal to "0"!');
        }

        if($chipCount > $fieldsCount) {
            throw new CalculationException('The number of chips can not be more than the playing field!');
        }
    }
}