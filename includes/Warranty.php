 <?php
class warranty{


	/* CLAIM FORM */
	public $CUSTOMER_ID;
	public $CUSTOMER_LOGIN_ID;
	public $CUSTOMER_FIRST_NAME;
	public $CUSTOMER_LAST_NAME;
	public $CUSTOMER_FULL_NAME;
	public $CUSTOMER_EMAIL;
	public $CUSTOMER_PASSWORD ;
	public $CUSTOMER_ADDRESS;
	public $CUSTOMER_CITY;
	public $CUSTOMER_PHONE;
	public $PUMP_STATUS;
	public $PUMP_INSTALLATION;
	public $PUMP_OPERATION;
	public $PUMP_PROBLEM_DESCRIPTION;
	public $PUMP_TYPE;
	public $PUMP_SERIAL;
	public $DISTRIBUTOR;
	public $REF;
	public $PUMP_MODEL;			
	public $PUMP_STATUS_OTHER;
	public $PUMP_INSTALLATION_OTHER;
	public $PUMP_PROBLEM_DESCRIPTION_OTHER;
	public $PUMP_PROVIDER;
 	public $WARRANTY_CLAIM_ID;
	public $WARRANTY_CLAIM_STEP;	
	public $WARRANTY_CLAIM_STEP_MESSAGE;

	/*3RD PARTY */
	public $PARTY_COMPANY;
	public $PARTY_TYPE;
	public $PARTY_NAME;
	public $PARTY_FNAME;
	public $PARTY_LNAME;
	public $PARTY_PHONE;	

	/* RMA */
	public $RMA_ID;
    public $RMA_CLAIM_ID;
    public $RMA_DATE;
    public $RMA_AUTHORIZE_WORK;
    public $RMA_NOTE;
    public $RMA_WARRANTY_TYPE;
    public $RMA_WARRANTY_NOTE;
    public $RMA_INTERNAL_NOTE;

	/* NOTIFICATION */
	public $NOTIFCATION_ID;
    public $NOTIFICATION_TYPE;
    public $NOTIFICATION_RECIPIENTS;
    public $NOTIFICATION_BODY;
	public $NOTIFICATION_EXTRA_BODY;	
	public $NOTIFICATION_TAG_ARRAY;

	/* CLAIM */
	public $CLAIM_LATEST_ID;

	/* ADMIN CLAIM EDIT */
	public $ADMIN_PUMP_PROVIDER_TWO;
	public $ADMIN_PUMP_CODE_DATE;
	public $ADMIN_PUMP_MOTOR_CODE_DATE;
	public $ADMIN_PUMP_SERVICE_TAG; 
	public $ADMIN_PUMP_REPORT;
	public $ADMIN_PUMP_REPAIR_BOOL;
	public $ADMIN_PUMP_FILED_BOOL;
	public $ADMIN_PUMP_SHIPPED; 
	public $ADMIN_PUMP_TRACKING_NUMBER; 
	public $ADMIN_PUMP_CHARGERS;
	public $ADMIN_PUMP_RETURENED_DATE; 


	/**
	 * SECTION 
	 * user login, user authentication, user password changes  
	 **/

	/* user credential verification use: $_POST["cmdLogin"]; $_POST["txtUserID"]; $_POST["txtPass"] */
	function CheckLogin(){
						
		# extra check $cmdloing == "Login"	
		if ($_POST['cmdLogin'] == "Login" AND $_POST['accounType']== "Administrator"){		        			

			# check for admin credentials 
			$this->ExecuteUserLogin();
		}elseif($_POST['cmdLogin'] == "Login" AND $_POST['accounType']== "Technician"){ 

			#check for tech credentials
			$this->ExecuteTechsLogin();
		}elseif($_POST['cmdLogin'] == "Login" AND $_POST['accounType']== "Provider"){

			# check for providers credentials
			$this->ExecuteProvidersLogin();
		}elseif($_POST['cmdLogin'] == "Login" AND $_POST['accounType']== "Customer"){

			# check for clients credentials
			$this->ExecuteCustomerLogin();
		}else{

			#redirect to login anything fails to check
			header('location: '._BASE_URL.'/home/Login.php?errorMssg='._SHOWALERT_INVALID_LOGIN.'');
		}
	}


	/* user login view */
	function ViewLogin(){
	 		
		# check for values in $_REQUEST
		if (isset($_POST['cmdLogin'])  AND !empty($_REQUEST["accounType"])) {
							
			# run login check function
			$this->CheckLogin();	
	
		} else {

			# include default tpl for the login form
            include ("../includes/tpl/HomeLoginForm.tpl");
		}
	}


	/* execute user login query */
	function ExecuteUserLogin(){
				
		# check for user credentials based on $_POST[] fields
		$Result=DBi::$conn->prepare("SELECT 				   `tblUser`.`UserNAME`,
														       `tblUser`.`UserFullNAME`,
														       `tblUser`.`UserID` 
								     FROM	 	`"._DB_NAME."`.`tblUser` 
								     WHERE 			       	   `tblUser`.`UserNAME` 		= ? 
								     AND   			       	   `tblUser`.`UserPASSWORD` 	= md5(?) 
								     AND   			       	   `tblUser`.`UserSTATUS`		= 1	");			
		
		$Result->bind_param("ss",$_POST['txtUserID'],$_POST['txtPass']);
		$Result->execute();		
		$Result->store_result();
		
		# check for valid return and set $VARS to session 
		if ($Result->num_rows == 1 ){
			
			$Result->bind_result($this->USER_NAME, $this->USER_FULL_NAME,$this->USER_ID);

			while ($Result->fetch()){
						
				$_SESSION['cid']        	= $this->USER_NAME;
                $_SESSION['name']       	= $this->USER_FULL_NAME;
                $_SESSION['myid']       	= $this->USER_ID;
				$_SESSION['GLOBAL_ACCESS']	= True;
						
			}

			# redirect to home after process is completed
			header( 'Location:  '._BASE_URL.'/home/index.php' );
		}else{
			
			# redirect with a error mesg if invalid login
			header('location: '._BASE_URL.'/home/Login.php?errorMssg='._SHOWALERT_INVALID_LOGIN.'');
		}	
	}




	/* execute customer login query */ 
	function ExecuteCustomerLogin(){
		
		# check for customer credentials based on $_POST[] fields
    	$Result=DBi::$conn->prepare("SELECT  				   `tblCustomer`.`CustomerID`,
															   `tblCustomer`.`CustomerFullNAME` 
					     			 FROM	 	`"._DB_NAME."`.`tblCustomer` 
					     			 WHERE					   `tblCustomer`.`CustomerLoginID` 	= ?
                                     AND 		 			   `tblCustomer`.`CustomerPASSWORD`	= md5(?)
                                     AND 		 			   `tblCustomer`.`CustomerSTATUS`   = 1");
			
		$Result->bind_param("ss",$_POST['txtUserID'],$_POST['txtPass']);
		$Result->execute();
        $Result->store_result();

        # check for valid return and set $VARS to session
        if ($Result->num_rows == 1 ){

	    	$Result->bind_result($this->CUSTOMER_ID,$this->CUSTOMER_FULL_NAME);
 
            while ($Result->fetch()){	
			
	            $_SESSION['customerid']  		= $this->CUSTOMER_ID;
	            $_SESSION['customername']		= $this->CUSTOMER_FULL_NAME;
				$_SESSION['GLOBAL_ACCESS']      = True;
				
			}				

			# redirect to user page after process is completed  
            header('location: ' . _BASE_URL . '/warranty/ViewCustomersClaims.php');

		}else{

			# redirect with a error mesg if invalid login
			header('location: '._BASE_URL.'/home/Login.php?errorMssg='._SHOWALERT_INVALID_LOGIN.'');
		}
	}




	 /* execute customer login query */
    function ExecuteTechsLogin(){

    	# check for tech credentials based on $_POST[] fields
        $Result=DBi::$conn->prepare("SELECT  				  `tblTech`.`TechID`,
								  							  `tblTech`.`TechFullNAME`
                                      FROM      `"._DB_NAME."`.`tblTech`
                                      WHERE        		       `tblTech`.`TechUserNAME`   = ?
                                      AND          		   	   `tblTech`.`TechPASSWORD`   = md5(?)
                                      AND          		   	   `tblTech`.`TechSTATUS`     = 1");
		
        $Result->bind_param("ss",$_POST['txtUserID'],$_POST['txtPass']);
        $Result->execute();
		$Result->store_result();

        # check for valid return and set $VARS to session and extra values
        if ($Result->num_rows == 1 ){
        	$Result->bind_result($this->TECH_ID,$this->TECH_FULL_NAME);

            while ($Result->fetch()){
            
            	# set session information
                $_SESSION['tech_id']         	= $this->TECH_ID;
                $_SESSION['tech_name']       	= $this->TECH_FULL_NAME;
				$_SESSION['tech_username']   	= $this->TECH_FULL_NAME;	
		
				# duplicate client 			
				$_SESSION['customerid']	     	= $this->TECH_ID;
				$_SESSION['customername']    	= $this->TECH_FULL_NAME;	
		
				#add admin properties
				$_SESSION['cid']				= $this->TECH_ID;
				$_SESSION['name']				= $this->TECH_FULL_NAME;

				# global access
				$_SESSION['GLOBAL_ACCESS']      = $this->TECH_ID;
			}	
        	
        	# redirect to tech warranty claim view
            header('location: ' . _BASE_URL . '/warranty/ViewTechClaimWarranty.php');

        }else{

			# redirect with a error mesg if invalid login
            header('location: '._BASE_URL.'/home/Login.php?errorMssg='._SHOWALERT_INVALID_LOGIN.'');
		}
    }



	
	/* execute provides login query */
    function ExecuteProvidersLogin(){
		
    	# check for provider credentials based on $_POST[] fields
        $Result=DBi::$conn->prepare("SELECT					   `tblProvider`.`ProviderID`,
															   `tblProvider`.`ProviderNAME`
                                     FROM 		`"._DB_NAME."`.`tblProvider`
                                     WHERE        			   `tblProvider`.`ProviderNAME`	 		= ?
                                     AND          			   `tblProvider`.`ProviderPASSWORD`		= md5(?)
                                     AND          			   `tblProvider`.`ProviderSTATUS` 		= 1");
	
		$Result->bind_param("ss",$_POST['txtUserID'],$_POST['txtPass']);
		$Result->execute();
		$Result->store_result();

        # check for valid return and set $VARS to session
        if ($Result->num_rows == 1 ){
			
			$Result->bind_result($this->PROVIDER_ID,$this->PROVIDER_NAME);

            while ($Result->fetch()){
			
	      		$_SESSION['ProviderID']         =  $this->PROVIDER_ID;
                $_SESSION['ProviderNAME']       =  $this->PROVIDER_NAME;
		
			}
             
            # redirect to provider warranty view
            header('location: ' . _BASE_URL . '/warranty/ViewProviders.php');
		
		}else{
            
        	# redirect with a error mesg if invalid login
            header('location: '._BASE_URL.'/home/Login.php?errorMssg='._SHOWALERT_INVALID_LOGIN.'');
 
        }
	}




	
	/* create new customer */
	function ExecuteCreatNewCustomer(){

 		# SQL customer entry string
		$Result = DBi::$conn->prepare("INSERT INTO 		   `"._DB_NAME."`.`tblCustomer` 
				   	     (			 		 	  `tblCustomer`.`CustomerLoginID`,
							 				  `tblCustomer`.`CustomerPASSWORD`,
							 				  `tblCustomer`.`CustomerFullNAME`,
							 				  `tblCustomer`.`CustomerADDRESS`,
							 				  `tblCustomer`.`CustomerCITY`,
							 				  `tblCustomer`.`CustomerPHONE`		) 
				              VALUES(					   ?,MD5(?),?,?,?,?		);");	

		# bind results as mysqlnd driver is not istalled
                $Result->bind_param("ssssss",		$this->CUSTOMER_EMAIL,
							$this->CUSTOMER_PASSWORD,
							$this->CUSTOMER_FULL_NAME,
							$this->CUSTOMER_ADDRESS,
							$this->CUSTOMER_CITY,
							$this->CUSTOMER_PHONE		);

                # run query
                $Result->execute();
		
		# store customer Id and Login Id
		$this->SetBasicCustomerInformation($Result->insert_id,$this->CUSTOMER_LOGIN_ID);
	 }




	/* check for user accounts for claims  */
	function ExecuteCheckAccount(){

		# get account for user		
	 	$Result =DBi::$conn->prepare("SELECT 				`tblCustomer`.`CustomerID`,
								 		`tblCustomer`.`CustomerLoginID`
					      FROM 		 `"._DB_NAME."`.`tblCustomer` 
					      WHERE 				`tblCustomer`.`CustomerLoginID`		= ?
					      AND 				`tblCustomer`.`CustomerSTATUS` 		= 1 ");
		
		
		# bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$_POST['CUSTOMER_EMAIL']);

                # run query
                $Result->execute();

                # store result
                $Result->store_result();
		
		# bind and set session
                if ($Result->num_rows == 1 ){
		
                        # bind results to user
                        $Result->bind_result($this->CUSTOMER_ID, $this->CUSTOMER_LOGIN_ID);

                        # fetch information
                        while ($Result->fetch()){		

				# set customer Id and Login Id
				$this->SetBasicCustomerInformation($this->CUSTOMER_ID,$this->CUSTOMER_LOGIN_ID); 

			}
		}else{

			# create new customer
			$this->ExecuteCreatNewCustomer();	
			
			# set message to load                   
                        $this->NOTIFICATION_TYPE = "NEW_ACCOUNT";
     
                        # call notification to create and send
                        $this->EmailNotification();


		}
	}




	/* set username basic information */ 
	function SetBasicCustomerInformation($CustomerID,$CuctomerLoginID){
		# set value for customer	
		$this->CUSTOMER_ID 			= $CustomerID;
		$this->CUSTOMER_LOGIN_ID 		= $CuctomerLoginID;
	}




	/* 
	 * SECTION
	 * claim form, claim submit, provider list for claims and create new claims
	 */




	/* send email for customer */
	function EmailNotification(){
	
		//print_r($_REQUEST);
		//exit();	
		# fetch data for email - body and email addresses
		$this->ExecuteEmailNotification();

		# fetch latest claim id for user
		$this->LatestClaimByUser();
		
		# load object to start creating email
		$mail             = new PHPMailer();		

		# add from address 	
		$mail->SetFrom("warranty@warranty.pdwatersystems.com", "PD Water Systems");
                $mail->AddReplyTo("warranty@warranty.pdwatersystems.com","Warranty & Claims");
		
		# set extra body for new account
		if($this->NOTIFICATION_TYPE == 'NEW_ACCOUNT'){

			# add emails			
			$mail->AddAddress($this->CUSTOMER_EMAIL, "PD Water Systems Customer");
			
			# subject
			$this->NOTIFICATION_SUBJECT 	= "NEW ACCOUNT CREATION";

			# body
			$this->NOTIFICATION_EXTRA_BODY  = '<html><body>';
                	$this->NOTIFICATION_EXTRA_BODY .= '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                	$this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                	$this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                	$this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY;
                	$this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                	$this->NOTIFICATION_EXTRA_BODY .= '<tr><td>We will Contact you as soon as poosible:</br>';
                	$this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                	$this->NOTIFICATION_EXTRA_BODY .= '</table>';
			$this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>USERNAME: $this->CUSTOMER_EMAIL <BR/> PASSWORD: $this->CUSTOMER_PASSWORD <BR/> ACCESS URL: ". _BASE_URL;
			
		}

		# set extra body for new claim
                if($this->NOTIFICATION_TYPE == 'NEW_CLAIM'){

			# add emails
			$mail->AddAddress($this->CUSTOMER_EMAIL);	
			
			# internal emails	
			$Array  =       explode( '|', $this->NOTIFICATION_RECIPIENTS);
			
			foreach($Array as $email){
   				$mail->AddBcc($email);
			}
				
			# subject
			$this->NOTIFICATION_SUBJECT 	= "NEW CLAIM CREATION";

			# body
			$this->NOTIFICATION_EXTRA_BODY  = '<html><body>';
                	$this->NOTIFICATION_EXTRA_BODY .= '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                	$this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                	$this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                	$this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY;
                	$this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                	$this->NOTIFICATION_EXTRA_BODY .= '<tr><td>We will Contact you as soon as poosible:</br>';
                	$this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                	$this->NOTIFICATION_EXTRA_BODY .= '</table>';
                        $this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>NEW CLAIM ID: $this->CLAIM_LATEST_ID <BR/> ACCESS URL: "._BASE_URL;
			$this->NOTIFICATION_EXTRA_BODY .= "</body></html>";
                }


		# set exgra body for new pump
                 if($this->NOTIFICATION_TYPE == 'NEW_PUMP'){

                        # emails
                        $mail->AddAddress($this->CUSTOMER_EMAIL);

                        # internal email
                                
                        $Array  =       explode( '|', $this->NOTIFICATION_RECIPIENTS);
                             
                        foreach($Array as $email){
                                $mail->AddBcc($email);
                        }
                        
                        # subject
                        $this->NOTIFICATION_SUBJECT     = "NEW PUMP REPLACEMENT";
 
                        # body
                        $this->NOTIFICATION_EXTRA_BODY  = '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                        $this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                        $this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY."<BR/><BR/>";
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td><strong>We will Contact you as soon as poosible</strong></br>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</table>';
                        $this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>CLAIM ID: ". $_REQUEST['ClaimID']." <BR/> ACCESS URL: "._BASE_URL."<BR/> ADMIN NOTES: ".$_REQUEST['RECIPIENTS_NOTE'] ;
                        $this->NOTIFICATION_EXTRA_BODY .= '</html></body>';

                }

		# set exgra body for new pump
                 if($this->NOTIFICATION_TYPE == 'CREDIT_NOTE'){

                        # emails
                        $mail->AddAddress($this->CUSTOMER_EMAIL);

                        # internal email

                        $Array  =       explode( '|', $this->NOTIFICATION_RECIPIENTS);

                        foreach($Array as $email){
                                $mail->AddBcc($email);
                        }

                        # subject
                        $this->NOTIFICATION_SUBJECT     = "CREDIT NOTE";

                        # body
                        $this->NOTIFICATION_EXTRA_BODY  = '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                        $this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                        $this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY."<BR/><BR/>";
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td><strong>We will Contact you as soon as poosible</strong></br>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</table>';
                        $this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>CLAIM ID: ". $_REQUEST['ClaimID']." <BR/> ACCESS URL: "._BASE_URL."<BR/> ADMIN NOTES: ".$_REQUEST['RECIPIENTS_NOTE'] ;
                        $this->NOTIFICATION_EXTRA_BODY .= '</html></body>';

                }

		
		# set extra body for new pump
                 if($this->NOTIFICATION_TYPE == 'REPAIR_PUMP'){

                        # emails
                        $mail->AddAddress($this->CUSTOMER_EMAIL);

                        # internal email

                        $Array  =       explode( '|', $this->NOTIFICATION_RECIPIENTS);

                        foreach($Array as $email){
                                $mail->AddBcc($email);
                        }

                        # subject
                        $this->NOTIFICATION_SUBJECT     = "REPAIR PUMP";

                        # body
                        $this->NOTIFICATION_EXTRA_BODY  = '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                        $this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                        $this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY."<BR/><BR/>";
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td><strong>We will Contact you as soon as poosible</strong></br>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</table>';
                        $this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>CLAIM ID: ". $_REQUEST['ClaimID']." <BR/> ACCESS URL: "._BASE_URL."<BR/> ADMIN NOTES: ".$_REQUEST['RECIPIENTS_NOTE'] ;
                        $this->NOTIFICATION_EXTRA_BODY .= '</html></body>';

                }

		# set extra body for new pump
                 if($this->NOTIFICATION_TYPE == 'NO_WARRANTY'){

                        # emails
                        $mail->AddAddress($this->CUSTOMER_EMAIL);

                        # internal email

                        $Array  =       explode( '|', $this->NOTIFICATION_RECIPIENTS);

                        foreach($Array as $email){
                                $mail->AddBcc($email);
                        }

                        # subject
                        $this->NOTIFICATION_SUBJECT     = "NO WARRANTY";

                        # body
                        $this->NOTIFICATION_EXTRA_BODY  = '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
                        $this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
                        $this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY."<BR/><BR/>";
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '<tr><td></br>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
                        $this->NOTIFICATION_EXTRA_BODY .= '</table>';
                        $this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>CLAIM ID: ". $_REQUEST['ClaimID']." <BR/> ACCESS URL: "._BASE_URL."<BR/> ADMIN NOTES: ".$_REQUEST['RECIPIENTS_NOTE'] ;
                        $this->NOTIFICATION_EXTRA_BODY .= '</html></body>';

                }


		# set extra body for rma
		 if($this->NOTIFICATION_TYPE == 'RMA'){

			# emails
			$mail->AddAddress($this->CUSTOMER_EMAIL);
			
			# internal email
				
			$Array  =    explode( '|', $this->NOTIFICATION_RECIPIENTS);
                             
            foreach($Array as $email){
            	$mail->AddBcc($email);
            }
			
			# subject
            $this->NOTIFICATION_SUBJECT     = "RMA";
 
			# body
	        $this->NOTIFICATION_EXTRA_BODY  = '<img src="http://www.pdwatersystems.com/images/Logo.jpg" alt="Contact Us" />';
			$this->NOTIFICATION_EXTRA_BODY .= "<h1>---INCLUDE EMAIL AND ATTACHMENT IN SHIPPING PACKAGE---</h1>";
            $this->NOTIFICATION_EXTRA_BODY .= '<table cellspacing="0" cellpadding="0" border="0" width="600">';
            $this->NOTIFICATION_EXTRA_BODY .= '<tr><td>';
            $this->NOTIFICATION_EXTRA_BODY .= $this->NOTIFICATION_BODY;
            $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
            //$this->NOTIFICATION_EXTRA_BODY .= '<tr><td><strong>We will Contact you as soon as poosible</strong></br>';
            $this->NOTIFICATION_EXTRA_BODY .= '</td></tr>';
            $this->NOTIFICATION_EXTRA_BODY .= '</table>';
			$this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/><img src='"._BASE_URL."/includes/barcode/barcode.php?size=20&text=".$_REQUEST['ClaimID']."'/>";
			$this->NOTIFICATION_EXTRA_BODY .= "<BR/><BR/>CLAIM ID   : ". $_REQUEST['ClaimID']."  <BR/> ACCESS URL: "._BASE_URL."<BR/>";
			$this->NOTIFICATION_EXTRA_BODY .= "ADMIN NOTES: ".$_REQUEST['RECIPIENTS_NOTE'];
			$this->NOTIFICATION_EXTRA_BODY .= "<h1>---INCLUDE EMAIL AND ATTACHMENT IN SHIPPING PACKAGE---</h1>";
			$this->NOTIFICATION_EXTRA_BODY .= '</html></body>';
			
			# attachement
			$mail->AddAttachment('../attachments/RMA.pdf');	
		}
	
		
		# set basics for email
		$mail->Subject    = $this->NOTIFICATION_SUBJECT;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($this->NOTIFICATION_EXTRA_BODY);

		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
  			echo "Message sent!";
		}
	}



	
	/* fetch notification data */
	function ExecuteEmailNotification(){

		 # get account for user
                $Result =DBi::$conn->prepare("SELECT                            `tblNotification`.`NotificationRECIPIENTS`,
                                                                                `tblNotification`.`NotificationBODY`
                                              FROM               `"._DB_NAME."`.`tblNotification`
                                              WHERE                             `tblNotification`.`NotificationTYPE`         = 		? 	");


                # bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$this->NOTIFICATION_TYPE);

                # run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows == 1 ){

			# store results
			$Result->bind_result($this->NOTIFICATION_RECIPIENTS, $this->NOTIFICATION_BODY);
			
			# get results
			$Result->fetch();
		}
	}




	/* output the warranty claim form based on type of pump */
	function ViewClaimForm(){

		# default option
	 	if (empty($_GET) OR !empty($_GET['ErrorMsg']) OR !empty($_GET['SuccessMsg'])) {
			
	 		# include tpl for above ground pump
	 		include("../includes/tpl/WarrantyFormClaim.tpl");
	 	}
		
	 	# if request is valid
		if (!empty($_REQUEST)){
	 		if (isset($_REQUEST['selectpumptype'])){
			
				# get claim basic information
				if(isset($_SESSION['customerid'])){

					# customer get from customer session
 			                $this->CUSTOMER_ID =  $_SESSION['customerid'];

					# fetch basic information
					$this->ExecuteClaimUserInformation();
				}
				
	 			# include tpl for above ground pump
	 			include("../includes/tpl/WarrantyFormClaimAGP.tpl");
	 		}
	 		if (@$_REQUEST['cmdClaim'] == "Submit Claim"){
	 				
	 			# check data and return variables
	 			$this->CheckClaimFormSubmit($_POST);
				
				 # execute AGP Claim
                		if ($this->PUMP_TYPE AND $this->CUSTOMER_EMAIL){

                        		# check account - will create accout if not found; otherwise, it will return email and id
                        		$this->ExecuteCheckAccount();

                        		# create claim
                        		$this->ExecuteCreatNewClaim();

					# set notification type
					$this->NOTIFICATION_TYPE = "NEW_CLAIM";

					# send notification
					$this->EmailNotification();
                		}				
			}
		}
	}




	/* get claim information */
        function ExecuteClaimUserInformation(){

                # get custome information  first
                $Result =DBi::$conn->prepare("	SELECT   SUBSTRING_INDEX(SUBSTRING_INDEX(`tblCustomer`.`CustomerFullNAME`, ' ', 1), ' ', -1) AS CustomerFirstNAME,
                                                         SUBSTRING_INDEX(SUBSTRING_INDEX(`tblCustomer`.`CustomerFullNAME`, ' ', 2), ' ', -1) AS CustomerLastNAME,
                                                                                	 `tblCustomer`.`CustomerID`,
                                                                                	 `tblCustomer`.`CustomerLoginID`,
                                                                                	 `tblCustomer`.`CustomerADDRESS`,
											 `tblCustomer`.`CustomerCITY`,
											 `tblCustomer`.`CustomerZipCODE`,
                                                                                	 `tblCustomer`.`CustomerPHONE`
                                                FROM     		  `"._DB_NAME."`.`tblCustomer`
                                                WHERE                   		 `tblCustomer`.CustomerId 	= 	?	");
         
		 # bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$this->CUSTOMER_ID);

                # run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows == 1 ){

                        # bind results to user
                        $Result->bind_result(   $this->CUSTOMER_FIRST_NAME,
                                                $this->CUSTOMER_LAST_NAME,
                                                $this->CUSTOMER_ID,
                                                $this->CUSTOMER_LOGIN_ID,
                                                $this->CUSTOMER_ADDRESS,
                                                $this->CUSTOMER_CITY,
                                                $this->CUSTOMER_ZIP_CODE,
                                                $this->CUSTOMER_PHONE	   );

                        # fetch results and store on vars
                        $Result->fetch();
                }
        }


	/* view tempalte for claim AGP */
	function ViewEditClaimForm(){

		# default view and load values		
		if(!isset($_POST['cmdClaim'])){	
			# call for values from db
			$this->ExecuteEditClaimForm();		

			# default view
			include("../includes/tpl/WarrantyEditClaimAGP.tpl");

		}

		# check for post to update claim
        if(isset($_POST['cmdClaim'])){

        	# check data and return variables
            $this->CheckClaimFormSubmit($_POST);

			#do claim update 
			$this->ExecuteUpdateClaimForm($_POST);
       	}
	}

	/* view template for admins - it shows only a part of the table for admin to modify */
	function ViewEditClaimFormAdmin(){
		
		# check for admin provileges
		 if(isset($_SESSION['cid']) && isset($_SESSION['name']) && !isset($_SESSION['tech_id'])){		
			
			# include template
			include("../includes/tpl/WarrantyEditClaimAGP-Admin.tpl");
					
		}	
			
	}

	/* update claim after review */
	function ExecuteUpdateClaimForm(){
	
		 # get account for user
         $Result =DBi::$conn->prepare("	UPDATE	 `"._DB_NAME."`.`tblWarrantyClaim`
										SET						`tblWarrantyClaim`.`WarrantyClaimREF` 			= ?,
																`tblWarrantyClaim`.`PumpStatus`					= ?,
																`tblWarrantyClaim`.`PumpStatusOther`			= ?,
																`tblWarrantyClaim`.`PumpInstallation`			= ?,
																`tblWarrantyClaim`.`PumpInstallationOther`		= ?,
																`tblWarrantyClaim`.`PumpOperation`				= ?,
																`tblWarrantyClaim`.`PumpProblemDescription`		= ?,
																`tblWarrantyClaim`.`PumpProblemDescriptionOther`= ?,
																`tblWarrantyClaim`.`PumpDistrubutor`			= ?,
																`tblWarrantyClaim`.`WarrantyProvider`			= ?,
																`tblWarrantyClaim`.`ClaimREVIEW`				= ?,
																`tblWarrantyClaim`.`PumpModel`					= ?,
																`tblWarrantyClaim`.`PumpSERIAL`                 = ?,
																`tblWarrantyClaim`.`PartyCOMPANY`               = ?,
																`tblWarrantyClaim`.`PartyTYPE`                	= ?,
																`tblWarrantyClaim`.`PartyNAME`                  = ?,
																`tblWarrantyClaim`.`PartyPHONE`                 = ?	
										WHERE					`tblWarrantyClaim`.`WarrantyClaimId`			= ?	" );
								

				
		$Result->bind_param("ssssssssssssssssss",	$this->REF,
													$this->PUMP_STATUS,
													$this->PUMP_STATUS_OTHER,
													$this->PUMP_INSTALLATION,
													$this->PUMP_INSTALLATION_OTHER,
													$this->PUMP_OPERATION,
													$this->PUMP_PROBLEM_DESCRIPTION,
													$this->PUMP_PROBLEM_DESCRIPTION_OTHER,
													$this->DISTRIBUTOR,
													$this->PUMP_PROVIDER,
													$this->CLAIM_REVIEW,
													$this->PUMP_MODEL,
													$this->PUMP_SERIAL,   
													$this->PARTY_COMPANY,                                  
					                				$this->PARTY_TYPE,                                       
					                				$this->PARTY_NAME,                                     
					                				$this->PARTY_PHONE,                                    
													$_REQUEST['ClaimID']		);

		# run query
        $Result->execute();


		#check for warrany ADMIN and update if needed
		$this->ExecuteCheckAdminSectionClaim();			

		# redirect
		header('location: ' . _BASE_URL . '/warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId='.$_GET['ClaimID'].'');
	}




	/* get information from claim*/
	function ExecuteEditClaimForm(){
		
		# get account for user
                $Result =DBi::$conn->prepare("	SELECT
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CUSTOMERS`.`CustomerFullNAME`, ' ', 1), ' ', -1) AS FirstNAME,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CUSTOMERS`.`CustomerFullNAME`, ' ', 2), ' ', -1) AS LastNAME,
                                                                                `CUSTOMERS`.`CustomerID`,
                                                                                `CUSTOMERS`.`CustomerLoginID`,
                                                                                `CUSTOMERS`.`CustomerADDRESS`,
                                                                                `CUSTOMERS`.`CustomerCITY`,
                                                                                `CUSTOMERS`.`CustomerZipCODE`,
                                                                                `CUSTOMERS`.`CustomerPHONE`,
                                                                                `CLAIMS`.`WarrantyClaimId`,
                                                                                `CLAIMS`.`CustomerId`,
                                                                                `CLAIMS`.`WarrantyClaimREF`,
                                                                                `CLAIMS`.`PumpType`,
                                                                                `CLAIMS`.`PumpStatus`,
                                                                                `CLAIMS`.`PumpStatusOther`,
                                                                                `CLAIMS`.`PumpInstallation`,
                                                                                `CLAIMS`.`PumpInstallationOther`,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CLAIMS`.`PumpOperation`, '|', 1), '|', -1) AS PSI,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CLAIMS`.`PumpOperation`, '|', 2), '|', -1) AS GPM,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CLAIMS`.`PumpOperation`, '|', 3), '|', -1) AS LIQUID,
                                                                                `CLAIMS`.`PumpProblemDescription`,
                                                                                `CLAIMS`.`PumpProblemDescriptionOther`,
                                                                                `CLAIMS`.`PumpDistrubutor`,
                                                                                `CLAIMS`.`WarrantyProvider`,
                                                                                `CLAIMS`.`PumpModel`,
                                                                                `CLAIMS`.`PumpSERIAL`,
                                                                                `CLAIMS`.`PartyCOMPANY`,
                                                                                `CLAIMS`.`PartyTYPE`,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CLAIMS`.`PartyNAME`, '|', 1), '|', -1) AS PartyFNAME,
                                                SUBSTRING_INDEX(SUBSTRING_INDEX(`CLAIMS`.`PartyNAME`, '|', 2), '|', -1) AS PartyLNAME,
                                                                                `CLAIMS`.`PartyPHONE`,
										`ADMIN`.`ProviderTWO`,
										`ADMIN`.`CodePumpDATE`,
										`ADMIN`.`CodeMotorDATE`,
										`ADMIN`.`ServiceTAG`,
										`ADMIN`.`ReportID`,
										`ADMIN`.`RepairBOOL`,
										`ADMIN`.`FiledBOOL`,
										`ADMIN`.`ShippedTYPE`,
										`ADMIN`.`TrackingBOL`,
										`ADMIN`.`ChargeNUMBERS`,
										`ADMIN`.`ReturnedDATE`
                                                                                
                                                                                	

                                                FROM             		`"._DB_NAME."`.`tblWarrantyClaim`	AS CLAIMS
												LEFT  JOIN				`"._DB_NAME."`.`tblCustomer`		AS CUSTOMERS 	ON	CLAIMS.`CustomerId`			=	CUSTOMERS.`CustomerID`
												LEFT  JOIN  			`"._DB_NAME."`.`tblWarrantyClaimAdmin`	AS ADMIN	ON	CLAIMS.`WarrantyClaimId`	= 	ADMIN.`ClaimID`         
                                 				WHERE                         `CLAIMS`.`WarrantyClaimId`   =  ?	");



                # bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$_REQUEST['ClaimID']);

                # run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows == 1 ){

                        # bind results to user
                        $Result->bind_result(	$this->CUSTOMER_FIRST_NAME,
												$this->CUSTOMER_LAST_NAME,
												$this->CUSTOMER_ID, 
												$this->CUSTOMER_LOGIN_ID,
												$this->CUSTOMER_ADDRESS,
												$this->CUSTOMER_CITY,
												$this->CUSTOMER_ZIP_CODE,
												$this->CUSTOMER_PHONE,
												$this->CLAIM_ID,
												$this->CLAIM_CUSTOMER_ID,
												$this->CLAIM_REF,
												$this->CLAIM_PUMP_TYPE,
												$this->CLAIM_PUMP_STATUS,
												$this->CLAIM_PUMP_STATUS_OTHER,
												$this->CLAIM_PUMP_INSTALLATION,
												$this->CLAIM_PUMP_INSTALLATION_OTHER,
												$this->CLAIM_PUMP_OPERATION_PSI,
												$this->CLAIM_PUMP_OPERATION_GPM,
												$this->CLAIM_PUMP_OPERATION_LIQUID,
												$this->CLAIM_PUMP_PROBLEM_DESCRIPTION,
												$this->CLAIM_PUMP_PROBLEM_DESCRIPTION_OTHER,
												$this->CLAIM_PUMP_DISTRIBUTOR,
												$this->CLAIM_PUMP_PROVIDER,
												$this->PUMP_MODEL,
												$this->PUMP_SERIAL,
												$this->PARTY_COMPANY,
												$this->PARTY_TYPE,
												$this->PARTY_FNAME,
												$this->PARTY_LNAME,
												$this->PARTY_PHONE,
												$this->ADMIN_PUMP_PROVIDER_TWO,
												$this->ADMIN_PUMP_DATE,
												$this->ADMIN_MOTOR_DATE,
												$this->ADMIN_SERVICE_TAG,
												$this->ADMIN_REPORT,
												$this->ADMIN_REPAIR,
												$this->ADMIN_FILED,
												$this->ADMIN_SHIPPED,
												$this->ADMIN_TRACKING_NUMBER,
												$this->ADMIN_CHARGES,
												$this->ADMIN_RETURNED_DATE		);
			
			# fetch results and store on vars
            $Result->fetch();			
		}
	}	




	/* warranty claim submit */
	 function CheckClaimFormSubmit(){	 	
		/*		
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		$total = count($_FILES['ADMIN_PUMP_IMAGE']['name']);

		echo $total;
		exit();
		*/
	 	# organize string for input - CUSTOMER
		$this->CUSTOMER_FNAME 					= addslashes($_POST['CUSTOMER_FNAME']);
		$this->CUSTOMER_LNAME 					= addslashes($_POST['CUSTOMER_LNAME']);
		$this->CUSTOMER_FULL_NAME				= addslashes($_POST['CUSTOMER_FNAME']." ".$_POST['CUSTOMER_LNAME']);
		$this->CUSTOMER_EMAIL 					= addslashes($_POST['CUSTOMER_EMAIL']);
		$this->CUSTOMER_PASSWORD 				= mt_rand(1000,9999);
		$this->CUSTOMER_ADDRESS 				= addslashes($_POST['CUSTOMER_ADDRESS']);
		$this->CUSTOMER_CITY 					= addslashes($_POST['CUSTOMER_CITY']);
		$this->CUSTOMER_PHONE 					= addslashes($_POST['CUSTOMER_PHONE']);

		# organize arrays -check for valid data to implode
		if (isset($_POST['PUMP_STATUS'])) {
			$this->PUMP_STATUS 					= implode("|", $_POST['PUMP_STATUS']);
		}
		if (isset($_POST['PUMP_INSTALLATION'])) {
			$this->PUMP_INSTALLATION 			= implode("|", $_POST['PUMP_INSTALLATION']);
		}
		if (isset($_POST['PUMP_OPERATION'])) {
			$this->PUMP_OPERATION 				= implode("|", $_POST['PUMP_OPERATION']);
		}
		if (isset($_POST['PUMP_PROBLEM_DESCRIPTION'])) {
			$this->PUMP_PROBLEM_DESCRIPTION 	= implode("|", $_POST['PUMP_PROBLEM_DESCRIPTION']);
		}

		# organize simple varibales
		$this->PUMP_TYPE 						= addslashes(@$_POST['PUMP_TYPE']);
		$this->DISTRIBUTOR 						= addslashes($_POST['DISTRIBUTOR']);
		$this->REF 								= addslashes($_POST['REF']);
		$this->PUMP_MODEL 						= addslashes($_POST['PUMP_MODEL']);			
		$this->PUMP_STATUS_OTHER 				= addslashes($_POST['PUMP_STATUS_OTHER']);
		$this->PUMP_INSTALLATION_OTHER 			= addslashes($_POST['PUMP_INSTALLATION_OTHER']);
		$this->PUMP_PROBLEM_DESCRIPTION_OTHER 	= addslashes($_POST['PUMP_PROBLEM_DESCRIPTION_OTHER']);			
		$this->PUMP_PROVIDER					= addslashes($_POST['PUMP_PROVIDER']);
		$this->PUMP_SERIAL						= addslashes($_POST['PUMP_SERIAL']);
		$this->CLAIM_REVIEW						= 1 ;
		$this->PARTY_COMPANY					= addslashes($_POST['PARTY_COMPANY']);
		$this->PARTY_TYPE						= addslashes($_POST['PARTY_TYPE']);
		$this->PARTY_NAME						= addslashes($_POST['PARTY_FNAME']."|".$_POST['PARTY_LNAME']);
		$this->PARTY_PHONE						= addslashes($_POST['PARTY_PHONE']);
		
		# check for origin from post and update from the admin section
		if (isset($_POST['ADMIN_CLAIM_CHANGE'])) {
			
			$this->ADMIN_PUMP_PROVIDER_TWO			= addslashes($_POST['ADMIN_PUMP_PROVIDER_TWO']);
			$this->ADMIN_PUMP_CODE_DATE				= addslashes($_POST['ADMIN_PUMP_CODE_DATE']);
			$this->ADMIN_PUMP_MOTOR_CODE_DATE		= addslashes($_POST['ADMIN_PUMP_MOTOR_CODE_DATE']);
			$this->ADMIN_PUMP_SERVICE_TAG			= addslashes($_POST['ADMIN_PUMP_SERVICE_TAG']);
			$this->ADMIN_PUMP_REPORT				= addslashes($_POST['ADMIN_PUMP_REPORT']);
			$this->ADMIN_PUMP_REPAIR_BOOL			= addslashes($_POST['ADMIN_PUMP_REPAIR_BOOL']);
			$this->ADMIN_PUMP_FILED_BOOL			= addslashes($_POST['ADMIN_PUMP_FILED_BOOL']);
			$this->ADMIN_PUMP_SHIPPED				= addslashes($_POST['ADMIN_PUMP_SHIPPED']);
			$this->ADMIN_PUMP_TRACKING_NUMBER		= addslashes($_POST['ADMIN_PUMP_TRACKING_NUMBER']);
			$this->ADMIN_PUMP_CHARGERS				= addslashes($_POST['ADMIN_PUMP_CHARGERS']);
			$this->ADMIN_PUMP_RETURENED_DATE		= addslashes($_POST['ADMIN_PUMP_RETURENED_DATE']);
		}
			
	}




	/* create new warranty claim */
	function ExecuteCreatNewClaim(){
					
		$Result=DBi::$conn->prepare ("INSERT INTO 	 `"._DB_NAME."`.`tblWarrantyClaim` 
					    (				`tblWarrantyClaim`.`CustomerId`, 
										`tblWarrantyClaim`.`WarrantyClaimREF`, 
										`tblWarrantyClaim`.`PumpType`,  
										`tblWarrantyClaim`.`PumpStatus`,  
										`tblWarrantyClaim`.`PumpStatusOther`, 
										`tblWarrantyClaim`.`PumpInstallation`,  
										`tblWarrantyClaim`.`PumpInstallationOther`,  
										`tblWarrantyClaim`.`PumpOperation`,  
										`tblWarrantyClaim`.`PumpProblemDescription`, 
										`tblWarrantyClaim`.`PumpProblemDescriptionOther`,
										`tblWarrantyClaim`.`PumpDistrubutor`,
					 					`tblWarrantyClaim`.`WarrantyProvider`,
										`tblWarrantyClaim`.`PumpModel`,
										`tblWarrantyClaim`.`PumpSERIAL`,
										`tblWarrantyClaim`.`PartyCOMPANY`,
										`tblWarrantyClaim`.`PartyTYPE`,
										`tblWarrantyClaim`.`PartyNAME`,
										`tblWarrantyClaim`.`PartyPHONE`			) 
		  			      VALUES( 				?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?		)");

		# bind results as mysqlnd driver is not istalled
        $Result->bind_param("ssssssssssssssssss",	$this->CUSTOMER_ID,
													$this->REF,
													$this->PUMP_TYPE,
													$this->PUMP_STATUS,
													$this->PUMP_STATUS_OTHER,
													$this->PUMP_INSTALLATION,
					                                $this->PUMP_INSTALLATION_OTHER,
                                                	$this->PUMP_OPERATION,
                                                	$this->PUMP_PROBLEM_DESCRIPTION,
                                               		$this->PUMP_PROBLEM_DESCRIPTION_OTHER,
                                                	$this->DISTRIBUTOR,
                                                	$this->PUMP_PROVIDER,
													$this->PUMP_MODEL,
													$this->PUMP_SERIAL,
													$this->PARTY_COMPANY,
													$this->PARTY_TYPE,
													$this->PARTY_NAME,
													$this->PARTY_PHONE 	);		
		
		# run query
        $Result->execute();	
			
		# redurect to  images with insert record id	
		header('location: ' . _BASE_URL . '/warranty/UploadImages.php?id='.$Result->insert_id);

	}


	/* execiute check admin section */
	function ExecuteCheckAdminSectionClaim(){
		
		# build query to check if database entry already exist
		$Result=DBi::$conn->prepare ("	SELECT   ClaimID FROM  `"._DB_NAME."`.`tblWarrantyClaimAdmin`  WHERE ClaimID = ?    ");
		$Result->bind_param("s",$_REQUEST['ClaimID']);
        $Result->execute();
        $Result->store_result();

        # if entry exist update table otherwise insert new content
        if ($Result->num_rows == 1 ){	
	
			# update tables
			$this->ExecuteUpdateAdminSectionClaim();

			#upload files
			if ($_FILES['ADMIN_PUMP_IMAGE']['size'][0] >= 1) {
			
				# run upload
				$this->ExecuteUploadAdminSectionImages();
			}
				
		}else{

			# insert into table 
			$this->ExecuteCreateAdminSectionClaim();
		}
	}
	

	/* create new warranty ADMIN entry */ 
	function ExecuteCreateAdminSectionClaim(){
		
		# build  query
		$Result=DBi::$conn->prepare ("	INSERT INTO	 `"._DB_NAME."`.`tblWarrantyClaimAdmin`	
					    			(				        		`tblWarrantyClaimAdmin`.`ClaimID`,
																	`tblWarrantyClaimAdmin`.`ProviderTWO`,
																	`tblWarrantyClaimAdmin`.`CodePumpDATE`,		
																	`tblWarrantyClaimAdmin`.`CodeMotorDATE`,
																    `tblWarrantyClaimAdmin`.`ServiceTag`,
                                                                	`tblWarrantyClaimAdmin`.`ReportID`,
                                                                	`tblWarrantyClaimAdmin`.`RepairBOOL`,
                                                                	`tblWarrantyClaimAdmin`.`FiledBOOL`,
                                                                	`tblWarrantyClaimAdmin`.`ShippedTYPE`,
                                                                	`tblWarrantyClaimAdmin`.`TrackingBOL`,
                                                                	`tblWarrantyClaimAdmin`.`ChargeNumbers`,
                                                                	`tblWarrantyClaimAdmin`.`ReturnedDATE`	)	
																	VALUES (	?,?,?,?,?,?,?,?,?,?,?,?		)	");



		# set variables query
		$Result->bind_param("ssssssssssss",		$_REQUEST['ClaimID'],
												$this->ADMIN_PUMP_PROVIDER_TWO,
                                                $this->ADMIN_PUMP_CODE_DATE,
                                                $this->ADMIN_PUMP_MOTOR_CODE_DATE,
                                                $this->ADMIN_PUMP_SERVICE_TAG,
                                                $this->ADMIN_PUMP_REPORT,
                                                $this->ADMIN_PUMP_REPAIR_BOOL,
                                                $this->ADMIN_PUMP_FILED_BOOL,
                                                $this->ADMIN_PUMP_SHIPPED,
                                                $this->ADMIN_PUMP_TRACKING_NUMBER,
                                                $this->ADMIN_PUMP_CHARGERS,
                                                $this->ADMIN_PUMP_RETURENED_DATE 	);

		# run query
		$Result->execute();	
	}



	/* update ADMIN */	
	function ExecuteUpdateAdminSectionClaim(){
	
		# get admin information from claim-admin table
        $Result =DBi::$conn->prepare("  UPDATE   `"._DB_NAME."`.`tblWarrantyClaimAdmin`
                                        SET                     `tblWarrantyClaimAdmin`.`ProviderTWO`   = ?,
                                                                `tblWarrantyClaimAdmin`.`CodePumpDATE`  = ?,
                                                                `tblWarrantyClaimAdmin`.`CodeMotorDATE` = ?,
                                                                `tblWarrantyClaimAdmin`.`ServiceTag`    = ?,
                                                                `tblWarrantyClaimAdmin`.`ReportID`      = ?,
                                                                `tblWarrantyClaimAdmin`.`RepairBOOL`    = ?,
                                                                `tblWarrantyClaimAdmin`.`FiledBOOL`     = ?,
                                                                `tblWarrantyClaimAdmin`.`ShippedTYPE`	= ?,
                                                                `tblWarrantyClaimAdmin`.`TrackingBOL`   = ?,
                                                                `tblWarrantyClaimAdmin`.`ChargeNumbers` = ?,
                                                                `tblWarrantyClaimAdmin`.`ReturnedDATE`  = ?
                                        WHERE                   `tblWarrantyClaimAdmin`.`ClaimID`       = ?     " );



        $Result->bind_param("ssssssssssss", 	$this->ADMIN_PUMP_PROVIDER_TWO,
                                                $this->ADMIN_PUMP_CODE_DATE,
                                                $this->ADMIN_PUMP_MOTOR_CODE_DATE,
                                                $this->ADMIN_PUMP_SERVICE_TAG,
                                                $this->ADMIN_PUMP_REPORT,
                                                $this->ADMIN_PUMP_REPAIR_BOOL,
                                                $this->ADMIN_PUMP_FILED_BOOL,
                                                $this->ADMIN_PUMP_SHIPPED,
                                                $this->ADMIN_PUMP_TRACKING_NUMBER,
                                                $this->ADMIN_PUMP_CHARGERS,
                                                $this->ADMIN_PUMP_RETURENED_DATE,
                                                $_REQUEST['ClaimID']            );
        # run query
        $Result->execute();
		
		
	}

	/* upload image for admin*/
	function ExecuteUploadAdminSectionImages(){

		#  Set varibles ready to deal with file upload - count, array, basename, temp and final name and path 
		$this->TOTAL 		=	count($_FILES['ADMIN_PUMP_IMAGE']['name']);
		$this->IMAGE_ARRAY 	=  	array();
		$this->RAND  		=	mt_rand(1,1100000);
		$this->BASENAME 	=	basename($this->RAND);

		# process each $_FILE input and process to upload 
		for($i=0; $i < $this->TOTAL; $i++) {
  			
  			# file naming and path
  			$this->FILE_PATH 		=	$_FILES['ADMIN_PUMP_IMAGE']['tmp_name'][$i];
  			$this->FILE_NAME 		= 	$this->BASENAME.$_FILES['ADMIN_PUMP_IMAGE']['name'][$i];
			$this->NEW_FILE_PATH	=	$_SERVER['DOCUMENT_ROOT']."/images/productImages/".$this->FILE_NAME;
			$this->IMAGE_ARRAY[] 	= 	$this->FILE_NAME;

    		# do file upload
    		move_uploaded_file($this->FILE_PATH, $this->NEW_FILE_PATH);
		}

		# execute function to update database with new images - upto 10 images per entry
		$this->ExecuteInsertAdminSectionImages();
	}


	function ExecuteInsertAdminSectionImages(){
		if (isset($this->IMAGE_ARRAY)){

			# arrange new data set to insert onto database
			$this->NEW_IMAGE_SET	=	implode("|", $this->IMAGE_ARRAY);

			# build  query and update field with image set
			$Result=DBi::$conn->prepare ("	UPDATE 	`"._DB_NAME."`.`tblWarrantyClaimAdmin`	
											SET					   `tblWarrantyClaimAdmin`.`ClaimAdminIMAGES` 	= ? 
											WHERE                  `tblWarrantyClaimAdmin`.`ClaimID`       	= ?");	

			$Result->bind_param("ss",	$this->NEW_IMAGE_SET,$_REQUEST['ClaimID'] );
			$Result->execute();

		}

	}

	function ViewAdminImages(){
		
		# fun function to check for admin image field content
		$this->ExecuteAdminImage();

		foreach ($this->IMAGE_SET as $key => $value) {
				echo "<a href='/images/productImages/$value' target='_blank'>". $value."<br/>";
			}	
	}


	/* data base call to fetch image string and arrange to return array before displaying results */
	function ExecuteAdminImage(){
		# check for provider credentials based on $_POST[] fields
        $Result=DBi::$conn->prepare("SELECT					   `tblWarrantyClaimAdmin`.`ClaimAdminIMAGES`				 
                                     FROM 		`"._DB_NAME."`.`tblWarrantyClaimAdmin`
                                     WHERE        			   `tblWarrantyClaimAdmin`.`ClaimID`	 		= ?");
	
		$Result->bind_param("s",$this->CLAIM_ID);
		$Result->execute();
		$Result->store_result();

        # check for valid return and set $VARS to session
        if ($Result->num_rows == 1 ){
			
			$Result->bind_result($this->CLAIM_IMAGE_SET);
           	$Result->fetch();
 
 			# explode results before returning - next function will display the result set
			$this->IMAGE_SET = explode('|', $this->CLAIM_IMAGE_SET);

		}

		# return full array
		return $this->IMAGE_SET;

	}


	/* view send rma */
	function ViewRMA(){
		
		# set notification to load
		$this->NOTIFICATION_TYPE = "RMA";

		# get rma information or create new entry
		$this->ExecuteRMA();
		
		# check for post 
		if(isset($_POST)){
		
        		# update as RMA to execute 
        		if (isset($_POST['SEND_RMA'])){ 

				# update rma information for claim
				$this->ExecuteUpdateRMA();
			
				# update claim step - status
                                $this->ExecuteCurrentStep('RMA SENT',$_REQUEST['ClaimID']);		
			
				# send rma notification
				$this->EmailNotification();
	
   			}
		}
	
		# call default view
		include("../includes/tpl/WarrantyViewRMA.tpl");
	}




	/* execute update to RMA */
	function ExecuteUpdateRMA(){
		$Result=DBi::$conn->prepare("   UPDATE          `"._DB_NAME."`.`tblReturnMerchandiseAuthorization`
                                                SET                            `tblReturnMerchandiseAuthorization`.`RmaDATE`                   = NOW(),
                                                                               `tblReturnMerchandiseAuthorization`.`RmaREVIEW`                 = 1,
                                                                               `tblReturnMerchandiseAuthorization`.`RmaNOTE`                   = ?,
                                                                               `tblReturnMerchandiseAuthorization`.`RmaInternalNOTE`           = ?
                                                 WHERE                         `tblReturnMerchandiseAuthorization`.`RmaID`                     = ?     ");

                                # bind results as mysqlnd driver is not istalled
                                $Result->bind_param("sss",$_POST['RECIPIENTS_NOTE'],$_POST['INTERNAL_NOTES'],$this->RMA_ID);

                                # execute
                                $Result->execute();
				
                                # redirect
                                header('location: ' . _BASE_URL . '/warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId=' . $_REQUEST['ClaimID'] . '');
	}




	/* execute rma information */
	function ExecuteRMA(){

		# check for user account in the db - admin access
		$Result=DBi::$conn->prepare("SELECT   `tblReturnMerchandiseAuthorization`.`RmaID`,
                                              `tblReturnMerchandiseAuthorization`.`RmaClaimID`,
                                		 DATE(`tblReturnMerchandiseAuthorization`.`RmaDATE`) AS RmaDATE,
										  	   `tblReturnMerchandiseAuthorization`.`RmaNOTE`,
                                               `tblReturnMerchandiseAuthorization`.`RmaWarranty`,
										  	   `tblReturnMerchandiseAuthorization`.`RmaAuthorizeTYPE`,
									     DATE(`tblReturnMerchandiseAuthorization`.`RmaAuthorizeDATE`) AS RmaAuthorizeDATE,
										  	  `tblReturnMerchandiseAuthorization`.`RmaAuthorizeDECISION`,
                                              `tblReturnMerchandiseAuthorization`.`RmaAuthorizeNOTE`,
                                              `tblReturnMerchandiseAuthorization`.`RmaInternalNOTE`,
										  	  `tblReturnMerchandiseAuthorization`.`RmaREVIEW`,
										      `tblReturnMerchandiseAuthorization`.`RmaAuthorizeREVIEW`,
                                              `tblWarrantyClaim`.`WarrantyClaimId`,
                                              `tblWarrantyClaim`.`CustomerId`,
										  	  `tblWarrantyClaim`.`PumpType`,
										      `tblCustomer`.`CustomerLoginID`,
										      `tblNotification`.`NotificationRECIPIENTS`,
										      `tblNotification`.`NotificationBODY`
                              		FROM      `"._DB_NAME."`.`tblReturnMerchandiseAuthorization`,
                                              `"._DB_NAME."`.`tblWarrantyClaim`,
								   			  `"._DB_NAME."`.`tblCustomer`,
								   			  `"._DB_NAME."`.`tblNotification`
                              		WHERE                    `tblReturnMerchandiseAuthorization`.`RmaClaimID`       		=     ?
                              		AND                      `tblWarrantyClaim`.`WarrantyClaimId`           				=     `tblReturnMerchandiseAuthorization`.`RmaClaimID`
									AND				         `tblWarrantyClaim`.`CustomerId`		 						=     `tblCustomer`.`CustomerID`
									AND				         `tblNotification`.`NotificationTYPE`		 					=      ?	");

		# bind results as mysqlnd driver is not istalled
		$Result->bind_param("ss",$_REQUEST['ClaimID'],$this->NOTIFICATION_TYPE);
		
		# run query
		$Result->execute();

		# store result
		$Result->store_result();

		# bind and set session
		if ($Result->num_rows == 1 ){
        		# bind results to user
        		$Result->bind_result(   $this->RMA_ID,
                        				$this->RMA_CLAIM_ID,
                                		$this->RMA_DATE,
                                       	$this->RMA_NOTE,
                                		$this->RMA_WARRANTY,
                                		$this->RMA_WARRANTY_TYPE,
                                		$this->RMA_AUTHORIZE_DATE,
                                		$this->RMA_AUTHORIZE_DECISON,
                                		$this->RMA_AUTHORIZE_NOTE,
										$this->RMA_INTERNAL_NOTE,
										$this->RMA_REVIEW,
										$this->RMA_AUTHORIZE_REVIEW,
										$this->WARRANTY_CLAIM_ID,
										$this->CUSTOMER_ID,
										$this->PUMP_TYPE,
										$this->CUSTOMER_EMAIL,
										$this->NOTIFICATION_RECIPIENTS,
										$this->NOTIFICATION_BODY      );

        	# fetch information
       	 	$Result->fetch();

		}
		if($Result->num_rows == 0 ){

        		# insert new rma
			$Result=DBi::$conn->prepare("INSERT INTO `"._DB_NAME."`.`tblReturnMerchandiseAuthorization` (`tblReturnMerchandiseAuthorization`.`RmaClaimID`) VALUES (?);");
			
			# bind results as mysqlnd driver is not istalled
			$Result->bind_param("s",$_REQUEST['ClaimID']);
			
			# run query
			$Result->execute();
			
			# redirect
			header('location: ' . _BASE_URL . '/' . $_SERVER['REQUEST_URI'] . '');	

		}		
	}



	
	 /* view authorize rma */
        function ViewAuthotizeRMA(){

		
		# set notification type
		$this->NOTIFICATION_TYPE = 'DEFAULT';
		
		# get rma information or create new one
		$this->ExecuteRMA();

		# check for post 
		if(isset($_POST)){

			# check for authorise to update
			if(isset($_POST['SEND_AUTHORIZE'])){
				
				# set notification type
				if(isset($_REQUEST['WARRANTY'])){
					if($_REQUEST['WARRANTY'] == 'APPROVED_WARRANTY'){	
						$this->NOTIFICATION_TYPE		= $_REQUEST['WARRANTY_TYPE'];
					}else{
						$this->NOTIFICATION_TYPE        = 'NO_WARRANTY';
					}
				}
				# send authorize notification
                                $this->EmailNotification();
			
				# update claim step - status
                                $this->ExecuteCurrentStep('CASE CLOSED',$_REQUEST['ClaimID']);
					
				# run update to rma entry
				$this->ExecuteUpdateAuthotizeRMA();

			}
		}
                # call default view
                include("../includes/tpl/WarrantyViewAuthorize.tpl");

        }

	function ExecuteUpdateAuthotizeRMA(){

		# set query to  update on RMA entry 
		$Result=DBi::$conn->prepare("   UPDATE          `"._DB_NAME."`.`tblReturnMerchandiseAuthorization`
                                        SET                            `tblReturnMerchandiseAuthorization`.`RmaAuthorizeDATE`                   = NOW(),
                                                                       `tblReturnMerchandiseAuthorization`.`RmaAuthorizeREVIEW`                 = 1,
									       							   `tblReturnMerchandiseAuthorization`.`RmaWarranty`						= ?,
                                                                       `tblReturnMerchandiseAuthorization`.`RmaAuthorizeTYPE`                   = ?,
									       							   `tblReturnMerchandiseAuthorization`.`RmaAuthorizeDECISION`				= ?,
									       							   `tblReturnMerchandiseAuthorization`.`RmaAuthorizeNOTE`					= ?,
                                                                       `tblReturnMerchandiseAuthorization`.`RmaInternalNOTE`           			= ?
                                        WHERE                 		   `tblReturnMerchandiseAuthorization`.`RmaID`                     			= ?     ");

        # bind results as mysqlnd driver is not istalled
        $Result->bind_param("ssssss",	$_POST['WARRANTY'],
										$_POST['WARRANTY_TYPE'],
										$_POST['WARRANTY_DECISION'],
										$_POST['RECIPIENTS_NOTE'],
										$_POST['INTERNAL_NOTES'],
										$this->RMA_ID);

        # execute
        $Result->execute();

     	# redirect
     	header('location: ' . _BASE_URL . '/warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId=' . $_REQUEST['ClaimID'] . '');	

	} 
		


	/* view emails notifications */
	function ViewNotification(){
		
		//include("../includes/tpl/AdminViewNotification.tpl");
		
		if(isset($_POST)){
			if (isset($_POST['SAVE_NOTIFICATION'])){
				# execute updates
				$this->ExecuteUpdateNotification();
			}
		}

		# call default view
		include("../includes/tpl/AdminViewNotification.tpl");
	}


	/* update notification */
	function ExecuteUpdateNotification(){

		$this->NOTIFICATION_ACCOUNT_TYPE = array( "NEW_ACCOUNT"	=>array(substr($_POST['NOTIFICATION_TYPE_NEW_ACCOUNT'],1,-1)	,	$_POST['NOTIFICATION_BODY_NEW_ACCOUNT']),
					 		  "NEW_CLAIM"	=>array(substr($_POST['NOTIFICATION_TYPE_NEW_CLAIM'],1,-1)	,	$_POST['NOTIFICATION_BODY_NEW_CLAIM'])	, 
							  "NEW_PUMP"	=>array(substr($_POST['NOTIFICATION_TYPE_NEW_PUMP'],1,-1)	,	$_POST['NOTIFICATION_BODY_NEW_PUMP'])	,
							  "REPAIR_PUMP"	=>array(substr($_POST['NOTIFICATION_TYPE_REPAIR_PUMP'],1,-1)	,	$_POST['NOTIFICATION_BODY_REPAIR_PUMP']),
							  "CREDIT_NOTE"	=>array(substr($_POST['NOTIFICATION_TYPE_CREDIT_NOTE'],1,-1)	,	$_POST['NOTIFICATION_BODY_CREDIT_NOTE']),
							  "RMA"		=>array(substr($_POST['NOTIFICATION_TYPE_RMA'],1,-1)		,	$_POST['NOTIFICATION_BODY_RMA'])	,
							  "NO_WARRANTY"	=>array(substr($_POST['NOTIFICATION_TYPE_NO_WARRANTY'],1,-1)	,	$_POST['NOTIFICATION_BODY_NO_WARRANTY']));
	

		foreach($this->NOTIFICATION_ACCOUNT_TYPE AS $this->NOTIFICATION_KEY => $this->NOTIFICATION_ACCOUNT_TYPE_ITEM){

			//echo  $this->NOTIFICATION_ACCOUNT_TYPE_ITEM[1];
					
			$Result=DBi::$conn->prepare ("	SELECT 			`tblUser`.`UserEMAIL` 
							FROM 	 `"._DB_NAME."`.`tblUser` 
							WHERE 			`tblUser`.`UserFullNAME` IN (".$this->NOTIFICATION_ACCOUNT_TYPE_ITEM[0].")");
							

                	# run query
                	$Result->execute();

			
               		# store result
                	$Result->store_result();

			# create empty array
			$this->EMPTY_ARRAY = array();

		
                	# bind and set session
                	if ($Result->num_rows != 0 ){ 
                        	# bind results to user
                        	$Result->bind_result($this->NOTIFICATION_EMAIL);
			
                        	# fetch information
                        	while( $Result->fetch()){
			
					# set results into array to later sort
					$this->EMPTY_ARRAY[] .= $this->NOTIFICATION_EMAIL;	
						
				}

				#arrange for db update
				$this->NOTIFICATION_EMAIL_LIST = 	implode("|", $this->EMPTY_ARRAY);
				

				# update database with new email list
				$Result_1=DBi::$conn->prepare ("UPDATE 	`"._DB_NAME."`.`tblNotification` 
								SET 		       `tblNotification`.`NotificationRECIPIENTS` = ?,
										       `tblNotification`.`NotificationBODY` 	  = ?  
								WHERE 		       `tblNotification`.`NotificationTYPE`	  = ?	");


				 # bind results as mysqlnd driver is not istalled
                                $Result_1->bind_param("sss",   $this->NOTIFICATION_EMAIL_LIST,
                                                               $this->NOTIFICATION_ACCOUNT_TYPE_ITEM[1],
                                                               $this->NOTIFICATION_KEY);
				
				#run query 
				$Result_1->execute();
				
			}
		}
	}
	



	/* fetch latest claim id based on email */
	function LatestClaimByUser(){
		
		#check for claim id based on user email
		$Result=DBi::$conn->prepare("	SELECT 
								  	    MAX(`tblWarrantyClaim`.`WarrantyClaimId`) AS CLAIM_LATEST_ID
						FROM 		 `"._DB_NAME."`.`tblWarrantyClaim` 
						JOIN 		 `"._DB_NAME."`.`tblCustomer` 
						ON 				`tblWarrantyClaim`.`CustomerId` 	= 	`tblCustomer`.`CustomerID`
						WHERE  				`tblCustomer`.`CustomerLoginID` 	= 	 ?		"); 

		
		# bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$this->CUSTOMER_EMAIL);

                # run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows == 1 ){
                        # bind results to user
                        $Result->bind_result($this->CLAIM_LATEST_ID);
		
			# fetch
			$Result->fetch();
		}
	}




	/* save notification messages to db*/
	function ExecuteNotification(){
		
		# check for user account in the db - admin access
        	$Result=DBi::$conn->prepare("SELECT * FROM  `"._DB_NAME."`.`tblNotification` WHERE `tblNotification`.`NotificationTYPE` <> 'DEFAULT'");


                # run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows != 0 ){
                        # bind results to user
                        $Result->bind_result(   $this->NOTIFCATION_ID,
                                                $this->NOTIFICATION_TYPE,
                                                $this->NOTIFICATION_RECIPIENTS,
                                                $this->NOTIFICATION_BODY	);
                        # fetch information
                	while( $Result->fetch()){
				echo "<tr>";
                       		echo "<th>$this->NOTIFICATION_TYPE</th>";
                        	echo "<td style='width:190px;'>";
				echo "<input	 class='form-control' name='NOTIFICATION_TYPE_".$this->NOTIFICATION_TYPE."' id='NOTIFICATION_TYPE_".$this->NOTIFICATION_TYPE."' type='input' value=''>";
				echo "</td>";
                        	echo "<td>";
				echo "<textarea   class='form-control' name='NOTIFICATION_BODY_".$this->NOTIFICATION_TYPE."' id='NOTIFICATION_BODY_".$this->NOTIFICATION_TYPE."' rows='4'  cols='60'>$this->NOTIFICATION_BODY</textarea></td>";
                		echo "</tr>";

			}
		}
	}




	/* create dropdown list of current active vendors */
	function ExecuteProviderList($SELECTED){
		
		# check for providers in db	
		$Result	= DBi::$conn->prepare("SELECT 			       `tblProvider`.`ProviderID`,
									       `tblProvider`.`ProviderNAME`
                                               FROM 		`"._DB_NAME."`.`tblProvider`
                                               WHERE 			       `tblProvider`.`ProviderSTATUS` = 1");

		# run query
                $Result->execute();

		# bind results
		$Result->bind_result($this->PROVIDER_ID, $this->PROVIDER_NAME);		

		# start select return
		$return  = "<select name='PUMP_PROVIDER' class='form-control' required>";
		$return .= "<option value='' selected style='display:none;'>[PROVIDER]</option>";		
		# fetch information
                while ($Result->fetch()){
		        # create list   	
			$return .=  "<option value='".$this->PROVIDER_ID."'". $this->SelectedOption($this->PROVIDER_ID,$SELECTED).">".$this->PROVIDER_NAME."</option>";
		}
		$return .= "</select>";	
		
		# print to screen
		print $return;
	}

	
	
	 /* create dropdown list of current active vendors for admin - PROVIDER Two */
        function ExecuteProviderListTwo($SELECTED){

                # check for providers in db
                $Result = DBi::$conn->prepare("SELECT                          `tblProvider`.`ProviderID`,
                                                                               `tblProvider`.`ProviderNAME`
                                               FROM             `"._DB_NAME."`.`tblProvider`
                                               WHERE                           `tblProvider`.`ProviderSTATUS` = 1");

                # run query
                $Result->execute();

                # bind results
                $Result->bind_result($this->PROVIDER_ID, $this->PROVIDER_NAME);

                # start select return
                $return  = "<select name='ADMIN_PUMP_PROVIDER_TWO' class='form-control' required>";
                $return .= "<option value='' selected style='display:none;'>[PROVIDER]</option>";
                # fetch information
                while ($Result->fetch()){
                        # create list
                        $return .=  "<option value='".$this->PROVIDER_ID."'". $this->SelectedOption($this->PROVIDER_ID,$SELECTED).">".$this->PROVIDER_NAME."</option>";
                }
                $return .= "</select>";

                # print to screen
                print $return;
        }

	
	

	
	/* view claims by status or default view */
	 function ViewClaimsList(){
	 	if (empty($_GET)) {
	 				
	 		# call default view tpl
			include("../includes/tpl/WarrantyViewClaimsList.tpl");
		 }
		 if (@$_REQUEST['ViewClaimDetails'] == 1 AND !empty($_REQUEST['WarrantyClaimId']) AND empty($_REQUEST['StartClaim'])) {
			
			# call for variables 
			$this->ExecuteClaimListDetails();

			# call detailed view tpl
			include("../includes/tpl/WarrantyViewClaimsDetails.tpl");

		 }
		 
	 }



	
	/* all claims to be view and see status */
	 function ExecuteClaimsList(){
	 	# create querry to select all fields
	 	$Result=DBi::$conn->prepare("SELECT 		 	`tblWarrantyClaim`.`WarrantyClaimId`,
								   date(`tblWarrantyClaim`.`WarrantyClaimDate`)  AS WarrantyClaimDate,
									`tblWarrantyClaim`.`PumpType`,
									`tblWarrantyClaim`.`ClaimStatus`,
								   date(`tblWarrantyClaim`.`TechServiceWorkDate`) AS TechServiceWorkDate,
									`tblWarrantyClaim`.`TechId`,
									`tblWarrantyClaim`.`CustomerId`	 
					     FROM 	 `"._DB_NAME."`.`tblWarrantyClaim`			");
		
		# run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows > 0 ){

			# bind results to user
                        $Result->bind_result(	$this->WarrantyClaimID, 
						$this->WarrantyClaimDATE, 
						$this->WarrantyPumpTYPE,
						$this->WarrantyClaimSTATUS,
						$this->WarrantyServiceDATE,
						$this->WarrantyTechID,
						$this->WarrantyCustomerID	);
			
			# create empty return
			$return = "";		
		
			# fetch information
                        while ($Result->fetch()){
				$return .= "<tr>";
				$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->WarrantyClaimID."</a></td>";
				$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->WarrantyClaimDATE."</a></td>";
			 	$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->WarrantyPumpTYPE."</a></td>";
				$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->WarrantyClaimSTATUS."</a></td>";
				$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->WarrantyServiceDATE."</a></td>";
				$return .= "<td align='center'><a href='?ViewClaimDetails=1&WarrantyClaimId=".$this->WarrantyClaimID."'>" .$this->ExecuteTechName($this->WarrantyTechID)."</a></td>";
				$return .= "<td align='center'><a href='/includes/ProductPDF.php?claimid=".$this->WarrantyClaimID."' target='_blank'>Download</a></td>";
				$return .= "</tr>";
			} 	
	 	}
		print $return;
	}



	
	/* get claim details */
	 function ExecuteClaimListDetails(){
		 
	 	# creare sql string to fetch all warranty details	
	 	$Result_Fetch =DBi::$conn->query("SELECT *,			       date(`tblWarrantyClaim`.`WarrantyClaimDate`) AS WarrantyClaimDate
						  FROM			`"._DB_NAME."`.`tblWarrantyClaim`,
									`"._DB_NAME."`.`tblCustomer` 
						  WHERE 			       `tblWarrantyClaim`.`WarrantyClaimId` = ".$_REQUEST['WarrantyClaimId']."
						  AND				       `tblWarrantyClaim`.`CustomerId` = `tblCustomer`.`CustomerID`");
		

		# parse
		while ($Result_FetchArray = mysqli_fetch_object($Result_Fetch) ){
		

			# sort data to display
			$operation = explode("|",$Result_FetchArray->PumpOperation);		
				

			# print resutls to screen
				
			$this->CLAIM_BAR_CODE 	= "<img alt='$Result_FetchArray->WarrantyClaimId' src='../includes/barcode/barcode.php?size=20&text=$Result_FetchArray->WarrantyClaimId'/>";
			$this->CLAIM_ID		 = $Result_FetchArray->WarrantyClaimId;
			$this->CLAIM_CUSTOMER_ID = $Result_FetchArray->CustomerId;
			$this->CLAIM_DATE	 = $Result_FetchArray->WarrantyClaimDate;
			$this->CLAIM_PUMP_TYPE   = $Result_FetchArray->PumpType;
			$this->CLAIM_REF	 = $Result_FetchArray->WarrantyClaimREF;
			$this->CLAIM_CUSTOMER_NAME  	= $Result_FetchArray->CustomerFullNAME;
			$this->CLAIM_CUSTOMER_EMAIL 	= $Result_FetchArray->CustomerLoginID;
			$this->CLAIM_CUSTOMER_ADDRESS 	= $Result_FetchArray->CustomerADDRESS;
			$this->CLAIM_CUSTOMER_CITY 	= $Result_FetchArray->CustomerCITY;
			$this->CLAIM_CUSTOMER_ZIP	= $Result_FetchArray->CustomerZipCODE; 
			$this->CLAIM_CUSTOMER_PHONE	= $Result_FetchArray->CustomerPHONE;
			$this->CLAIM_PUMP_STATUS	= $Result_FetchArray->PumpStatus;
			$this->CLAIM_PUMP_STATUS_OTHER  = $Result_FetchArray->PumpStatusOther;
			$this->CLAIM_PUMP_INSTALLATION  = $Result_FetchArray->PumpInstallation;
			$this->CLAIM_PUMP_OPERATION	= "PSI: " . $operation[0] . " GPM: " . $operation[1] . " FLUID: " . $operation[2];
			$this->CLAIM_PUMP_INSTALLATION_OTHER  	    = $Result_FetchArray->PumpInstallationOther;
			$this->CLAIM_PUMP_PROBLEM_DESCRIPTION 	    = $Result_FetchArray->PumpProblemDescription;
			$this->CLAIM_PUMP_PROBLEM_DESCRIPTION_OTHER = $Result_FetchArray->PumpProblemDescriptionOther;
		}
	}




	/* view customer claim list */
	 function ViewCustomerClaimsList(){
		 # call default view tpl
                 include("../includes/tpl/WarrantyViewCustomerClaimsList.tpl");
	}




	/* execute call for customers' claims*/
	function ExecuteCustomerClaimsList(){

		# create querry to select all fields
                $ClaimRun =DBi::$conn->query("SELECT * FROM  `"._DB_NAME."`.`tblWarrantyClaim` 
					      WHERE 			    `tblWarrantyClaim`.`CustomerId` = '".$_SESSION['customerid']."'");

                # fetch customer values to use
                while ($Result_ClaimRun = mysqli_fetch_object($ClaimRun)){
                        echo "<tr>";
                        echo "<td align='center'>".$Result_ClaimRun->WarrantyClaimId."</a></td>";
                        echo "<td align='center'>".$Result_ClaimRun->WarrantyClaimDate."</a></td>";
                        echo "<td align='center'>".$Result_ClaimRun->PumpType."</a></td>";
                        echo "<td align='center'>".$Result_ClaimRun->ClaimStatus."</a></td>";
                        echo "<td align='center'>".$Result_ClaimRun->TechServiceWorkDate."</a></td>";
                        echo "<td align='center'><a href='/includes/ProductPDF.php?claimid=".$Result_ClaimRun->WarrantyClaimId."' target='_blank'>Download</a></td>";
                        echo "</tr>";
                }
	
	}




	 /* view provider claim list */
         function ViewProviderClaimsList(){

                 # call default view tpl
		 include("../includes/tpl/WarrantyViewProviderClaimsList.tpl");
        }



	 /* execute call for provider' claims*/
        function ExecuteProviderClaimsList(){

                # create querry to select all fields
                $ClaimRun =DBi::$conn->query("SELECT * FROM  `"._DB_NAME."`.`tblWarrantyClaim`
                                              WHERE                         `tblWarrantyClaim`.`WarrantyProvider` = '".$_SESSION['ProviderID']."'");

                # fetch customer values to use
                while ($Result_ClaimRun = mysqli_fetch_object($ClaimRun)){
                        echo "<tr>";
                        echo "<td align='center'>".$Result_ClaimRun->WarrantyClaimId."</a></td>";
                        echo "<td align='center'>".date('m/j/Y',strtotime($Result_ClaimRun->WarrantyClaimDate))."</a></td>";
                        echo "<td align='center'>".$Result_ClaimRun->PumpType."</a></td>";
                        //echo "<td align='center'>".$this->CheckClaimStatus($Result_ClaimRun->ClaimStatus)."</a></td>";
                        //echo "<td align='center'>".$Result_ClaimRun->TechServiceWorkDate."</a></td>";
                        echo "<td align='center'><a href='/includes/ProviderProductPDF.php?claimid=".$Result_ClaimRun->WarrantyClaimId."' target='_blank'>Download</a></td>";
                        echo "</tr>";
                }

        }

	



	/* view users list */
	function ViewUsersList(){ 
		#call defaul users view 
		 include("../includes/tpl/ViewUsers.tpl");
	}




	/* view customers list*/
	function ExecuteViewUsersList(){
	
		 $ClaimRun =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblUser` ORDER BY `tblUser`.`UserID` ASC");
                while ($Result_ClaimRun = mysqli_fetch_array($ClaimRun)){
                        echo "<tr>";
                        echo '<td align="center">'.$Result_ClaimRun["UserNAME"].'</td>';
                        echo '<td align="center">'.$Result_ClaimRun["UserFullNAME"].'</td>';
			echo '<td align="center">'.$Result_ClaimRun["UserEMAIL"].'</td>';
                        echo '<td align="center">'.$this->Status($Result_ClaimRun["UserSTATUS"]).'</td>';
                        echo '<td align="center">
                                <a href="'._BASE_URL.'/users/Delete.php?UserID='.$Result_ClaimRun["UserID"].'" class="btn btn-danger" ><i class="fa fa-trash-o fa-lg"></i></a>
                                <a href="'._BASE_URL.'/users/EditUsers.php?UserID='.$Result_ClaimRun["UserID"].'" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="'._BASE_URL.'/users/Disable.php?UserID='.$Result_ClaimRun["UserID"].'" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></a>
                        </td>';
                        echo "</tr>";
                }

	}




	/* view cutomers list */
	function ViewCustomersList(){
		 # call default customers view
                 include("../includes/tpl/ViewCustomers.tpl");
	}




	/* execute call for customer list */
	function ExecuteViewCustomersList(){
		# build  query to fetch customers
		$ClaimRun =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblCustomer`");
               
		 # parse data with loop
		while ($Result_ClaimRun = mysqli_fetch_array($ClaimRun)){
                        echo "<tr>";
                        echo '<td align="center">'.$Result_ClaimRun["CustomerLoginID"].'</td>';
                        echo '<td align="center">'.$Result_ClaimRun["CustomerFullNAME"].'</td>';
                        echo '<td align="center">'.$this->Status($Result_ClaimRun["CustomerSTATUS"]).'</td>';
                        echo '<td align="center">
                                <!-- <a href="'._BASE_URL.'/users/Delete.php?CustomerID='.$Result_ClaimRun["CustomerID"].'" class="btn btn-danger" ><i class="fa fa-trash-o fa-lg"></i></a>// COMMENTED OUT -->
                                <a href="'._BASE_URL.'/users/EditCustomers.php?CustomerID='.$Result_ClaimRun["CustomerID"].'" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="'._BASE_URL.'/users/Disable.php?CustomerID='.$Result_ClaimRun["CustomerID"].'" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></a>
                        </td>';
                        echo "</tr>";
		
		}
	}



	
	/* view provider list  */
	function ViewProvidersList(){
		#include default providers list
	 	include("../includes/tpl/ViewProviders.tpl");
	}



	
	/* execute call for providers list */
	function ExecuteViewProvidersList(){
		$ClaimsSQL =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblProvider`");
                # fetch customer values to use
                while ($Result_ClaimRun = mysqli_fetch_array($ClaimsSQL)){
                        echo "<tr>";
                        echo '<td align="center">'.$Result_ClaimRun["ProviderNAME"].'</td>';
                        echo '<td align="center">'.$this->Status($Result_ClaimRun["ProviderSTATUS"]).'</td>';
                        echo '<td align="center">
                                <a href="'._BASE_URL.'/users/Delete.php?ProviderID='.$Result_ClaimRun["ProviderID"].'" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
                                <a href="'._BASE_URL.'/users/EditProviders.php?ProviderID='.$Result_ClaimRun["ProviderID"].'" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="'._BASE_URL.'/users/Disable.php?ProviderID='.$Result_ClaimRun["ProviderID"].'" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></a>
                              </td>';
                        echo "</tr>";
                }


	}		



	
	/* call template for tech view */
	function ViewTechUserList(){

		# call defail view for techusers
		include("../includes/tpl/ViewTechUsers.tpl");
	} 




	/* fetch querty for all tech user from db*/
	function ExecuteViewTechUserList(){

		# build query 
		$techuser=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblTech`");

        	# fetch customer values to use
        	while ($Result_ClaimRun = mysqli_fetch_array($techuser)){
        		
			# create html return 
                        echo "<tr>";
                        echo '<td align="center">'.$Result_ClaimRun["TechUserNAME"].'</td>';
			echo '<td align="center">'.$Result_ClaimRun["TechFullNAME"].'</td>';
                        echo '<td align="center">'.$this->Status($Result_ClaimRun["TechSTATUS"]).'</td>';
                        echo '<td align="center">
                                <a href="'._BASE_URL.'/users/Delete.php?TechID='.$Result_ClaimRun["TechID"].'" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
                                <a href="'._BASE_URL.'/users/EditTechUsers.php?TechID='.$Result_ClaimRun["TechID"].'" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i></a>
                                <a href="'._BASE_URL.'/users/Disable.php?TechID='.$Result_ClaimRun["TechID"].'" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></a>
                             </td>';
                        echo "</tr>";
                }
	} 




	/* servuce  start or continue option */
	function StartContinueWork(){

		# build query to check start date 
                $claimstatus=DBi::$conn->query("SELECT 					  	 `tblWarrantyClaim`.`ClaimStatus`,
												 `tblWarrantyClaim`.`WarrantyClaimId`,
												 `tblWarrantyClaim`.`ClaimREVIEW`, 
												 `tblWarrantyClaim`.`CustomerId`,
												 `tblReturnMerchandiseAuthorization`.`RmaREVIEW`,
												 `tblReturnMerchandiseAuthorization`.`RmaAuthorizeREVIEW`,
												 `tblWarrantyRepairServiceForm`.`RepairREVIEW`
						FROM 				  `"._DB_NAME."`.`tblWarrantyClaim`
						LEFT JOIN 			  `"._DB_NAME."`.`tblReturnMerchandiseAuthorization`  
						ON						 `tblWarrantyClaim`.`WarrantyClaimId` = `tblReturnMerchandiseAuthorization`.`RmaClaimID`
						LEFT JOIN			  `"._DB_NAME."`.`tblWarrantyRepairServiceForm`
						ON				 		 `tblWarrantyClaim`.`WarrantyClaimId` = `tblWarrantyRepairServiceForm`.`ClaimID`	
						WHERE 				 		 `tblWarrantyClaim`.`WarrantyClaimId` =  {$_GET['WarrantyClaimId']}	");
		
		# fetch customer values to use
                while ($Result_ClaimRun = mysqli_fetch_array($claimstatus)){
			
			$current = array('INSPECTION IN PROGRESS');

			if(in_array($Result_ClaimRun["ClaimStatus"], $current) AND isset($_SESSION['tech_id']) ){
				$return = "<input type='submit' class='btn btn-primary btn-block' value='Continue Work'>";
			}elseif(isset($_SESSION['cid']) AND !isset($_SESSION['tech_id'])){
				$return  = "<div style='float:left;  width:25%; padding-left:0px;'>";
				$return .= "	<a  class='btn btn-primary btn-block' href='/warranty/EditClaimWarranty.php?ClaimID=".$Result_ClaimRun["WarrantyClaimId"]."&CustomerID=".$Result_ClaimRun["CustomerId"]."'>Review Claim ".$this->Reviewed($Result_ClaimRun["ClaimREVIEW"])."</a>";
				$return .= "</div>";
				$return .= "<div style='margin: 0 auto; display:inline-block; width:25%; padding-left:5px'>";
				$return .= "    <a class='btn btn-success btn-block' href='../warranty/ViewRMA.php?ClaimID=".$_REQUEST['WarrantyClaimId']."'>Send RMA ".$this->Reviewed($Result_ClaimRun["RmaREVIEW"])."</a>";

				$return .= "</div>";
				$return .= "<div style='margin: 0 auto; display:inline-block; width:25%; padding-left:5px'>";
				$return .= "    <a  class='btn btn-warning btn-block' href='#' onclick='document.form.submit();'>Review Work ".$this->Reviewed($Result_ClaimRun["RepairREVIEW"])."</a>";
				$return .= "</div>";
				$return .= "<div style='float:right; width:25%; padding-left:5px'>";
                                $return .= "    <a class='btn btn-danger btn-block' href='../warranty/ViewAuthorizeWarranty.php?ClaimID=".$_REQUEST['WarrantyClaimId']."'>Authorize Warranty ".$this->Reviewed($Result_ClaimRun["RmaAuthorizeREVIEW"])."</a>";
                                $return .= "</div>";	
			}elseif($Result_ClaimRun["ClaimStatus"] == 'RMA SENT'){
				$return  = "<input type='hidden' name='ITEM' value='TRUE'>";
				$return .= "<input type='submit' class='btn btn-blank btn-block' value='Item Received'>";
			}elseif(($Result_ClaimRun["ClaimStatus"] == 'ITEM RECEIVED')){
				$return = "<input type='submit' class='btn btn-success btn-block' value='Start Work'>";
			}else{
				$return = NULL;	
			}	
			
		}
		# return output
		print $return; 	
	}




	/* finalize review work button*/
	function FinalizeReviewWork(){
	
		if(!isset($_SESSION['tech_id'])){	
			$this->Return = "<input type='submit' name='step3' value='Finalize Review' class='btn btn-warning btn-block'>";
		}else{
			$this->Return = "<input type='submit' name='step3' value='Finalize Work'   class='btn btn-success btn-block'>";
		}		
		print $this->Return;
	}




	/* print right icon based on tech action and pump status */
	function CheckClaimStatus($value){
	 	# status return	
	 	if ($value == 'NOT STARTED') {
			$return  = "<div class='progress'>";
			$return .= "<div class='progress-bar progress-bar-danger progress-bar-striped' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' style='width:25%'>25%";
			$return .- "</div>";
			$return .= "</div>";
		}
		if ($value == 'ASSIGNED') {
			$return  = "<div class='progress'>";
			$return .= "<div class='progress-bar progress-bar-warning progress-bar-striped' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width:50%'>50%";
			$return .= "</div>";
			$return .= "</div>";
		}
		if ($value == 'STARTED') {
			$return  = "<div class='progress'>";
			$return .= "<div class='progress-bar progress-bar-info progress-bar-striped' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:75%'>75%";
			$return .= "</div>";
			$return .= "</div>";
		}
		if ($value == 'FINALIZED') {
			$return  = "<div class='progress'>";
			$return .= "<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'>100%";
			$return .= "</div>";
			$return .= "</div>";
		}
		# echo return
		return $return;	
	}




	/* custom error message */
	function ViewMesg(){
		
		# success message
		if(isset($_GET['SuccessMsg'])){
                	print "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a> <strong>".$_GET['SuccessMsg']."</strong></div>";
                }

		# error  message
		if(isset($_GET['ErrorMsg'])){
			print  "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>". $_GET['ErrorMsg']."></strong></div>";
		}
	}




	/* check or uncheck boxes based on result*/
	function CheckedOrNot($string,$array){
	
		# check for array and return to enabled check
        	if(in_array($string,$array)){
                	$this->Return = "checked";
			return $this->Return;
        	}
	}




	/* return check mark on reviewed steps */
	function Reviewed($Review){
			
		# return check mark
		if(isset($Review)) {
			if($Review >= 1){
				$this->Return = "<i class='fa fa-check'></i>";
				return $this->Return; 
			}
		}
	}	

	/* return check for status on accounts */
	function Status($Status){
		
		if(isset($Status)){
			if ($Status == 1 ){
				$this->Return = "<i class='fa fa-check'></i>";
			}else{
				$this->Return = "<i class='fa fa-times'></i>";	
			}
			# return
			return $this->Return;
		}
	}


	/* return tags to html */
	function ViewTags($TAG_TYPE){

		# set tag type
		$this->NOTIFICATION_TYPE = $TAG_TYPE;
		
		# get notification email list for tags  
                $this->ExecuteNotificationEmailList();
		
			
		# get tags to display 
		$this->ExecuteTags();
	
	}



	/* return tags for notification */
	function ExecuteTags(){
 
		# create querry to select all fields
                $Result=DBi::$conn->prepare(" SELECT          		`tblUser`.`UserFullNAME` 
					      FROM 	 `"._DB_NAME."`.`tblUser` 
					      WHERE 	 		`tblUser`.`UserEMAIL` IN ($this->NOTIFICATION_EMAIL_SET)	");


		# bind params - it is not allowinf pre prestructured data due to stripping tags '\    
		//$Result->bind_param("s",$this->NOTIFICATION_EMAIL_SET);		
	
                # run query
                $Result->execute();

                # store result
                $Result->store_result();
     
	        # bind and set session
                if ($Result->num_rows > 0 ){

                        # bind results to user
                        $Result->bind_result(   $this->NOTIFICATION_EMAIL_NAME );
		
			
                        # fetch information
                        while ($Result->fetch()){
				
				$this->NOTIFICATION_TAG_ARRAY[$this->NOTIFICATION_TYPE][] .= $this->NOTIFICATION_EMAIL_NAME;
			}

			# return 
			echo $this->NOTIFICATION_EMAIL_ITEMS = "'".implode("','",$this->NOTIFICATION_TAG_ARRAY[$this->NOTIFICATION_TYPE])."'";
		}
	}



	/*return tags by email */
	function ExecuteNotificationEmailList(){
		$Result=DBi::$conn->prepare(" SELECT   
							      DISTINCT(`tblNotification`.`NotificationRECIPIENTS`)
					      FROM      `"._DB_NAME."`.`tblNotification`  
					      WHERE 		       `tblNotification`.`NotificationTYPE` = ?	");


		
		# bind results as mysqlnd driver is not istalled
                $Result->bind_param("s",$this->NOTIFICATION_TYPE);
	
		# run query
                $Result->execute();

                # store result
                $Result->store_result();

                # bind and set session
                if ($Result->num_rows > 0 ){ 

                        # bind results to user
                        $Result->bind_result(  $this->NOTIFICATION_EMAIL_SET );

                        # fetch information
                        while ($Result->fetch()){
	
				# save into array to parse
                               $this->NOTIFICATION_EMAIL_ARRAY = explode("|", $this->NOTIFICATION_EMAIL_SET);

                        }
			# set value to run db query
			$this->NOTIFICATION_EMAIL_SET = "'".implode("','",$this->NOTIFICATION_EMAIL_ARRAY)."'";	
		}
	}




	/* return tech name based on id for claim list*/
	function ExecuteTechName($TechID){
				
		if(isset($TechID)){
			if (!empty($TechID)){
				$Result=DBi::$conn->prepare(" SELECT   
                        		                	              	       `tblTech`.`TechUserNAME`
                                		              FROM      `"._DB_NAME."`.`tblTech`  
                                        		      WHERE                    `tblTech`.`TechID` = ? ");


				# bind results as mysqlnd driver is not istalled
                		$Result->bind_param("s",$TechID);

               			# run query
                		$Result->execute();

				# store result
                		$Result->store_result();

                		# bind and set session
                		if ($Result->num_rows > 0 ){

                        		# bind results to user
                        		$Result->bind_result(  $this->TECH_NAME);

                        		# fetch information
                        		while ($Result->fetch()){
						return $this->TECH_NAME;
					}
				}
			}
		}	
	}


	/* update step */
	function ExecuteCurrentStep($WARRANTY_CLAIM_STEP_MESSAGE,$CLAIM_ID){
	
		# set to last step of inspection
                $Result=DBi::$conn->prepare("   UPDATE        `"._DB_NAME."`.`tblWarrantyClaim`
                                        	SET                          `tblWarrantyClaim`.`ClaimStatus`        = ?
                                        	WHERE                        `tblWarrantyClaim`.`WarrantyClaimId`    = ?	");
	
		 # bind results as mysqlnd driver is not istalled
                 $Result->bind_param("ss",   $WARRANTY_CLAIM_STEP_MESSAGE,
                                             $CLAIM_ID);

                #run query 
                $Result->execute();

	}



		
	/* create checked options from db */
	function Checked($String, $Pipped){
		
		# set values from db into array to search
		$Array	= 	explode( '|', $Pipped);

		# search for string in newly created array and return checked
		if(in_array($String,$Array)){
			$this->Return  = "checked";
			return $this->Return;	
		}
	}	



	/* select available options */
	function SelectedOption ($SelectedLIST, $AvailableID){
		
		#match string with input and return selected 
		if ($SelectedLIST ==  $AvailableID){
			$this->Return =  "selected";
			return $this->Return;
		}
		
	}



	/* create random password */
	function RandomPassword() {
 
		# values alphanumeric
   		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    		$pass = array(); //remember to declare $pass as an array
    		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		# parse to create randmon password
    		for ($i = 0; $i < 8; $i++) {
        		$n = rand(0, $alphaLength);
        		$pass[] = $alphabet[$n];
    		}

		# return password
    		return implode($pass); //turn the array into a string
	}

}
?>
