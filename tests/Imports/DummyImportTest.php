<?php
namespace Sonar\Common\Test\Import;

use Sonar\Common\Imports\DummyImport;
use Sonar\Common\Test\TestCase;
use Mockery;

class DummyImportTest extends TestCase
{
    public function __destruct()
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

        $obj->setConfig(__DIR__ . '/test.yml',true);

        $model = Mockery::mock('model');
        $model->shouldReceive('save')->once();
        $models = [
            'tests' => [$model],
        ];
        $csv = ['id','name1'];
        $obj->setModels($models,$csv);
        $this->assertTrue($obj instanceof DummyImport);

    }

    public function test4()
    {
        $obj = new DummyImport();

        $obj->setConfig(__DIR__ . '/test4.yml');

        $csv = ['id'=>'1','name1'=>'hoge'];
        $model = Mockery::mock('model');
        $model->shouldReceive('save')->once();
        $models = [
            'tests' => [$model],
        ];
        $obj->setModels($models,$csv);
        $this->assertTrue($obj instanceof DummyImport);
    }
    public function testcsvRecord()
    {
        $obj = new DummyImport();

        $this->assertTrue($obj->csvRead(__DIR__ . "/test.csv"));
    }

}
