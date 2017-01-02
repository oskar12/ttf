<?php
namespace TTF\mappings;

use TTF\conditions\Conditions;

abstract class AbstractMapping implements Mapping
{

    protected $params;
    protected $validatedParams;
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

    public function getValidatedParams() : array
    {
        return $this->validatedParams;
    }

    /**
     * @return bool
     */
    protected function validateParams() : bool
    {
        //TODO: improve validation
        $filteringOptions = [
            'options' => [
                'default' => null,
            ]
        ];

        foreach($this->paramsRequired as $type => $paramNames)
        {
            foreach($paramNames as $paramName) {
                if (!array_key_exists($paramName, $this->params)) {
                    $this->addError('Missing parameter ' . $paramName);
                    continue;
                }

                switch($type) {
                    case 'boolean' :
                        $this->validatedParams[$paramName] = filter_var($this->params[$paramName], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                        break;
                    case 'integer' :
                        $this->validatedParams[$paramName] = filter_var($this->params[$paramName], FILTER_VALIDATE_INT, $filteringOptions);
                        break;
                    case 'float' :
                        $this->validatedParams[$paramName] = filter_var($this->params[$paramName], FILTER_VALIDATE_FLOAT, $filteringOptions);
                        break;
                }

                if ($this->validatedParams[$paramName] === null) {
                    $this->addError('Wrong value or type for \'' . $paramName . '\' parameter');
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