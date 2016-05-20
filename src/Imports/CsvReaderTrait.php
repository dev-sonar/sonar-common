<?php
namespace Sonar\Common\Imports;

trait CsvReaderTrait
{
    abstract public function csvRecord(array $record);

    public function csvRead($file, $delimiter = ",", $envlosure = '"', $escape = "\\", $length = 1024*1024)
    {
        if (($fp = @fopen($file, "r")) !== false) {

            while (($data = fgetcsv($fp, $length, $delimiter, $envlosure, $escape)) !== false) {
                $this->csvRecord($data);
            }
            fclose($fp);
        } else {
            throw new \Exception('ファイルが開けません。file=' . $file);
        }
        return true;
    }
}

