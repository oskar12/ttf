<?php
namespace TTF\mappings;

use TTF\conditions\Condition;
use TTF\conditions\Conditions;
use TTF\XValueEnum;


class Specialized2Mapping extends BaseMapping
{

    /**
     * @return Conditions
     */
    public function getConditions(): Conditions
    {
        $conditions = parent::getConditions();
        $condition = new Condition([
            'a' => true,
            'b' => true,
            'c' => false
        ], XValueEnum::T);
        $conditions->addCondition($condition);

        $condition = new Condition([
            'a' => true,
            'b' => false,
            'c' => true
        ], XValueEnum::S);
        $conditions->addCondition($condition);

        return $conditions;
    }

    /**
     * @return array
     */
    public function getComputations() : array
    {
        $computations = parent::getComputations();
        $computations[XValueEnum::S] = $this->params['f'] + $this->params['d'] + ($this->params['d'] * $this->params['e'] / 100);

        return $computations;
    }
}