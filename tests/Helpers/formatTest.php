<?php
namespace Sonar\Common\Test\Helpers;

use Sonar\Common\Test\TestCase;

class formatTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        require __DIR__ . '/../../src/Helpers/format.php';
    }
    public function testnumeric_format()
    {
        $this->assertEquals(numeric_format("1000"),'1,000');
    }
}


