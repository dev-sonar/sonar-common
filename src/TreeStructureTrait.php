<?php
namespace Sonar\Common;
use Exception;

trait TreeStructureTrait
{
    protected $tree;

    public function getTree()
    {
        return $this->tree;
    }
    public function initTree()
    {
        $this->tree = [];
    }
    public function addTreeStructure($data)
    {
        $tree = isset($this->tree) ? $this->tree : [];

        foreach ( $data as $rec ) {
            if ( is_object($rec) === false ) throw new Exception('data record must be object.');
            if ( isset($rec->id) === false ) throw new Exception('data record object does not have property => "id".');
            if ( isset($rec->parent_id) === false || ! $rec->parent_id ) {
                $rec->children = [];
                $tree[$rec->id] = $rec;
            } else {
                $this->addTree($tree,$rec);
            }
        }
        $this->tree = $tree;
    }
    protected function addTree(&$tree,$data)
    {
        foreach ( $tree as $id => &$rec ) {
            if ( $data->parent_id == $id ) {
                $data->children = [];
                $rec->children[$data->id] = $data;
                return;
            } elseif ( count($rec->children) ) {
                $this->addTree($rec->children,$data);
            }
            unset($rec);
        }
    }
    public function mergeCount($count_data)
    {
        $tree = isset($this->tree) ? $this->tree : [];
        foreach ( $tree as &$rec ) {
            foreach ( $count_data as $count ) {
                if ( isset($rec->id) === false ) throw new Exception('data record object does not have property => "id".');
                if ( isset($count->id) === false ) throw new Exception('count data record object does not have property => "id".');
                if ( isset($count->count) === false ) throw new Exception('count data record object does not have property => "count".');
                if ( $rec->id == $count->id ) {
                    $rec->count = $count->count;
                }
            }
        }
        $this->tree = $tree;
    }
}
