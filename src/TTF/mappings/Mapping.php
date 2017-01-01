<?php
namespace TTF\mappings;

use TTF\conditions\Conditions;

/**
 * Mapping interface
 */

interface Mapping
{
    public function setParams(array $params);

    public function getConditions() : Conditions;

    public function getComputations() : array;

    public function validateParams();

}