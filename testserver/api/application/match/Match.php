<?php

class Match {

    function __construct($db) {
        $this->db = $db;
    }

    function createMatch($onwerId, $regime, $map, $amountPlayers){
        return $this->db->creatMatch($onwerId, $regime, $map, $amountPlayers);
    }

    function joinToLobby($matchId, $gamerId){
        return $this->db->joinToLobby($matchId, $gamerId);
    }

    function deleteLobby($ownerId){
        return $this->db->deleteLobby($ownerId);
    }
    
    function getAllLobby(){
        return $this->db->getAllLobby();
    }
}