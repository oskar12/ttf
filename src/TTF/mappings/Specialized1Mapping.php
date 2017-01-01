<?php
namespace TTF\mappings;

use TTF\XValueEnum;


class Specialized1Mapping extends BaseMapping
{

    /**
     * @return array
     */
    public function getComputations() : array
    {
        $computations = parent::getComputations();
        $computations[XValueEnum::R] = 2 * $this->params['d'] + ($this->params['d'] * $this->params['e'] / 100);

        return $computations;
    }
}