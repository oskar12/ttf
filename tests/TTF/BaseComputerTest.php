<?php
/**
 * Created by PhpStorm.
 * User: oskar.wojciski
 * Date: 19/12/2016
 * Time: 22:14
 */
declare(strict_types=1);
namespace TTF;


use TTF\mappings\BaseMapping;
use TTF\mappings\Specialized1Mapping;
use TTF\mappings\Specialized2Mapping;

class BaseComputerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider dataProvider
     * @param $parameters
     * @param $mapping
     * @param $expectedX
     * @param $expectedY
     */
    public function testComputations($parameters, $mapping, $expectedX, $expectedY)
    {
        $computer = new Computer($parameters, $mapping);

        $this->assertEquals($expectedX, $computer->getX());
        $this->assertEquals($expectedY, $computer->getY());
    }


    public function dataProvider()
    {
        return [
            [['a' => true, 'b' => true, 'c' => false, 'd' => 1, 'e' => 2, 'f' => 3], new BaseMapping(), XValueEnum::S, 1.02],
            [['a' => true, 'b' => true, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new BaseMapping(), XValueEnum::R, 0.99],
            [['a' => false, 'b' => true, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new BaseMapping(), XValueEnum::T, 0.97],

            [['a' => true, 'b' => true, 'c' => false, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized1Mapping(), XValueEnum::S, 1.02],
            [['a' => true, 'b' => true, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized1Mapping(), XValueEnum::R, 2.02],
            [['a' => false, 'b' => true, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized1Mapping(), XValueEnum::T, 0.97],

            [['a' => true, 'b' => true, 'c' => false, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized2Mapping(), XValueEnum::T, 0.97],
            [['a' => true, 'b' => false, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized2Mapping(), XValueEnum::S, 4.02],
            [['a' => false, 'b' => true, 'c' => true, 'd' => 1, 'e' => 2, 'f' => 3], new Specialized2Mapping(), XValueEnum::T, 0.97],

        ];

    }

}
