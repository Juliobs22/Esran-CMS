<?php
    require 'BaseController.php';
    require 'ApiController.php';
    require_once __DIR__ .'/../inc/bootstrap.php';

    /*$baseController = new BaseController();
    $baseController->getUriSegmennts();
    echo '<br/>'.json_encode($baseController->getUriParams());
    $apiController = new APIController($_SERVER['REQUEST_METHOD']);**/
    $apiController = new ApiController($_SERVER['REQUEST_METHOD']);
    $uri = $apiController->getUriSegmennts();
    $apiController->{$uri[4].'Action'}();
?>