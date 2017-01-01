<?php
namespace TTF\conditions;

/*
 * Condition entity
 */
class Condition
{

    private $parameterConditions;
    private $returnedValue;

    /**
     * Condition constructor.
     * @param $parameterConditions
     * @param $returnedValue
     */
    public function __construct(array $parameterConditions, $returnedValue)
    {
        $this->parameterConditions = $parameterConditions;
        $this->returnedValue = $returnedValue;
    }

    /**
     * @return mixed
     */
    public function getReturnedValue()
    {
        return $this->returnedValue;
    }

    /**
     * @return array
     */
    public function getParameterConditions(): array
    {
        return $this->parameterConditions;
    }



}