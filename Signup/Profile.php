<?php

// Redis Session Starts Here
				class SessionManager
				{

					private $redis;
					private $sessionSavePath;
					private $sessionName;
					private $session_expiretime = 60;

					public function __construct()
					{
						$this->redis = new Redis();// Create phpredis instance
						$this->redis->connect("127.0.0.1", 6379); // connect redis
						$this->redis->auth("secretpass123"); // authorization
						session_set_save_handler(
						array($this, "open"),
						array($this, "close"),
						array($this, "read"),
						array($this, "write"),
						array($this, "destroy"),
						array($this, "gc")
					);
					if (!isset($_SESSION)) session_start();
				}

				public function open($path, $name)
				{
					return true;
				}

				public function close()
				{
					return true;
				}

				public function read($id)
				{
					$value = $this->redis->get($id); // Get the specified record in redis
					if ($value) {
					return $value;
				} else {
						return "";
						}
				}

				public function write($id, $data)
				{

				if ($this->redis->set($id, $data)) {
				// stored with session ID as the key
				$this->redis->expire($id, $this->session_expiretime); // Set the expiration time of data in redis, that is, session expiration time
				return true;
				}

				return false;
				}

				public function destroy($id)
				{
				if ($this->redis->delete($id)) {// delete the specified record in redis
				return true;
				}
				return false;
				}

				public function gc($maxlifetime)
				{
				return true;
				}

				public function __destruct()
				{
				session_write_close();
				}
				}


$handler = new SessionManager();

$session = $_SESSION["user_session"];
// fetch query
if($session!=""){
require_once "dbconfig.php";

 			$statement = $db->prepare("SELECT * FROM tbl_user WHERE id=:uid");
			$statement->execute(array(":uid"=>$_SESSION["user_session"]));
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$count = $statement->rowCount();

?>
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
		  
			<center><h2>Profile Update</h2></center>
			<p style="text-align:right"><a href ="login.php">Logout</a></p>
		<center><form id="registraion_form" class="form-horizontal">
			
				<div class="form-group" style="padding:30px 10px 10px 10px;">
			
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
<input type="hidden" id="txt_id" class="form-control" value="<?php echo $row["id"]; ?>" />
				</div>
				</div>
					
				<div class="form-group" style="padding:0px 10px 10px 10px;">
			
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
<input type="text" id="txt_username" class="form-control" value="<?php echo $row["username"]; ?>" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
				<input type="text" id="txt_email" class="form-control" value="<?php echo $row["email"]; ?>" />
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
				<input type="password" id="txt_password" class="form-control" value="<?php echo $row["password"]; ?>" />
				</div>
				</div>
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
				<input type="text" id="txt_phone" class="form-control" placeholder="Enter Phone Number" />
				</div>
				</div>
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
				<input type="text" id="txt_dob" class="form-control" placeholder="Enter Date of Birth" />
				</div>
				</div>
				<div class="form-group" style="padding:0px 10px 10px 10px;">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
				<textarea id="txt_address" class="form-control" rows="5" cols="5" placeholder="Enter Address" /></textarea>
				</div>
				</div>
				
				<div class="form-group" style="padding:0px 100px 5px 0px;">
				<div class="col-sm-offset-5 col-sm-4 m-t-15">
				<button type="submit" id="btn_register" class="btn btn-success">Update</button>
				</div>
				</div>
				
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
			var id = $('#txt_id').val();
			var phone = $('#txt_phone').val();
			var dob = $('#txt_dob').val();
			var address = $('#txt_address').val();
			
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
			else if(phone == '')
			{ alert('please enter phone number !!');}
		    else if(dob == '')
			{alert('please enter date of birth');}
			else if(address == '')
			{ alert('please enter address');}
			else{			
				$.ajax({
					url: 'profilevalidation.php',
					type: 'post',
					data: 
						{newid:id,
						 newusername:username, 
						 newemail:email, 
						 newpassword:password,
						 newphone:phone,
						 newdob:dob,
						 newaddress:address
						},
					success: function(response){
						$('#message').html(response);
					}
				});
				
				$('#registraion_form')[0].reset();
			}
		});

	</script>
<?php } else{ echo "login again";} ?>

	</body>
</html>
