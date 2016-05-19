<?php
namespace Sonar\Common\Test;

use Sonar\Common\HelpersServiceProvider;
use Mockery;

class HelpersServiceProviderTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }
    public function testインスタンス()
    {
        $app = Mockery::mock('App');
        $obj = new HelpersServiceProvider($app);
        $this->assertTrue($obj instanceof HelpersServiceProvider);
    }

    public function testregister()
    {
        $app = Mockery::mock('App');
        $obj = new HelpersServiceProvider($app);
//        File::shouldReceive('test');
        $this->assertNull($obj->register());

    }

}
