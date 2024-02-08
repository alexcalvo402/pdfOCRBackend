<?php
require_once 'Router.php';

$request = explode('/', $_GET['path']);
Router::route($request);

?>