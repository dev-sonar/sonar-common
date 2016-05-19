<?php
namespace Sonar\Common\Imports;

class DummyImport extends AbstractImport
{
    use CsvReaderTrait;

    public function csvRecord($tmp)
    {
        $this->tmp = $tmp;
    }
    public function setName($model,$key,$csv,$col)
    {
        $col = 0;
        $model->$key = $csv[$col];
    }
}



