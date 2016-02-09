<?php
namespace Sonar\Common\Imports;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use File;

abstract class AbstractImport
{
    protected $config;

    public function __construct()
    {
        $this->config = [];
    }

    public function setConfig($config_file)
    {
        $config = Yaml::parse($config_file);
        if ( is_array($config) === false  ) {
            $config = Yaml::parse(File::get($config_file));
        }
        if ( is_array($config) ) {
            $this->config = array_merge($this->config,$config);
        }
    }
    public function getConfig()
    {
        return $this->config;
    }
    public function setModels($models,$csv)
    {
        foreach ( $models as $table => $model ) {
            if ( is_array($model) ) {
                for($i=0;$i<count($model);$i++) {
                    if ( isset($this->config[$table][$i]) ) {
                        $this->setModel($model[$i],$this->config[$table][$i],$csv,$table);
                    } else {
                        throw new \Exception('設定ファイルが正しくないか、構成が異なっています。table=' . $table);
                    }
                }
            }
        }
        return true;
    }

    public function setModel($model,$config,$csv,$table)
    {
        foreach ( $config as $key => $rec ) {
            if ( isset($rec['func']) == true && $rec['func'] ) {
                $func = $rec['func'];
                $col = isset($rec['csv']) ? $rec['csv'] : null;
                if ( strpos($col,",") !== false ) {
                    $col = explode(",",$col);
                }
                if ( method_exists($this,$func) === true ) {
                    $this->$func($model,$key,$csv,$col);
                } else {
                    throw new \Exception(get_class($this) . 'に関数＝' . $func . 'が実装されていません。');
                }
            } elseif ( isset($rec['csv']) &&  isset($csv[($rec['csv']+0)-1]) ) {
                $model->$key = $csv[($rec['csv']+0)-1];
            } else {
                $model->$key = null;
            }
        }
        $model->save();
    }

}


