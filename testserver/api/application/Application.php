<?php
require('db/DB.php');
require('user/User.php');
require('convert/Convert.php');
require('chat/Chat.php');
require('match/Match.php');
require('inventory/Inventory.php');

class Application {
    function __construct() {
        $db = new DB();
        $this->user = new User($db);
        $this->chat = new Chat($db);
        $this->inventory = new Inventory($db);
        $this->match = new Match($db);
        $this->convertModule = new Convert();
    }

function login($params) {
    if ($params['login'] && $params['password']) {
        return $this->user->login($params['login'], $params['password']);
    };
}

function registration($params){
    return $this->user->registration($params['userName'], $params['password'], $params['login']);
}


function getUserByToken($params) {
    
    if ($params['token']) {
        return $this->user->getUserByToken($params['token']);
    };
}

function getElementById($params) {
    
    if ($params['element'] && $params['id']) {
        return $this->user->getElementById($params['element'], $params['id']);
    };
}

function convert($params) {
    $user = $this->user->getUser($params['token']);
    if ($user && $params['value'] && $params['systemFrom'] && $params['systemTo']) 
        return $this->convertModule->convertTo($params['value'] , $params['systemFrom'] , $params['systemTo']);
    
}

function sendMessage($params) {
    if ($params['message']) 
        return $this->chat->sendMessage($params['id'], $params['name'] , $params['message']);   
}


function getMessages($params) {
        return $this->chat->getMessages($params['hash']);   
}

function createMatch($params) {
    //print_r($params);
    return $this->match->createMatch($params['ownerId'], $params['regime'], $params['map'], $params['amountPlayers']);   
}
//Inventory
function setArms($params) {
    //print_r($params['weapon']);
    return $this->inventory->setArms($params['weapon'], $params['userId']);
}

function getInventory($params) {
    return $this->inventory->getInventory($params['userId']);
}

function joinToLobby($params) {
    return $this->match->joinToLobby($params['matchId'], $params['gamerId']);
}

function deleteLobby($params) {
    return $this->match->deleteLobby($params['ownerId']);
}

function getAllLobby() {
    return $this->match->getAllLobby();
}

}