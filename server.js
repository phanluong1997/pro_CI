//creating express instance
var express = require("express");
var app = express();

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
app.post("/get_messages", function(request, result){
	//get all message from database
	connection.query("SELECT * FROM tbl_chatting ORDER BY id ASC LIMIT 100", function(error, messages) {
		//response will be in JSON
		result.end(JSON.stringify(messages));
	});
});

io.on("connection", function(socket){
	console.log("User connected:", socket.id);

	//listen from client
	socket.on("user_sendMessage", function(data){
		//send message for client
		io.emit("sever_sendMessage",{message:data.message,fullname:data.fullname,userID:data.userID});

		//save in database
		connection.query("INSERT INTO tbl_chatting (userID, fullname, message) VALUES ('" + data.userID + "', '" + data.fullname + "', '" + data.message + "')", function(error, result) {

		});
	});
});


//start the server
http.listen(3000, function(){
	console.log("server started - port : 3000");
});