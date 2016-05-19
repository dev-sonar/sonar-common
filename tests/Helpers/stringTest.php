<?php
namespace Sonar\Common\Test\Helpers;

use Sonar\Common\Test\TestCase;

class stringTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        require __DIR__ . '/../../src/Helpers/string.php';
    }
    public function teststrcat()
    {
        $this->assertEquals(strcat("a","b","c"),'abc');
        $this->assertEquals(strcat("a",null,"c"),null);
    }
}


