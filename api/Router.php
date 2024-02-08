<?php
class Router {
    public static function route($request) {
        $resource = $request[0] ?? null;
        $id = $request[1] ?? null;

        switch ($resource) {
            case 'persona':
                require_once 'controllers/PersonaController.php';
                $controller = new PersonaController('data/models.json');
                break;
            /*case 'other_model':
                require_once 'controllers/OtherModelController.php';
                $controller = new OtherModelController('data/models.json');
                break;*/
            default:
                $controller = new BaseController();
                $controller->errorNotFound();
                return;
        }

        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $id ? $controller->get($id) : $controller->getAll();
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                $controller->create($data);
                break;
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                $id ? $controller->update($id, $data) : $controller->methodNotAllowed();
                break;
            case 'DELETE':
                $id ? $controller->delete($id) : $controller->methodNotAllowed();
                break;
            case 'OPTIONS':
                $controller->optionsAllowed();
                break;
            default:
                $controller->methodNotAllowed();
                break;
        }
    }
}
