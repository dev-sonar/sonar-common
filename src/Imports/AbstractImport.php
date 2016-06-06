<?php
namespace Sonar\Common\Imports;

use Symfony\Component\Yaml\Yaml;
use Illuminate\Filesystem\Filesystem;

abstract class AbstractImport
{
    protected $config;
    private $filesystem;

    public function __construct(Filesystem $filesystem = null)
    {
        $this->config = [];
        $this->filesystem = $filesystem ? $filesystem : new Filesystem;
    }

    public function setConfig($config_file, $is_force = false)
    {
        $config = Yaml::parse($config_file);
        if (is_array($config) === false || $is_force) {
            $config = Yaml::parse($this->filesystem->get($config_file));
        }
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setModels($models, $csv)
    {
        foreach ($models as $table => $model) {
            if (is_array($model) == false ) {
                continue;
            }
            $total = count($model);
            for ($i = 0; $i < $total; $i++) {
                if (isset($this->config[$table][$i])) {
                    $this->setModel($model[$i], $this->config[$table][$i], $csv, $table);
                } else {
                    throw new \Exception('設定ファイルが正しくないか、構成が異なっています。table=' . $table);
                }
            }
        }
        return true;
    }

    public function setModel($model, $config, $csv, $table)
    {
        foreach ($config as $key => $rec) {
            $col = $this->getCsvCol($rec);
            $func = ( isset($rec['func']) === true && $rec['func'] ) ? $rec['func'] : null; 
            if (method_exists($this, $func) === true) {
                $this->$func($model, $key, $csv, $col);
            } elseif ( $func && method_exists($this, $func) === false) {
                throw new \Exception(get_class($this) . 'に関数＝' . $func . 'が実装されていません。(table=' . $table . ')');
            } elseif (isset($rec['csv']) === true && isset($csv[$col]) === true) {
                $model->$key = $csv[$col];
            } else {
                $model->$key = null;
            }
        }
        $model->save();
    }

    private function getCsvCol($rec)
    {
        $col = isset($rec['csv']) ? $rec['csv'] : null;
        if (strpos($col, ",") !== false) {
            $col = explode(",", $col);
        } elseif ( is_numeric($col) === true ) {
            $col = ($col + 0 ) -1;
        } 
        return $col;
    }

}


