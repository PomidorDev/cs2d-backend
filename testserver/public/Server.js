class Server {

    constructor(){
        this.token = 0;
    }

    async send (params = {}) {
    const query = Object.keys(params)
            .map(key => `${key}=${params[key]}`).join('&');
          
            const result = await fetch(`api/?${query}`);
            const answer = await result.json();
       return (answer.result === 'ok') ? answer.data : null;
    }

    async login(login, password) {
        if (login && password) {
            const data = await this.send({method : 'login', login, password});
            if(data)
            {this.token = data.token;
            delete data.token;}
            return data;
        }
        return null;
    }

    registration(userName, password, login){
        if((userName)&&(password)&&(login)){
        return this.send({method: 'registration', userName, password, login});
        }
    }

    async getUserByToken(token) {
        if (token) {
            const data = await this.send({method : 'getUserByToken', token});
            return data;
        }
        return null;
    }

    async getElementById(element, id) {
        if (element && id) {
            const data = await this.send({method : 'getElementById', element, id});
            return data;
        }
        return null;
    }

    convert(value, systemFrom, systemTo) {
        if (this.token && value && systemFrom && systemTo) {
            return this.send({method: 'convert', value, systemFrom, systemTo, token : this.token});    
        }
    }

    sendMessage(id , name, message){
        if(message)
        return this.send({method: 'sendMessage', id, name, message});
    }

    getMessages(hash){
        return this.send({method: 'getMessages', hash});
    }

    createMatch(ownerId, regime, map, amountPlayers){
       //console.log(ownerId + " " +  regime+ " " + map+ " " + amountPlayers);
        return this.send({method: 'createMatch', ownerId, regime, map, amountPlayers});
    }

    getInventory(userId){  
        return this.send({method : 'getInventory', userId});
    }

    setArms(weapon, userId){
        return this.send({method : 'setArms', weapon, userId});
    }

    joinToLobby(matchId, gamerId){
         return this.send({method: 'joinToLobby', matchId, gamerId});
     }

     deleteLobby(ownerId){
        return this.send({method: 'deleteLobby', ownerId}); 
    }

     getAllLobby(){
         return this.send({method: 'getAllLobby'});
     }
}