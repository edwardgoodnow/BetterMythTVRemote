/** 
	app.js
	@author: @rishabhio
	@description: Implementing Simple Music Server using Express JS 
	
**/

// import the modules required in our program
// server-side

var express = require('express');
var fs = require('fs');

// initialize an express app
var app = express();

// declare public directory to be used as a store for static files
app.use('/public', express.static(__dirname + '/public'));


// make the default route to serve our static file 
app.get('/',function(req,res){
	
	return res.redirect('/public/home.html');

});

// start app on port 3003 and log the message to console

app.listen(3005,function(){
	console.log('App listening on port 3005!');
});

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

pool.getConnection(function(dberr, connection) {
    
    


  // ...



// define a route music it creates readstream to the requested file and pipes the output to response

app.get('/music', function(req,res){
 
	if(req.query.id){
            var fileId = req.query.id; 
            connection.query("select md.path, music_songs.filename, music_songs.song_id from music_songs left join music_directories md on md.directory_id=music_songs.directory_id where song_id ='" + fileId + "'  order by song_id desc limit 1", function(err, data){
               
                    var file = '/mnt/storage/music/' +  data[0].path + '/' + data[0].filename;
                    fs.exists(file,function(exists){
                        if(exists)
                        {
                            var rstream = fs.createReadStream(file);
                            rstream.pipe(res);
                        }
                        else
                        {
                            res.send("Its a 404");
                            res.end();
                        }
                    
                    });
            });
    }
});

// following is the code for downloading music files, note that the code remains same except that we add 2 headers viz
// Content-disposition and Content-Type which forces the chrome browser to force download rather than playing the media
// Note that the following is tested with google chrome and it may work differently in Mozilla and Opera based on your 
// installed plugins.

app.get('/download', function(req,res){
	var fileId = req.query.id;
	var file = __dirname + '/music/' + fileId;
	fs.exists(file,function(exists){
		if(exists)
		{
			res.setHeader('Content-disposition', 'attachment; filename=' + fileId);
			res.setHeader('Content-Type', 'application/audio/mpeg3')
			var rstream = fs.createReadStream(file);
			rstream.pipe(res);
		}
		else
		{
			res.send("Its a 404");
			res.end();
		}
	});
});



});
