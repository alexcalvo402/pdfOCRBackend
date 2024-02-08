<?php
class BaseModel {
    protected $dataFilePath;
    protected $modelName;

    public function __construct($dataFilePath, $modelName) {
        $this->dataFilePath = $dataFilePath;
        $this->modelName = $modelName;
    }

    protected function readData() {
        $jsonData = file_get_contents($this->dataFilePath);
        $data = json_decode($jsonData, true) ?: [];
        return isset($data[$this->modelName]) ? $data[$this->modelName] : [];
    }

    protected function writeData($data) {
        $jsonData = file_get_contents($this->dataFilePath);
        $allData = json_decode($jsonData, true) ?: [];
        $allData[$this->modelName] = $data;
        file_put_contents($this->dataFilePath, json_encode($allData, JSON_PRETTY_PRINT));
    }
}
