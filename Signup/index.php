<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title> Web Application </title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
</head>

	<body>
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
	      <!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>-->
        
        </div>
      
      </div>
    </nav>
	
	<div class="wrapper">
	<div class="container">
		<div class="col-lg-12">
		  
			<center><h2>Register Here</h2></center>
			
			<center><form id="registraion_form" class="form-horizontal" style="border:2px solid green; width:300px; height:340px;">
					
				<div class="form-group" style="padding:50px 10px 10px 10px;">
			
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-12">
				<input type="text" id="txt_username" class="form-control" placeholder="Enter Username" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-12">
				<input type="text" id="txt_email" class="form-control" placeholder="Enter Email" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-12">
				<input type="password" id="txt_password" class="form-control" placeholder="Enter Password" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 30px 5px 0px;">
				<div class="col-sm-offset-5 col-sm-4 m-t-15">
				<button type="submit" id="btn_register" class="btn btn-success">Register</button>
				</div>
				
				</div>
				<p>Already Have an Account <a href="login.php">Login Here</a></p>
				<div class="form-group">
					<div id="message" class="col-sm-offset-3 col-sm-6 m-t-15"></div>
				</div>
			
			</form>
			
		</div>
	</div>	
	</div>
	
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script>
		
		$(document).on('click','#btn_register',function(e){
			
			e.preventDefault();
			
			var username = $('#txt_username').val();
			var email 	 = $('#txt_email').val();
			var password = $('#txt_password').val();
			
			var atpos  = email.indexOf('@');
			var dotpos = email.lastIndexOf('.com');
			
			if(username == ''){ // check username not empty
				alert('please enter username !!'); 
			}
			else if(!/^[a-z A-Z]+$/.test(username)){ // check username allowed capital and small letters 
				alert('username only capital and small letters are allowed !!'); 
			}
			else if(email == ''){ //check email not empty
				alert('please enter email address !!'); 
			}
			else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){ //check valid email format
				alert('please enter valid email address !!'); 
			}
			else if(password == ''){ //check password not empty
				alert('please enter password !!'); 
			}
			else if(password.length < 6){ //check password value length six 
				alert('password must be 6 !!');
			} 
			else{			
				$.ajax({
					url: 'process.php',
					type: 'post',
					data: 
						{newusername:username, 
						 newemail:email, 
						 newpassword:password
						},
					success: function(response){
						$('#message').html(response);
					}
				});
				
				$('#registraion_form')[0].reset();
			}
		});

	</script>
	
	</body>
</html>

