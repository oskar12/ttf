<?php
namespace TTF\conditions;

/**
 * Conditions container
 */
class Conditions
{
    private $conditions = [];

    public function addCondition(Condition $condition)
    {
        $this->addOrUpdate($condition);
    }

    /**
     * Update only if conditions are the same
     * @param Condition $newCondition
     */
    private function addOrUpdate(Condition $newCondition)
    {
        /** @var Condition $condition */
        foreach($this->conditions as $i => $condition) {
            if ($condition->getParameterConditions() == $newCondition->getParameterConditions()) {
                unset($this->conditions[$i]);
                break;
            }
        }
        $this->conditions[] = $newCondition;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->conditions;
    }



}