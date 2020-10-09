//creating express instance
var express = require("express");
var app = express();
//get realtime
var moment = require('moment');


//manage file
const fs = require('fs');
//resize image
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

//make a connection to SQL
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

//create APT to return all message -OT1
app.post("/get_messages", function(request, result){
	//get all message from database
	connection.query("SELECT * FROM tbl_chatting ORDER BY id ASC LIMIT 100", function(error, messages) {
		result.end(JSON.stringify(messages));
	});
});


// connection -OT1
io.on("connection", function(socket){
	console.log("User connected:", socket.id);

	// setting upload images:
    var uploader = new SocketIOFileUpload();
    uploader.dir = "upload/chatting/";
   	uploader.maxFileSize = 10* 1024 * 1024; //10Mb
    
    uploader.listen(socket);

	uploader.on("start", function(event){
		if (/\.jpg$/.test(event.file.name) || /\.png$/.test(event.file.name) || /\.jpeg$/.test(event.file.name)) { //only images (jpg,png,jpeg)
			
		}else{
			uploader.abort(event.file.id, socket);
			socket.emit("sever_sendErrorImage","Only upload images .jpg, .png, .jpeg");
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

	//listen from client (send message) -OT1
	socket.on("user_sendMessage", function(data){
		//save in database
		if(data != ''){
			var dayTime = moment().format('Y-M-D H:mm:ss');
			var time = moment().format('H:mm'); 
			connection.query("INSERT INTO tbl_chatting (userID, fullname, message, date) VALUES ('" + data.userID + "', '" + data.fullname + "', '" + data.message + "', '" + dayTime + "')", function(error, result) {
				//send message for client
				if(result.insertId != ''){
					io.emit("sever_sendMessage",{id:result.insertId,message:data.message,fullname:data.fullname,userID:data.userID, time:time});
				}
			});
		}
	});

	//listen from client (send image) -OT1
	socket.on("user_sendImage", function(data){
		//send message for client
		var domain = 'http://localhost:3000/';
		var resizeimg ='resizeimg?image='+data.image+'&width=250&height=250';
		var image =  domain + resizeimg;
		var dayTime = moment().format('Y-M-D H:mm:ss'); 
		var time = moment().format('H:mm'); 
		//save in database
		connection.query("INSERT INTO tbl_chatting (userID, fullname, image, link, date) VALUES ('" + data.userID + "', '" + data.fullname + "', '" + image + "', '" + data.image + "', '" + dayTime + "')", function(error, result) {
			io.emit("sever_sendMessage",{id:result.insertId, message:'',image:image,fullname:data.fullname,userID:data.userID, time:time});
		});
	});

	//listen from client (admin_deleteMessageUser)
	socket.on("user_sendDeleteMessageUser", function(data){
		//delete image in folder
		connection.query("SELECT * FROM tbl_chatting WHERE id = '" + data.id + "' ", function(error, result) {
			if(result != ''){
				if(result[0].link != ''){
					fs.unlink('upload/chatting/'+result[0].link, function (err) {
					  if (err) throw err;
					});
				}
			}
		});
		//delete in dataabase
		connection.query("DELETE FROM `tbl_chatting` WHERE id = '" + data.id + "' ", function(error, result) {
			io.emit("sever_sendDeleteMessageUser",data.id);
		});
	});
});
// resizeimg -OT MAIN
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

//auto delete message + image after a period of time
var oneSeconds = 1000;
var min = oneSeconds * 60;
var hour = min * 60;
var day = hour * 24; 
setInterval(function () {
	connection.query("SELECT COUNT(id)as Count FROM tbl_chatting WHERE day(date) = '8' ", function(error, result) {
		if(result[0].Count != '' ){
			//set data lines you want to delete 
			var num_row = result[0].Count; //NOTE: (limit) must be less than (messageShow)
			var i 	  = 0;
			connection.query("SELECT * FROM tbl_chatting  WHERE day(date) = '8' ", function(error, result) {
				if(result != ''){
					for(i; i<num_row; i++){
						if(result[i].link != ''){
							fs.unlink('upload/chatting/'+result[i].link, function (err) {
							  if (err) throw err;
							});
						}
					}
				}
			});
		   	connection.query("DELETE FROM `tbl_chatting`  WHERE day(date) = '8' ", function(error, result) {
		    	console.log('Deleted '+ num_row +' values');
			});
		}
		else
		{
			console.log('No result');
		}
	});	
}, day * 1) // 1 days


//start the server
http.listen(3000, function(){
	console.log("server started - port : 3000");
});

