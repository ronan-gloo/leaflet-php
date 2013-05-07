<?php
/**
 * @Author      ronan.tessier@vaconsulting.lu
 * @Date        07/05/13
 * @File        Test.php
 * @Copyright   Copyright (c) leaflet-php - All rights reserved
 * @Licence     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Leaflet\tests;

use Leaflet\JsFunc;

class JsFuncTest extends \PHPUnit_Framework_TestCase {

    public function testIsInstanceOfJsonable()
    {
        $this->assertInstanceOf('Leaflet\Core\Jsonable', new JsFunc());
    }

    public function testClosure()
    {
        $func = new JsFunc();
        $clos = function(){ return true; };

        $this->assertEquals(true, $func->closure($clos));
    }

    public function testGetSetName()
    {
        $func = (new JsFunc)->name('name');
        $this->assertEquals('name', $func->getName());
    }

    public function testGetSetArgs()
    {
        $func = (new JsFunc)->args('name', 'test');
        $this->assertEquals('name,test', $func->getArgs());
    }

    public function testGetSetLine()
    {
        $func = (new JsFunc)->line('name');
        $this->assertEquals("\tname\n", $func->getLines());
    }

    /**
     * @dataProvider prepareJson()
     */
    public function testToJsonWithName($func, $expt)
    {
        $func->name('hey');
        $expected = 'var hey = '.$expt;
        $this->assertEquals($expected, $func->toJson());
    }
    /**
     * @dataProvider prepareJson()
     */
    public function testToJsonWithoutName($func, $expt)
    {
        $this->assertEquals($expt, $func->toJson());
    }

    /**
     * @dataProvider prepareJson()
     */
    public function testToString($func)
    {
        $this->assertEquals($func->toJson(), $func->__toString());
    }

    public function prepareJson()
    {
        $func = (new JsFunc)->args('e')->line('name');
        $expt = 'function(e){'."\n"."\tname\n".'}';
        return [[$func, $expt]];
    }

}
