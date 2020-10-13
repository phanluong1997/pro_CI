<div class="topsidebar"></div>
<div  class="content">
	<!-- Items about message of someone! -->
	<div  id="showMessages">
		<!-- <div class="itemchat">
		  <div class="head">
		    <div class="avatar" style="background-image: url(public/images/avatar02.jpg)"></div>
		    <div class="level">
		      <span class="fa fa-star checked"></span>
		      <span class="fa fa-star checked"></span>
		      <span class="fa fa-star checked"></span>
		      <span class="fa fa-star checked"></span>
		      <span class="fa fa-star checked"></span>
		    </div>
		  </div>
		  <div class="contentMessage">
		    <a href="#">
		      <div id="usernameMess" class="name">Lisa</div>
		    </a>
		    <div class="message">
		      <div class="boxMessage">
		        Hello John!!!
		        <img src="upload/chatting/matsau.jpg" width="250px" alt="">
		      </div>
		      <div class="timeMessage">11:30</div>
		    </div>
		    <div class="icon-hover" id="TagName2"><i class="fas fa-at"></i><i class="fas fa-user-plus"></i></div>
		  </div>
		  <div style="clear:both"></div>
		</div> -->
	</div>
</div>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="http://localhost:3000/siofu/client.js"></script>
<script>
	var io = io("http://localhost:3000");

	const chatMessages = document.querySelector('.content');

	//get API message in database - OT1
	$(document).ready(function(){
		var adminID  = $("#adminID").val();
		$.ajax({
			url:"http://localhost:3000/get_messages",
			method: "post",
			success: function(response){
				var messages = JSON.parse(response);
				var html = '';
				for (var a = 0; a < messages.length; a++ ){
					if(adminID != null){
						var iconDelete = '<i class="fas fa-trash-alt" id="deleteMessage" idMessage = "'+ messages[a].id +'" ></i>'
					}else
					{ 
						var iconDelete = ''
					}
					html += '<div class="itemchat"><div class="head"><div class="avatar" style="background-image: url(public/images/avatar01.jpg)"></div><div class="level"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></div></div><div class="contentMessage" ><div ><div id="usernameMess" class="name">' + messages[a].fullname + '</div></div><div class="message"><div class="boxMessage" id ="message-'+ messages[a].id +'" >' + messages[a].message + '<img src="'+ messages[a].image +'"alt=""></div><div class="timeMessage">10:53</div></div><div class="icon-hover" id ="removeIcon-'+ messages[a].id +'"  ><i class="fas fa-at" id="TagName" tagFullname = "'+ messages[a].fullname +'"></i>' + iconDelete + '</div></div><div style="clear:both"></div></div>';
				}
				document.getElementById("showMessages").innerHTML =document.getElementById("showMessages").innerHTML + html;
				//scrollDonw 
				chatMessages.scrollTop = chatMessages.scrollHeight;
			}
		});
	});	
	//send message to server - OT1
	function sendMessage()
	{
		//get message
		var message = $("#userMessage").val().trim();
		var fullname = $("#fullname").val().trim();
		var userID = $("#userID").val();
		$("#userMessage").val("");
		if(userID != ''){
			if(message != ''){
				io.emit("user_sendMessage",{userID:userID,message:message,fullname:fullname});
			}else{
				return false;
			}
		}else{
			alert('You need login!')
		}

		return false;
	}
	//tag name to send message - OT1
	$(document).on("click", "#TagName",function(){
		var tagFullname = $(this).attr("tagFullname");
		var fullname = $("#fullname").val();
		if(tagFullname != fullname){
			$("#userMessage").val('@'+tagFullname+': ');
			$("#userMessage").focus();
		}else{
			$("#userMessage").val('');
			$("#userMessage").focus();
		}
	});

	//listen from server - OT1
	io.on("sever_sendMessage", function(data) {
		var adminID  = $("#adminID").val();
		if(adminID != null){
			var iconDelete = '<i class="fas fa-trash-alt" id="deleteMessage" idMessage = "'+ data.id +'" ></i>'
		}else
		{ 
			var iconDelete = ''
		}

		var html = '<div class="itemchat"><div class="head"><div class="avatar" style="background-image: url(public/images/avatar01.jpg)"></div><div class="level"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></div></div><div class="contentMessage"><div ><div id="usernameMess" class="name">' + data.fullname + '</div></div><div class="message"><div class="boxMessage" id ="message-'+ data.id +'"  >' + data.message + '<img src="'+ data.image +'" alt=""></div><div class="timeMessage">'+ data.time +'</div></div><div class="icon-hover" id ="removeIcon-'+ data.id +'"   ><i class="fas fa-at" id="TagName" tagFullname = "'+ data.fullname +'" ></i>'+ iconDelete +'</div></div><div style="clear:both"></div></div>';

		document.getElementById("showMessages").innerHTML =   document.getElementById("showMessages").innerHTML + html;
		//scrollDonw 
		chatMessages.scrollTop = chatMessages.scrollHeight;
	});

	// listen from server - OT1  Error Only upload images .jpg, .png, .jpeg
	io.on("sever_sendErrorImage", function(data) {
		alert(data);
	});

	// 'listen from server - OT1 (sever_sendDeleteMessageUser)
	io.on("sever_sendDeleteMessageUser", function(id) {
		var message = document.getElementById("message-" + id);
		var removeIcon = document.getElementById("removeIcon-" + id);
		message.innerHTML = "This message has been deleted";
		removeIcon.style.display = "none";
	});


</script>
<!-- upload images -->
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(data){
	    // Initialize instances:
	    var socket = io.connect("http://localhost:3000/");
	    var siofu = new SocketIOFileUpload(socket);
	   	// siofu.chunkSize = 1024 * 10 
		var userID = $("#userID").val();
		if(userID != ''){
			// Configure the three ways that SocketIOFileUpload can read files:
	    	document.getElementById("upload_btn").addEventListener("click",siofu.prompt, false);
		}
		// 

	    // Do something when a file is uploaded:
	    siofu.addEventListener("complete", function(event){
	    	var extensionFile = getFileExtension(event.file.name);
	    	var image = event.detail.base+'.'+extensionFile;
			var fullname = $("#fullname").val();
			var userID = $("#userID").val();
			//send image to server
			io.emit("user_sendImage",{userID:userID,image:image,fullname:fullname});
	    });
	 
	}, false);
	//getFileExtension - OT1
	function getFileExtension(filename) {
	   return filename.split('.').pop()
	}

	//admin - deleteMessage -OT1
	$(document).on("click", "#deleteMessage",function(){
		var id = $(this).attr("idMessage");
		io.emit("user_sendDeleteMessageUser",{id:id});
	});
	
</script> 
<!-- Box about button, icon, gif in the bottom sidebar-->
<div class="boxInput">
	<form onsubmit="return sendMessage();" autocomplete="off" >
		<div class="sendInput">
			<input type="text" id="userMessage" autofocus placeholder="Your Message" class="typeMessage">
			<input type="text" id="fullname" hidden value="<?php echo $datas['fullname'] ?>" >
			<input type="text" id="userID" hidden value="<?php echo $datas['id'] ?>" >
			<?php 
				if($this->Auth->check_logged() === true)
				{
					$adminID = $this->session->userdata('logged_user');
					echo '<input type="text" hidden id="adminID" value="'.$adminID.'" >';
				}
			?>
		</div>
		<div class="boxControl">
			<div class="btnTag" id="upload_btn"><img src="public/images/imgTag.svg"></div>
			<div class="btnGIF"><button>GIF</button></div>
			<div class="btnEmoji"><img src="public/images/emoji.png"></div>
			<button type="submit" class="btnSend">
				<div class="clippy-right"></div>
			</button>
		</div>
	</form>
</div>
