window.onload = function(){
    const server = new Server;
    var getLobby = false;
    var user;
    var chatOld =  [];
    var lobbyOld = [];
    var chatHash = 0;
    //var userId = 128;
    //make( "", "none");

    async function logout(){
     user = null;
     chatOld =  [];
     lobbyOld = [];
     chatHash = 0;
     server.token = null;
     //console.log(123);
    }


    async function login(){
        const login = document.getElementById('login').value;
        const password = document.getElementById('password').value;
        const data = await server.login(login, password );
              user = await server.getUserByToken(server.token);
        
        if(user)
        {console.log(user);}
        //makeConvert(data.name);}
        else 
        alert("Неверный логин или пароль");
    }

  
 async function sendMessage(){
  if(user){
        var message = document.getElementById('mesagge').value;
        document.getElementById('mesagge').value = "";
        data =  await server.sendMessage(user.id,user.name, message);
        chatHash = data.hasn;}
 }

  async function getMessages(){
    if(user){
        data = await server.getMessages(chatHash);
        if(data){
        chat =  data.messages;

        for(i = chatOld.length; i<chat.length;i++)
         console.log(chat[i].userName,": ",chat[i].message)

        chatOld = chat;   
        chatHash =  data.hash;
        }
      }
  }
//setInterval(getMessages, 100);

async function registration(){
  var userName = document.getElementById('regName').value;
  var login = document.getElementById('regLogin').value;
  var password = document.getElementById('regPassword').value;
  var password2 = document.getElementById('regPassword2').value;
  
  if(password == password2)
      { data = await server.registration(userName, password, login);
       alert(userName + ", вы успешно зарегестрированы!");}
  else
  alert("пароли не совпадают"); 
  }

  async function сreateMatch(){
    user = await server.getUserByToken(server.token);
    var ownerId = user.id ;
    var regime = document.getElementById('regime').value;
    var map = document.getElementById('map').value;
    var maxAmountPlayers = document.getElementById('maxAmountPlayers').value;
    data = await server.createMatch(ownerId, regime, map, maxAmountPlayers);
  }

  async function setArms(){
    weapon = document.getElementById('armListener').value;
    data = await server.setArms(weapon, 128);
    console.log(data);
  }

  async function getInventory(){   
    data = await server.getInventory(userId);
    console.log(data.id); 
  }
  
  async function joinToLobby(){
    if(server.token)
    {
    matchId = 10;
    user = await server.getUserByToken(server.token);
    data = await server.joinToLobby(matchId, user.id);
console.log(data);
    for(i = 0; i<data.length; i++)
    {host = await server.getElementById("users", data[i].gamerId);
    console.log(host.name);}
    }
  }

  async function deleteLobby(){
    user = await server.getUserByToken(server.token);
    console.log(user.id);
    ownerId = user.id;
    data = await server.deleteLobby(ownerId);
  }
  
  async function createLobby(){
    // переход на страницу createMatch
  }

  async function getAllLobby(){
    if(server.token){
      if(getLobby)
      {
      data = await server.getAllLobby();
      if(data){
      lobby =  data;
        
      for(i = lobbyOld.length; i<lobby.length; i++)
      {
       host = await server.getElementById("users", lobby[i].ownerId);
       console.log(host.name + "  " +lobby[i].amountPlayers+"/"+lobby[i].maxAmountPlayers );}
     
      lobbyOld = lobby;
      }
      }
    }
  }
  setInterval(getAllLobby, 1000);

  function exitToMenu(){
    getLobby = false;
  }

  function newGame(){
    getLobby = true;
  }

  function startMatch(){
    console.log("Match is starting...");
  }

  function leaveLobby(){
   getAllLobby();
  }



    document.getElementById('newGame').addEventListener('click', newGame);
    document.getElementById('exitToMenu').addEventListener('click', exitToMenu);

    document.getElementById('10').addEventListener('click', joinToLobby); 
    document.getElementById('deleteLobby').addEventListener('click', deleteLobby );
    document.getElementById('createLobby').addEventListener('click', createLobby);
    document.getElementById('leaveLobby').addEventListener('click', leaveLobby);
    
    document.getElementById('startMatch').addEventListener('click', startMatch);

    document.getElementById('createMatch').addEventListener('click', сreateMatch);
    


    document.getElementById('sendmesagge').addEventListener('click', sendMessage );
    document.getElementById('enter').addEventListener('click', login );
    document.getElementById('exit').addEventListener('click', logout );
    document.getElementById('reg').addEventListener('click', registration);
    document.getElementById('getInventory').addEventListener('click', getInventory );
    document.getElementById('sendArm').addEventListener('click', setArms );
    //document.getElementById('exit').addEventListener('click', makeAvtor );   
    //document.getElementById('sendConvert').addEventListener('click', sendConvertHandler );
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


    
    /*
     async function sendConvertHandler() {
        const number = document.getElementById('number').value;
        const login = document.getElementById('out').value;
        const password = document.getElementById('inn').value;
        const data = await server.convert(number, login, password);
        document.getElementById("res").innerHTML = data ;
    }
    
    function make(a, b){
        document.getElementById('avtor').style.display = `${a}`; 
      document.getElementById('login').style.display = `${a}`;  
      document.getElementById('password').style.display = `${a}`;   
      document.getElementById('enter').style.display = `${a}`; 

      document.getElementById('num').style.display = `${b}`;
      document.getElementById('number').style.display = `${b}`;  
      document.getElementById('o').style.display = `${b}`; 
      document.getElementById('out').style.display = `${b}`; 
      document.getElementById('i').style.display = `${b}`;
      document.getElementById('inn').style.display = `${b}`;  
      document.getElementById('sendConvert').style.display = `${b}`;  
      document.getElementById('exit').style.display = `${b}`;
      document.getElementById('res').style.display = `${b}`; 
      document.getElementById('ch').style.display = `${b}`; 
      document.getElementById('chat').style.display = `${b}`; 
      document.getElementById('mesagge').style.display = `${b}`;  
      document.getElementById('sendmesagge').style.display = `${b}`;  
    }

    function makeConvert(name){
      
      var p = document.createElement("p"); p.innerHTML = `Здравствуйте, ${name},  перевод в римские цифры и обратно через "rim"`; p.id = "p";
      document.body.prepend(p);
      make("none", "");
      document.getElementById('sendConvert').addEventListener('click', sendConvertHandler );
    }

    function makeAvtor(){
        document.getElementById('p').style.display = "none";
        document.getElementById('login').value = "";
        document.getElementById('password').value = "";
        document.getElementById('res').innerHTML = "";
        make("", "none");
      }
    */
  
  }
