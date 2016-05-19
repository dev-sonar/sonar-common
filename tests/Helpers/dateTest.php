<?php
namespace Sonar\Common\Test\Helpers;

use Sonar\Common\Test\TestCase;

class dateTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        require __DIR__ . '/../../src/Helpers/date.php';
    }
    public function teststrtodate1()
    {
        $this->assertEquals(strtodate('2015-01-01','Ymd'),'20150101');
    }
    public function teststrtodate2()
    {
        $this->assertEquals(strtodate(null,'Ymd'),null);
    }
    public function testym()
    {
        $this->assertEquals(ym(200001),'2000年1月');
    }
    public function testym2()
    {
        $this->assertEquals(ym(20001),null);
    }
    public function testelapse_days()
    {
        $this->assertEquals(elapse_days(time()),0);
    }
}


