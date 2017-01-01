<?php
namespace TTF\mappings;

use TTF\conditions\Condition;
use TTF\conditions\Conditions;
use TTF\XValueEnum;

class BaseMapping extends AbstractMapping
{
    protected $paramsRequired = [
        'boolean' => ['a', 'b', 'c'],
        'integer' => ['d', 'e', 'f']
    ];

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
        ], XValueEnum::S);
        $conditions->addCondition($condition);

        $condition = new Condition([
            'a' => true,
            'b' => true,
            'c' => true
        ], XValueEnum::R);
        $conditions->addCondition($condition);

        $condition = new Condition([
            'a' => false,
            'b' => true,
            'c' => true
        ], XValueEnum::T);
        $conditions->addCondition($condition);

        return $conditions;
    }

    /**
     * @return array
     */
    public function getComputations(): array
    {
        $computations = parent::getComputations();
        $params = $this->params;
        $computations += [
            XValueEnum::S => $params['d'] + ($params['d'] * $params['e'] / 100),
            XValueEnum::R => $params['d'] + ($params['d'] * ($params['e'] - $params['f']) / 100),
            XValueEnum::T => $params['d'] - ($params['d'] * $params['f'] / 100)
        ];

        return $computations;
    }
}