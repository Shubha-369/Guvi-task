<?php

require_once "dbconfig.php";

if(isset($_POST["newemail"]) && isset($_POST["newpassword"]))
{	
	$email = $_POST["newemail"];

	$password = $_POST["newpassword"];
	
	try
		{	
			$statement = $db->prepare("SELECT * FROM tbl_user WHERE email=:email");
			$statement->execute(array(":email"=>$email));
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$count = $statement->rowCount();
			
			if($row['password']==$password){
				
				
				//$_SESSION['user_session'] = $row['id'];
				
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
						$this->redis->connect('127.0.0.1', 6379); // connect redis
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
						return '';
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

$_SESSION['user_session'] = $row['id'];

//session Ends Here
			}
			else{
				echo "Email or password does not exist."; // wrong details 
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
}

?>
