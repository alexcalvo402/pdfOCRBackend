<?php
class BaseController {
    public function sendResponse($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function methodNotAllowed() {
        http_response_code(405);
        $this->sendResponse(['error' => 'Method Not Allowed']);
    }

    public function optionsAllowed() {
        http_response_code(200);
        $this->sendResponse(['success'=> 'OPTIONS METHOD Allowed']);
    }

    public function errorNotFound() {
        http_response_code(404);
        $this->sendResponse(['error'=> 'NOT FOUND']);
    }
}
