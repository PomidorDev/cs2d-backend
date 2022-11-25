<?php
class DB {
    function __construct()  {
        $host = 'localhost';
        $port = '3306';
        $name = 'my'; // db name
        $user = 'root'; // user name
        $pass = ''; // user password
        try {
            $this->db = new PDO(
                'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name,
                $user,
                $pass
            );
        } catch(Exception $e) { 
            print_r(" не удалось подлкючиться к БД");
            die();
        }
    }

    function __destruct() {
        $this->db = null;
    }

    private function getArray($query) {
        $count = 0;
        $stmt = $this->db->query($query);
        $result = array();
         while($row = $stmt->fetchObject()) {
            $result[] = $row;
            $count++;
        }

        /*if($count >= 5)
        {
        $query = 'DELETE FROM `message` WHERE id='.$result[0][2];
        $this->db->query($query);
        $query = 'ALTER TABLE `message` AUTO_INCREMENT = 0';
        $this->db->query($query);
        }*/

        return $result;
    }

    public function getUser($login) {
        $query = 'SELECT * FROM users WHERE login="' . $login . '"';
        return $this->db->query($query)->fetchObject();
    }

    public function getUserByToken($token) {
        $query = 'SELECT * FROM users WHERE token="' . $token . '"';
        return $this->db->query($query)->fetchObject();
    }

    public function getElementById($element, $id) {
        $query = 'SELECT * FROM ' . $element . ' WHERE id="' . $id . '"';
        //print_r($query);
       return $this->db->query($query)->fetchObject();
    }

    public function updateToken($id, $token) {
        $query = 'UPDATE users SET token="' . $token . '" WHERE id=' . $id;
        $this->db->query($query);
        return true;
    }

    public function sendMessage($userId, $name, $message){
        $query = "INSERT INTO `message`(`id`, `message`, `userName`) VALUES(" ."null".  ",'" .  $message .  "','" . $name."')";
        $this->db->query($query);
        return true;
    }

    public function getMessages() {
        $query = 'SELECT * FROM `message` ';
        return $this->getArray($query);
    }

    public function getChatHash() {
        $query = 'SELECT chat_hash FROM statuses';
        return $this->db->query($query)->fetchObject();
    }

    public function setChatHash($hash) {
        $query = 'UPDATE statuses SET chat_hash="' . $hash . '"';
        $this->db->query($query);
        return true;
    }

    public function getUsers() {
        $query = 'SELECT * FROM users';
        return $this->getArray($query);
    }

    public function registration($userName, $password, $login){
        $query = "INSERT INTO `users`(`id`, `login`, `password`, `token`, `name`)
         VALUES(" . "null" . ",'" . $login . "','" . $password . "'," . "null" . ",'" . $userName ."')";
        $this->db->query($query);
        return true;
        }

    public function getInventory($userId) {
        $query = 'SELECT `backpack` FROM `gamers` WHERE `userId` ='. $userId;
        //print_r($query);
        return $this->db->query($query)->fetchObject();
    }
    
    public function setArms($weapon,$userId) {
        $query = 'UPDATE `gamers` SET `arms`='."'".$weapon."'".' WHERE `usersId` ='. $userId;
        $this->db->query($query);
        return true;
    }

    public function creatMatch($onwerId, $regime, $map, $maxAmountPlayers) {
        switch($regime){
            case 'time': $end = 90;
        }
        $query = "INSERT INTO `matches`(`id`, `ownerId`, `amountPlayers`,`maxAmountPlayers`, `time`, `endConditional`,`status`,`timestemp`,`hash`)
         VALUES(" . "null" .  "," .  
                  $onwerId .  "," . 
                         1 .  "," .
          $maxAmountPlayers.  "," .
                         0 .  "," .
                      $end .  ",'" .       
                     "open".  "',"  . 
                        90 .  ",'"  . 
                        0  . " ')";
         //print_r($query);
        $this->db->query($query);
        return true;
    }

    public function joinToLobby($matchId, $gamerId) {
        $query = "INSERT INTO `match_gamers`(`id`, `matchId`, `gamerId`)
         VALUES(" ."null".  ",'" .  $matchId .  "','" . $gamerId.  "'" . " )";
        $this->db->query($query);

        $amountPlayers = 'SELECT `amountPlayers` FROM `matches` WHERE id='.$matchId;
        $amount= ($this->db->query($amountPlayers)->fetchObject())->amountPlayers + 1;
        $query = 'UPDATE `matches` SET `amountPlayers`=' . $amount  . ' WHERE `id` ='. $matchId;
        $this->db->query($query);

        $stmt = $this->db->query('SELECT * FROM `match_gamers` ');
        $result = array();
         while($row = $stmt->fetchObject()) {
            if($row->matchId == $matchId)
            $result[] = $row;
            $count++;
        }
        return $result; 
    }

    public function deleteLobby($ownerId){
         $matchId = 'SELECT `id` FROM `matches` WHERE ownerId='.$ownerId;
         $id = ($this->db->query($matchId)->fetchObject())->id;
         
         $query = 'DELETE FROM `matches_gamers` WHERE matchId='.$id;
         $this->db->query($query);
         return true;
     }

    public function getAllLobby(){
        $query = 'SELECT * FROM `matches` ';
        return $this->getArray($query); 
    }

}

