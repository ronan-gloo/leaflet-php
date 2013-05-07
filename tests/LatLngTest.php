<?php
/**
 * @Author      ronan.tessier@vaconsulting.lu
 * @Date        07/05/13
 * @File        LatLngTest.php
 * @Copyright   Copyright (c) leaflet-php - All rights reserved
 * @Licence     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Leaflet\tests;


use Leaflet\LatLng;

class LatLngTest extends \PHPUnit_Framework_TestCase {

    public function testLatLngConvertToFloat()
    {
        $ll = new LatLng(1.0, 1.0);
    }

    public function testConstructor()
    {
        $ll = new LatLng(1.0, 1.0);
        $this->assertSame($ll->getLat(), 1.0);
        $this->assertSame($ll->getLng(), 1.0);
    }

    public function testSetGetLat()
    {
        $ll = new LatLng();
        $ll->setLat('1.1');
        $this->assertSame(1.1, $ll->getLat());
    }

    public function testSetGetLng()
    {
        $ll = new LatLng();
        $ll->setLng('1.1');
        $this->assertSame(1.1, $ll->getLng());
    }

}
