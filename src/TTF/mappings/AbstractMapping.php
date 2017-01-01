<?php
namespace TTF\mappings;

use TTF\conditions\Conditions;

abstract class AbstractMapping implements Mapping
{

    protected $params;
    protected $errors = [];
    protected $paramsRequired = [];

    /**
     * @param array $params
     * @throws \Exception
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        if (!$this->validateParams()) {
            throw new \Exception(implode("\n", $this->getErrors()));
        }
    }

    /**
     * @return bool
     */
    public function validateParams() : bool
    {
        foreach($this->paramsRequired as $type => $paramNames)
        {
            foreach($paramNames as $paramName) {
                if (!array_key_exists($paramName, $this->params)) {
                    $this->addError('Missing parameter ' . $paramName);
                    continue;
                }
                $paramType = gettype($this->params[$paramName]);
                if ($paramType !== $type) {
                    $this->addError('Wrong type for parameter \'' . $paramName . '\' expected: ' . $type . ' given: ' . $paramType);
                }
            }
        }

        return count($this->getErrors()) === 0;
    }

    public function getComputations() : array
    {
        $computations = [];
        return $computations;
    }

    /**
     * @return Conditions
     */
    public function getConditions() : Conditions
    {
        $conditions = new Conditions();
        return $conditions;
    }

    /**
     * @param string $error
     */
    protected function addError(string $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    protected function getErrors() : array
    {
        return $this->errors;
    }
}