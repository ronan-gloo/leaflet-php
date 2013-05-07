<?php
/**
 * @Author      ronan.tessier@vaconsulting.lu
 * @Date        07/05/13
 * @File        JsVarTest.php
 * @Copyright   Copyright (c) leaflet-php - All rights reserved
 * @Licence     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Leaflet\tests;

use Leaflet\JsVar;

class JsVarTest extends \PHPUnit_Framework_TestCase {

    public function testGetSet()
    {
        $var = new JsVar();
        $this->assertNull($var->get());
        $this->assertSame($var->set('name'), $var);
        $this->assertEquals($var->get(), 'name');
    }

    public function testIsInstanceOfJsonable()
    {
        $this->assertInstanceOf('Leaflet\Core\Jsonable', new JsVar());
    }

    public function testToJson()
    {
        $this->assertEquals((new JsVar('name'))->toJson(), 'name');
    }

    /**
     * @expectedException \Leaflet\Exception\InvalidJsVarNameException
     */
    public function testSetThrowException()
    {
        $var = new JsVar();
        $var->set([]);

    }

    public function testConstructorAcceptsName()
    {
        $this->assertEquals($var = new JsVar('name'), $var->get());
    }


}
