<?php
namespace Sonar\Common\Imports;

class DummyImport extends AbstractImport
{
    use CsvReaderTrait;

    public function csvRecord($tmp)
    {

    }
    public function setName($model,$key,$csv,$col)
    {

    }

}



