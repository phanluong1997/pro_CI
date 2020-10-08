//creating express instance
var express = require("express");
var app = express();
const fs = require('fs');
const sharp = require('sharp');
const resize = require('./resize');
//upload file
var SocketIOFileUpload = require('socketio-file-upload');
app.use(SocketIOFileUpload.router)

//creating http instance
var http = require("http").createServer(app);

//creating socket io instance
var io = require("socket.io")(http);

//create body parser instance
var bodyParser = require("body-parser");

//enable URL encoded for POST requests
app.use(bodyParser.urlencoded());

//Create instance of mysql
var mysql = require("mysql");

//make a connection
var connection = mysql.createConnection({
	"host": "localhost",
	"user": "root",
	"password": "",
	"database": "2020_mt7"

});

//connect
connection.connect(function(error){
	// show error if any
});

//enable headers required for POST request
app.use(function(request, result, next){
	result.setHeader("Access-Control-Allow-Origin", "*");
	next();
})

//create APT to return all message
app.get("/get_messages", function(request, result){
	//get all message from database
	connection.query("SELECT * FROM tbl_chatting ORDER BY id ASC LIMIT 100", function(error, messages) {
		result.end(JSON.stringify(messages));
	});
});


app.get('/main', function(req, res) {
    fs.readFile('./home.html', function(error, content) {
        if (error) {
            res.writeHead(500);
            res.end();
        }
        else {
            res.writeHead(200, { 'Content-Type': 'text/html' });
            res.end(content, 'utf-8');
        }
    });

});


io.on("connection", function(socket){
	console.log("User connected:", socket.id);

	// Make an instance of SocketIOFileUpload and listen on this socket:
    var uploader = new SocketIOFileUpload();
    uploader.dir = "upload/chatting";
   	uploader.maxFileSize = 10* 1024 * 1024;
    
    uploader.listen(socket);

	uploader.on("start", function(event){
		if (/\.jpg$/.test(event.file.name) || /\.png$/.test(event.file.name) || /\.jpeg$/.test(event.file.name)) {
			
		}else{
			console.log("Aborting: " + event.file.id);
			uploader.abort(event.file.id, socket);
			socket.emit("sever_sendErrorImage","Only upload images .jpg, .png, .jpeg");
			console.log('Only upload images .jpg, .png, .jpeg');
		}
	});

	uploader.on("error", function(data){
		console.log("Error: "+data.memo);
		console.log(data);
	});

	uploader.on("saved", function(event){
		// console.log(uploader);
		// console.log(event.file);
		event.file.clientDetail.base = event.file.base;
	});

	//listen from client
	socket.on("user_sendMessage", function(data){
		//save in database
		connection.query("INSERT INTO tbl_chatting (userID, fullname, message) VALUES ('" + data.userID + "', '" + data.fullname + "', '" + data.message + "')", function(error, result) {
			//send message for client
			io.emit("sever_sendMessage",{id:result.insertId,message:data.message,fullname:data.fullname,userID:data.userID});
		});
	});

	//listen from client (send image)
	socket.on("user_sendImage", function(data){

		//send message for client
		var domain = 'http://localhost:3000/';
		var resizeimg ='resizeimg?image='+data.image+'&width=250&height=250';
		var image =  domain + resizeimg;

		//save in database
		connection.query("INSERT INTO tbl_chatting (userID, fullname, image, link) VALUES ('" + data.userID + "', '" + data.fullname + "', '" + image + "', '" + data.image + "')", function(error, result) {
			io.emit("sever_sendMessage",{id:result.insertId, message:'',image:image,fullname:data.fullname,userID:data.userID});
		});
	});

	//listen from client (admin_deleteMessageUser)
	socket.on("user_sendDeleteMessageUser", function(data){
		//delete image in folder
		// console.log(data.id)
		connection.query("SELECT * FROM tbl_chatting WHERE id = '" + data.id + "' ", function(error, result, fields) {
			console.log('This is result: '+result[0].link)
			if(result[0].link != ''){
				fs.unlink('upload/chatting/'+result[0].link, function (err) {
				  if (err) throw err;
				});
			}
		});
		
		//delete in dataabase
		connection.query("DELETE FROM `tbl_chatting` WHERE id = '" + data.id + "' ", function(error, result) {
			io.emit("sever_sendDeleteMessageUser",data.id);
		});
	});
});

app.get('/resizeimg', (req, res) => {
	const image = req.query.image
	const widthStr = req.query.width
	const heightStr = req.query.height
	const format = req.query.format
	let width, height
	if (widthStr) {
		width = parseInt(widthStr)
	}
	if (heightStr) {
		height = parseInt(heightStr)
	}
	res.type(`image/${ format || 'png' }`)
	resize('upload/chatting/'+image, format, width, height).pipe(res)
});

//start the server
http.listen(3000, function(){
	console.log("server started - port : 3000");
});

