<?php
require_once 'controllers/BaseController.php';
require_once 'models/Persona.php';

class PersonaController extends BaseController {
    private $personaModel;

    public function __construct($dataFilePath) {
        $this->personaModel = new Persona($dataFilePath);
    }

    public function getAll() {
        $response = $this->personaModel->getAll();
        $this->sendResponse($response);
    }

    public function get($id) {
        $response = $this->personaModel->get($id);
        $this->sendResponse($response);
    }

    public function create($jsonData) {
        $response = $this->personaModel->create($jsonData);
        $this->sendResponse($response);
    }

    public function update($id, $jsonData) {
        $response = $this->personaModel->update($id, $jsonData);
        $this->sendResponse($response);
    }

    public function delete($id) {
        $response = $this->personaModel->delete($id);
        $this->sendResponse($response);
    }
}
