<?php
//header("Access-Control-Allow-Origin: *");
error_reporting(-1);

require('application/Application.php');

 function router ($params) {
    $method = $params['method'];
    
    if ($method) {
        $app = new Application();
        switch ($method) {
            case 'login' :  { return $app->login($params);}
            case 'getUserByToken' :  return $app->getUserByToken($params);
            case 'getElementById' :  return $app->getElementById($params); 
            case 'convert' : return $app->convert($params);
            case 'sendMessage' : return $app->sendMessage($params);
            case 'getMessages' : return $app->getMessages($params);
            case 'registration' : return $app->registration($params);
            //Lobby
            case 'createMatch' : return $app->createMatch($params);
            case 'joinToLobby' : return $app->joinToLobby($params);
            case 'getAllLobby' : return $app->getAllLobby();
            case 'deleteLobby' : return $app->deleteLobby($params);
            //inventory
            case 'getInventory' : return $app->getInventory($params);
            case 'setArms' : return $app->setArms($params);
        }
    }
}

 function  answer($data) {
    //print_r($data);
    if ($data) {
        return array (
            'result' => 'ok',
            'data' => $data
        );
    }
    return array('result' => 'error');
}

echo json_encode(answer(router($_GET)));

