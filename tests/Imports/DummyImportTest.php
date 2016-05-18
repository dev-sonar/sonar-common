<?php
namespace Sonar\Common\Test\Import;

use Sonar\Common\Imports\DummyImport;
use Sonar\Common\Test\TestCase;
use Mockery;

class DummyImportTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }
    public function testインスタンス()
    {
        $obj = new DummyImport();
        $this->assertTrue($obj instanceof DummyImport);
        $this->assertTrue(is_array($obj->getConfig()));
    }
    public function test正常()
    {
        $obj = new DummyImport();

        $obj->setConfig(__DIR__ . '/test.yml');

        $model = Mockery::mock('model');
        $model->shouldReceive('save')->once();
        $models = [
            'tests' => [$model],
        ];
        $csv = ['id','name1','name2'];
        $obj->setModels($models,$csv);
    }

    /**
     * @expectedException \Exception
     */
    public function testエラー1()
    {
        $obj = new DummyImport();

        $obj->setConfig(__DIR__ . '/test.yml');

        $csv = ['id','name1','name2'];
        $model = Mockery::mock('model');
        $models = [
            'tests2' => [$model],
        ];
        $obj->setModels($models,$csv);
    }
    /**
     * @expectedException \Exception
     */
    public function testエラー2()
    {
        $obj = new DummyImport();

        $obj->setConfig(__DIR__ . '/test2.yml');

        $csv = ['id','name1','name2'];
        $model = Mockery::mock('model');
        $models = [
            'tests' => [$model],
        ];
        $obj->setModels($models,$csv);
    }
    /**
     * @expectedException \Exception
     */
    public function testエラー3()
    {
        $obj = new DummyImport();

        $obj->setConfig(__DIR__ . '/test3.yml');

        $csv = ['id','name1','name2'];
        $model = Mockery::mock('model');
        $models = [
            'tests' => [$model],
        ];
        $obj->setModels($models,$csv);

    }
    public function testcsvRecord()
    {
        $obj = new DummyImport();

        $this->assertTrue($obj->csvRead(__DIR__ . "/test.csv"));
    }

    /**
     * @expectedException \Exception
     */
    public function testcsvRecordエラー()
    {
        $obj = new DummyImport();

        $obj->csvRead(__DIR__ . "/test2.csv");
    }
}
