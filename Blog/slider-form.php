<?php
	$to="demo@company.com";/*Your Email*/
	$subject=$_REQUEST['subject'];

	$date=date("l, F jS, Y");
	$time=date("h:i A");

	$firstName=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$phone=$_REQUEST['phone'];

	$msg="
		Message sent from landing slider form on date  $date, hour: $time.\n	
		Name: $firstName\n
		Email: $email\n	
		Phone: $phone
		";
	if($email=="") {
	echo "<div class='alert alert-danger'>
			  <a class='close' data-dismiss='alert'>×</a>
			  <strong>Warning!</strong> Please fill all the fields.
		  </div>";
	} else {
	mail($to,$subject,$msg,"From:".$email);
	echo "<div class='alert alert-success'>
			  <a class='close' data-dismiss='alert'>×</a>
			  <strong>Thank you for your message!</strong>
		  </div>";
	}
?>
