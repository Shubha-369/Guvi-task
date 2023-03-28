<?php

require_once "dbconfig.php";

if(isset($_POST["newusername"]) && isset($_POST["newemail"]) && isset($_POST["newpassword"]))
{	
	$id = $_POST["newid"];
	
	$username = $_POST["newusername"];

	$email = $_POST["newemail"];

	$password = $_POST["newpassword"];
	
	$phone = $_POST["newphone"];
	
	$dob = $_POST["newdob"];
	
	$address = $_POST["newaddress"];
	
	$stmt=$db->prepare("UPDATE tbl_user set username=:uname,email=:uemail,password=:upassword, Phonenumber=:phone, DOB=:dob, Address=:address where id=:uid"); 
	
	$stmt->bindParam(":uid",$id);	
	$stmt->bindParam(":uname",$username);
	$stmt->bindParam(":uemail",$email);
	$stmt->bindParam(":upassword",$password);
	$stmt->bindParam(":phone",$phone);
	$stmt->bindParam(":dob",$dob);
	$stmt->bindParam(":address",$address);
	
		 		
	if($stmt->execute())
	{
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
					updated Successfully 
			 </div>';	
	   
	}	
	else
	{
		echo  '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
					Fail to Update  
			   </div>';		
	}
}

?>
