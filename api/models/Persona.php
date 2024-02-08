<?php
require_once 'models/BaseModel.php';

class Persona extends BaseModel {
    public function __construct($dataFilePath) {
        parent::__construct($dataFilePath, 'persones');
    }

    public function getAll() {
        return $this->readData();
    }

    public function get($id) {
        $data = $this->readData();
        return isset($data[$id]) ? $data[$id] : null;
    }

    public function create($data) {

        if (!$data || !isset($data['nom']) || !isset($data['habitatge']) || !isset($data['tipus'])) {
            return ['error' => 'Invalid JSON data or missing required fields'];
        }

        $id = uniqid();
        $data['id'] = $id;

        $existingData = $this->readData();
        $existingData[$id] = $data;
        $this->writeData($existingData);

        return ['message' => 'Persona created', 'data' => $data];
    }

    public function update($id, $data) {

        if (!$data || !isset($data['nom']) || !isset($data['habitatge']) || !isset($data['tipus'])) {
            return ['error' => 'Invalid JSON data or missing required fields'];
        }

        $existingData = $this->readData();

        if (isset($existingData[$id])) {
            $existingData[$id] = array_merge($existingData[$id], $data);
            $this->writeData($existingData);
            return ['message' => 'Persona updated', 'data' => $existingData[$id]];
        } else {
            return ['error' => 'Persona not found'];
        }
    }

    public function delete($id) {
        $existingData = $this->readData();

        if (isset($existingData[$id])) {
            $deleted = $existingData[$id];
            unset($existingData[$id]);
            $this->writeData($existingData);
            return ['message' => 'Persona deleted', 'data' => $deleted];
        } else {
            return ['error' => 'Persona not found'];
        }
    }
}
