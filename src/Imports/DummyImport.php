<?php
namespace Sonar\Common\Imports;

class DummyImport extends AbstractImport
{
    use CsvReaderTrait;
    private $tmp;

    public function csvRecord($tmp)
    {
        $this->tmp = $tmp;
    }
    public function setName($model, $key, $csv, $col)
    {
        $model->$key = $csv[$col-1];
    }
}



