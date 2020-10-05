<div class="topsidebar"></div>
<div  class="content">
	<!-- Items about message of someone! -->
	<div class="contain-itemchat">
		<div class="itemchat" id="showMessages">
		  
		</div>
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
		      </div>
		      <div class="timeMessage">11:30</div>
		    </div>
		    <div class="icon-hover" id="TagName2"><i class="fas fa-at"></i><i class="fas fa-user-plus"></i></div>
		  </div>
		  <div style="clear:both"></div>
		</div> -->
		<!-- <div class="itemchat">
		  <div class="head">
		    <div class="avatar" style="background-image: url(public/images/avatar03.jpg)"></div>
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
		      <div id="usernameMess" class="name">David Low</div>
		    </a>
		    <div class="message">
		      <div class="boxMessage">
		        Hello everybody!!! <br> We sould follow me. I will show everyone how to win the game. Hurry
		        up, hurry upppp
		      </div>
		      <div class="timeMessage">11:48</div>
		    </div>
		    <div class="icon-hover" id="TagName" ><i class="fas fa-at"></i><i class="fas fa-user-plus"></i></div>
		  </div>
		  <div style="clear:both"></div>
		</div> -->
	</div>
</div>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>
	var io = io("http://localhost:3000");
	//get API message in database - OT1
	$(document).ready(function(){
		$.ajax({
			url:"http://localhost:3000/get_messages",
			method: "POST",
			success: function(response){
				console.log(response);
				var messages = JSON.parse(response);
				var html = '';

				for (var a = 0; a < messages.length; a++ ){
					 html += '<div class="itemchat"><div class="head"><div class="avatar" style="background-image: url(public/images/avatar01.jpg)"></div><div class="level"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></div></div><div class="contentMessage"><a href="#"><div id="usernameMess" class="name">' + messages[a].fullname + '</div></a><div class="message"><div class="boxMessage" >' + messages[a].message + '</div><div class="timeMessage">10:53</div></div><div class="icon-hover" id="TagName" tagFullname = "'+ messages[a].fullname +'"><i class="fas fa-at"></i></div></div><div style="clear:both"></div></div>';
				}
				document.getElementById("showMessages").innerHTML =document.getElementById("showMessages").innerHTML + html;

			}
		});
	});	
	//send message to server - OT1
	function sendMessage()
	{
		//get message
		var message = $("#userMessage").val();
		var fullname = $("#fullname").val();
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
		var html = '<div class="itemchat"><div class="head"><div class="avatar" style="background-image: url(public/images/avatar01.jpg)"></div><div class="level"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></div></div><div class="contentMessage"><a href="#"><div id="usernameMess" class="name">' + data.fullname + '</div></a><div class="message"><div class="boxMessage" >' + data.message + '</div><div class="timeMessage">10:53</div></div><div class="icon-hover" id="TagName" tagFullname = "'+ data.fullname +'"><i class="fas fa-at"></i></div></div><div style="clear:both"></div></div>';

		document.getElementById("showMessages").innerHTML =   document.getElementById("showMessages").innerHTML + html;
	});
</script>
<!-- Box about button, icon, gif in the bottom sidebar-->
<div class="boxInput">
	<form onsubmit="return sendMessage();" autocomplete="off" >
		<div class="sendInput">
			<input type="text" id="userMessage" autofocus placeholder="Your Message" class="typeMessage">
			<input type="text" id="fullname" hidden value="<?php echo $datas['fullname'] ?>" >
			<input type="text" id="userID" hidden value="<?php echo $datas['id'] ?>" >
		</div>
		<div class="boxControl">
			<div class="btnTag"><img src="public/images/imgTag.svg"></div>
			<div class="btnGIF"><button>GIF</button></div>
			<div class="btnEmoji"><img src="public/images/emoji.png"></div>
			<button type="submit" class="btnSend">
				<div class="clippy-right"></div>
			</button>
		</div>
	</form>
</div>
