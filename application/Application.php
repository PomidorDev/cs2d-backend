<?php
require('db/DB.php');
require('user/User.php');
require('convert/Convert.php');
require('chat/Chat.php');

class Application {
function __construct() {
    $db = new DB();
    $this->user = new User($db);
    $this->chat = new Chat($db);
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

}