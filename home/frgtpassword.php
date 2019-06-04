<?php
#debug
ini_set("display_errors", 1);

# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

#check we have username post var
if(isset($_POST["forget_email"])){
          
    	#check username in db
    	$Result  = DBi::$conn->prepare("SELECT `CustomerID`,`CustomerLoginID`,`CustomerPASSWORD` 
				  	FROM   `tblCustomer` 
				  	WHERE  `CustomerLoginID`= ? ");
	 	
	# bind results as mysqlnd driver is not istalled
        $Result->bind_param("s",$_POST['forget_email']);

        # execute
        $Result->execute();

	# store result
        $Result->store_result();

        # bind and set session
        if ($Result->num_rows == 1 ){

		# store results in vars
		$Result->bind_result($CUSTOMER_ID,$CUSTOMER_LOGIN_ID,$CUSTOMER_PASSWORD);
		
		# fetch	
		$Result->fetch(); 

		# create a new secret
        	$newsecret = md5($_POST['forget_email'].$CUSTOMER_PASSWORD);
			
		#update db
         	$Result_1 = DBi::$conn->prepare("UPDATE  	`"._DB_NAME."`.`tblCustomer`
                			          SET 			       `tblCustomer`.`CustomerSECRET`  = ?
                         			  WHERE 		       `tblCustomer`.`CustomerLoginID` = ? ");

		# bind results as mysqlnd driver is not istalled
       		$Result_1->bind_param("ss",$newsecret,$_POST['forget_email']);
	
		# execute update
		$Result_1->execute();
		
		# Your subject
		$subject ="Please reset your password";

		# From
		$header ="from: admin <admin@http://warranty.rodriguezwdh.com>";

		# Your message
		$message = "<html><head></head><body>";
		$message ="<img src='http://www.pdwatersystems.com/images/Logo.jpg' alt='Forget Password' />'</body></html>";
		$message =" Password Reset\r\n";
		$message.="Click on this link to reset your Account Password: \r\n";
		$message.="http://warranty.rodriguezwdh.com/home/resetpassword.php?newpass=$newsecret";

		# send email
		$sentmail = mail($CUSTOMER_LOGIN_ID,$subject,$message,$header);
		header("location: Login.php?SuccessMsg=".urlencode("Please check your inbox for password reset email."));
	} else {	
		header("location: Login.php?ErrorMsg=".urlencode("Username does not exit. Please create a account or try again."));
	}
}else{
	
	# redirect to login
	header("location: login.php");
}
?>
