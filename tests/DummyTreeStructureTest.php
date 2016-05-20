<?php
namespace Sonar\Common\Test;

use Sonar\Common\DummyTreeStructure;

class DummyTreeStructureTest extends TestCase
{
    public function testインスタンス()
    {
        $obj = new DummyTreeStructure;
        $this->assertTrue($obj instanceof DummyTreeStructure);
    }
    public function test正常()
    {
        $obj = new DummyTreeStructure;
        $obj->initTree();
        $data = $this->getData();

        $obj->addTreeStructure($data);
        $data = $this->getData2();

        $obj->addTreeStructure($data);
        $tmp = $obj->getTree();
        $this->assertTrue(count($tmp[1]->children) == 2);
        $this->assertTrue(count($tmp[2]->children) == 0);

        $data = $this->getData3();
        $obj->addTreeStructure($data);
        $tmp = $obj->getTree();
        $this->assertTrue(count($tmp[1]->children[11]) == 1);
    }
    /**
     * @expectedException Exception
     */
    public function test異常1()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure(['1' => 'hoge']);
    }
    /**
     * @expectedException Exception
     */
    public function test異常2()
    {
        $obj = new DummyTreeStructure;
        $data = $this->getData();
        unset($data[0]->id);
        $obj->addTreeStructure($data);
    }

    public function testMergeCount()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure($this->getData());
        $obj->addTreeStructure($this->getData2());
        $obj->addTreeStructure($this->getData3());

        $obj->mergeCount($this->getCountData());

        $tmp = $obj->getTree();

        $this->assertTrue($tmp[1]->count == 10);
    }

    /**
     * @expectedException Exception
     */
    public function testMergeCount異常1()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure($this->getData());
        $obj->addTreeStructure($this->getData2());
        $obj->addTreeStructure($this->getData3());

        $obj->mergeCount(['1' => 'hoge']);

        $tmp = $obj->getTree();

        $this->assertTrue($tmp[1]->count == 10);
    }

    /**
     * @expectedException Exception
     */
    public function testMergeCount異常2()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure($this->getData());
        $obj->addTreeStructure($this->getData2());
        $obj->addTreeStructure($this->getData3());

        $data = $this->getCountData();
        unset($data[0]->id );
        $obj->mergeCount($data);

        $tmp = $obj->getTree();

        $this->assertTrue($tmp[1]->count == 10);
    }

    /**
     * @expectedException Exception
     */
    public function testMergeCount異常3()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure($this->getData());
        $obj->addTreeStructure($this->getData2());
        $obj->addTreeStructure($this->getData3());

        $data = $this->getCountData();
        unset($data[0]->count );
        $obj->mergeCount($data);

        $tmp = $obj->getTree();

        $this->assertTrue($tmp[1]->count == 10);
    }

    /**
     * @expectedException Exception
     */
    public function testMergeCount異常4()
    {
        $obj = new DummyTreeStructure;
        $obj->addTreeStructure($this->getData());
        $obj->addTreeStructure($this->getErrorData());

        $obj->mergeCount(['1' => 'hoge']);

//        $tmp = $obj->getTree();

//        $this->assertTrue($tmp[1]->count == 10);
    }


    protected function getCountData()
    {
        $data = [];
        $tmp = new \StdClass;
        $tmp->id = 1;
        $tmp->count = 10;
        $data[] = $tmp;

        $tmp = new \StdClass;
        $tmp->id = 111;
        $tmp->count = 111;
        $data[] = $tmp;

        return $data;
    }

    protected function getData()
    {
        $data = [];
        $tmp = new \StdClass;
        $tmp->id = 1;
        $tmp->name = 'hoge1';
        $data[] = $tmp;

        $tmp = new \StdClass;
        $tmp->id = 2;
        $tmp->name = 'hoge2';
        $data[] = $tmp;

        return $data;
    }
    protected function getErrorData()
    {
        $data = [];
        $tmp = new \StdClass;
        $tmp->name = 'hoge1';
        $data[] = $tmp;

        $tmp = new \StdClass;
        $tmp->name = 'hoge2';
        $data[] = $tmp;

        return $data;
    }

    protected function getData2()
    {
        $data = [];
        $tmp = new \StdClass;
        $tmp->parent_id = 1;
        $tmp->id = 11;
        $tmp->name = 'hoge11';
        $data[] = $tmp;

        $tmp = new \StdClass;
        $tmp->parent_id = 1;
        $tmp->id = 12;
        $tmp->name = 'hoge12';
        $data[] = $tmp;

        return $data;
    }
    protected function getData3()
    {
        $data = [];
        $tmp = new \StdClass;
        $tmp->parent_id = 11;
        $tmp->id = 111;
        $tmp->name = 'hoge111';
        $data[] = $tmp;

        $tmp = new \StdClass;
        $tmp->parent_id = 12;
        $tmp->id = 121;
        $tmp->name = 'hoge121';
        $data[] = $tmp;

        return $data;
    }
}
