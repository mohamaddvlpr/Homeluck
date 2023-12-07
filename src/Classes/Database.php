<?php

namespace Web\Classes;

class Database{
    private $databaseFileAddress;
    public $dataFile;

   public function __construct($FileName , $entityClass){
    $this->databaseFileAddress = './database/' . $FileName . '.json';
    $file = fopen($this->databaseFileAddress , 'r+');
    $database = fread($file , filesize($this->databaseFileAddress));
    fclose($file);

    $data = json_decode($database , true);
    $this->dataFile = array_map(function($item) use($entityClass){
        return new ($entityClass) ($item);
    } , $data);
   }

    public function setData($newData){
        $this->dataFile = $newData;

        $newData = array_map(function($item){
            return $item->toArray();
        } , $newData);

        $newData = json_encode($newData);
        $file = fopen($this->databaseFileAddress , 'w+');
        fwrite($file , $newData);
        fclose($file);

        return $newData;
    }


    public function getData(){
        return $this->dataFile;
    }
}