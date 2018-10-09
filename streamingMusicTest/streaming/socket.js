var mysql = require('mysql');
var mysql_options =  {
      host     : 'localhost',
      user     : 'mythtv',
      password : 'mythtv',
      database : 'mythconverg',
      connectionLimit : 100,
	multipleStatements: true,
        insecureAuth: true,
	supportBigNumbers: true,
	bigNumberStrings: true,
	dateStrings: true,
	//debug: true,
	 nestTables: '_'
    };
   var pool = mysql.createPool(
		      mysql_options
   );
const say = require('say');
//say = Say.platform('linux');
//say.getInstalledVoices(function(data){console.log(data)})
 say.speak('hello world', function(err) {
                   //    console.log(err)
                        sonus.trigger(sonus, 0, 'mythtv') //start listening
                   })

const Sonus = require('sonus')
    const speech = require('@google-cloud/speech', {
            projectId: 'arcade-voice',
            keyFilename: 'keyfile.json'
    })
//const hotwords = [{file: '/mymodel.pmdl', hotword: 'sonus'},{file: 'snowboy.umdl', hotword: 'snowboy'}]
    const hotwords = [{ file: '/home/apache/streamingMusicTest/streaming/node_modules/sonus/resources/snowboy.umdl', hotword: 'snowboy'},{file: '/home/apache/streamingMusicTest/streaming/node_modules/sonus/resources/mythtv.pmdl', hotword:'mythtv'}]
    const language = "en-US"
    const sonus = Sonus.init({ hotwords, language, recordProgram: 'arecord', device: 'hw:0,1' }, speech)

        Sonus.start(sonus)
        sonus.on('hotword', (sindex, keyword) => console.log(keyword))
        sonus.on('final-result', (data) => console.log(data))
        sonus.on('error', function(err){ console.log(err) })
        
        
      

       
   
        
        
pool.getConnection(function(dberr, connection) {

const io = require('socket.io')({
  path: '/socket.io'
}).listen(5000);

// middleware
io.use((socket, next) => {

  let token = socket.handshake.query.token;
 // if (isValid(token)) {
    return next();
  //}
 // return next(new Error('authentication error'));
});

// then
io.on('connection', (socket) => {
    
  let token = socket.handshake.query.token;
 
    
    
socket.on('command', (data) => {
console.log(data)
                   say.speak(data.cmd, function(err) {
                   //    console.log(err)
                        sonus.trigger(sonus, 0, 'mythtv') //start listening
                   })
        

});
 const http = require('http');
socket.on('load', function(data){
   
    console.log(data);
    if(!data){
        return;
        }
    if(!data.cmd){
        return;
    }
          //try{
            for(i=0;i<data.cmd.length-1;i++){
               var cmd = data.cmd[i].replace(/server /ig, '');
               
                var patt = new RegExp(/server/ig);
                if(data.cmd[i].match(patt)){
                console.log('test' + cmd)

                        console.log(cmd);
                                        
                                    const request = require('request');
                        switch(cmd){
                            case('play music'):
                                cmd= 'jump playmusic';
                            break;
                            case(cmd.match(/song/ig)):
                                cmd = 'jump play music track ' + cmd.replace(/song/ig, '');
                            break;    
                            
                            
                        }
                        if(cmd == 'Escape'){
                            cmd = 'end';
                        }
                        if(cmd == 'Backspace'){
                            cmd = 'end';
                        }
                        if(cmd.match(/volume/ig)){
                                cmd = 'volume ' + cmd.split('volume ')[1];
                        }
                        console.log('http://127.0.0.1/remote_post.php?cmd=' + cmd.replace(/\s/ig, '%20'));
                        request.get('http://127.0.0.1/remote_post.php?cmd=' + cmd.replace(/\s/ig, '%20'), { json: false }, (err, res, body) => {
                        if (err) { return console.log(err); }
                        console.log(body.url);
                        console.log(body.explanation);
                        });
                     socket.emit('stop_microphone');
                return;
            }else{
                
                cmd = data.cmd[i].replace(/load /ig, '');
                var patt = new RegExp(/load/ig);
                if(data.cmd[i].match(patt)){
                if(cmd.length>5){
          
                    connection.query("select * from music_playlists where playlist_name like '%" + cmd + "%'", function(err, res){
                        if(err){ return; }
                        if(res.length>0 & !err){
                            console.log(res);
                            socket.emit('load playlist', {data: res[0]});
                        }else{
                            connection.query("select * from music_artists where artist_name like '%" + cmd + "%'", function(err, res){
                                if(err){ return; }
                                if(!res) { return; }
                                if(res.length>0 & !err){
                                        console.log(res);
                                        socket.emit('load artist', {data: res[0]});
                                    }else{
                                        
                                        
                                    }
                            });
                            
                        }
                    });
                
                 socket.emit('stop_microphone');
                return;
            }
         
                var patt = new RegExp(/create playlist [from]?[artist|album|genre]/ig);
                    if(data.cmd[i].match(patt)){
                    if(cmd.length>5){
            
                    if(patt2.match(/artist/ig)){
                        search = cmd.split(/artist/ig);
                        
                    }else if(patt2.match(/album/ig)){
                        search = cmd.split(/album/ig);
                        
                    }else if(patt2.match(/genre/ig)){
                        search = cmd.split(/genre/ig);
                    }
                     socket.emit('stop_microphone');
                    return;
                }
                }
                var patt = new RegExp(/artist/ig);
                 cmd = data.cmd[i].replace(/artist /ig, '');
                if(data.cmd[i].match(patt)){
                    console.log('matched');
                if(cmd.length>5){
                    console.log("select * from music_artists where artist_name like '%" + cmd + "%'")
                    connection.query("select * from music_artists where artist_name like '%" + cmd + "%'", function(err, res){
                                        if(err){ return; }
                                        if(!res) { return; }
                                        if(res.length>0 & !err){
                                                console.log(res);
                                                socket.emit('load artist', {data: res});
                                            }else{
                                                
                                                
                                            }
                                             socket.emit('stop_microphone');
                                            return;
                                    });
                }  
                 socket.emit('stop_microphone');
                return;
                }
                    var patt = new RegExp(/song/ig);
                 cmd = data.cmd[i].replace(/song /ig, '');
                 console.log(cmd);
                if(data.cmd[i].match(patt)){
               // if(cmd.length>5){
                    console.log("select * from music_songs where song_name like '%" + cmd + "%'");
                    connection.query("select * from music_songs where name like '%" + cmd + "%' order by name asc limit 5", function(err, res){
                        console.log(err)
                                        if(err){ return; }
                                        if(!res) { return; }
                                        if(res.length>0 & !err){
                                                console.log(res);
                                                socket.emit('load song', {data: res, cmd: cmd});
                                            }else{
                                                
                                                
                                            }
                                             socket.emit('stop_microphone');
                                            return;
                                    });
               // }     
                     socket.emit('stop_microphone');
                return;
                }
    }
  /*  if(data.cmd.match(/search song /ig)){
        
    }
    if(data.cmd.match(/play local /ig)){
        
    }
    if(data.cmd.match(/play on server /ig)){
        
    }
    if(data.cmd.match(/load on server /ig)){
        
    }
    */
            }
    }
  //}catch(err){}
});
socket.on('disconnect', (reason) => {
  if (reason === 'io server disconnect') {
    // the disconnection was initiated by the server, you need to reconnect manually
    socket.connect();
  }
  // else the socket will automatically try to reconnect
});
  if (dberr) {
    console.error('error connecting: ' + dberr.stack);
    return;
  }  
});
});
