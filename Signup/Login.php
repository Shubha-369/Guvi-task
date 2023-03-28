<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title> Web Application </title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
</head>

	<body >
	
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
	<div class="container"  >
		<div class="col-lg-12">
		  
			<center><h2>Login Page</h2></center>
			 <div id="error">
        <!-- error will be shown here ! -->
        </div>
			<center><form id="registraion_form" class="form-horizontal" style="border:2px solid green; width:300px; height:300px;">
					
				<div class="form-group" style="padding:50px 10px 10px 10px;">
			
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-12">
				 <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" autofocus="autofocus" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 10px 5px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-12">
				<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
				</div>
				</div>				
						
				<div class="form-group" style="padding:0px 30px 5px 0px;">
				<div class="col-sm-offset-5 col-sm-4 m-t-15">
				 <button type="submit" class="btn btn-primary" name="btn-login" id="btn-login">Sign In</button> 
				</div>
				</div>
				
				<div class="form-group">
					<div id="message" class="col-sm-offset-3 col-sm-6 m-t-15"></div>
				</div>
			
			</form></center>
			
		</div>
	</div>	
	</div>
	
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script>
		
		$(document).on('click','#btn-login',function(e){
			
			e.preventDefault();
			
			var email 	 = $('#user_email').val();
			var password = $('#password').val();
			
			var atpos  = email.indexOf('@');
			var dotpos = email.lastIndexOf('.com');
			
			if(email == ''){ //check email not empty
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
					url: 'loginvalidation.php',
					type: 'post',
					data: 
						{
						 newemail:email, 
						 newpassword:password
						},
					success: function(response){
						window.location = "Profile.php";
					}
				});
				
				$('#registraion_form')[0].reset();
			}
		});

	</script>
	
	</body>
</html>

