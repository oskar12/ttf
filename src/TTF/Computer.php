<?php
namespace TTF;

use TTF\conditions\Condition;
use TTF\mappings\Mapping;

/**
 * Main class to compute the proper values of ttf alghoritm
 */
class Computer
{

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * @var Mapping
     */
    private $mapping;

    /**
     * BaseComputer constructor.
     * @param array $parameters
     * @param Mapping $mapping
     * @throws \Exception
     */
    public function __construct(array $parameters, Mapping $mapping)
    {
        foreach(['a', 'b', 'c', 'd', 'e', 'f'] as $paramName) {
            if (!array_key_exists($paramName, $parameters)) {
                Throw new \Exception('Missing ' . $paramName . ' parameter');
            }

            $this->params[$paramName] = $parameters[$paramName];
        }
        $this->mapping = $mapping;
        $this->mapping->setParams($this->params);
    }

    /**
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    public function compute()
    {
        $this->x = $this->computeX();
        $this->y = $this->computeY();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function computeX() : string
    {
        $conditions = $this->mapping->getConditions();
        /** @var Condition $condition */
        foreach($conditions->getArray() as $condition)
        {

            $parameters = $condition->getParameterConditions();
            foreach($parameters as $key => $value)
            {
                if ($this->params[$key] !== $value) {
                    continue 2;
                }
            }
            return $condition->getReturnedValue();
        }

        throw new \Exception('Unsupported mapping - cannot resolve X parameter');
    }

    private function computeY() : float
    {
        $computations = $this->mapping->getComputations();
        if (array_key_exists($this->getX(), $computations)) {
            return $computations[$this->getX()];
        }

        throw new \Exception('Unsupported mapping - cannot compute Y parameter');
    }


}