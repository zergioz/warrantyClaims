<?php
# start html class
class html{

	# create header for all pages
	public function header(){

		# send buffer with all pages	
		ob_start();
		
		# start header content	
		$header='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html" charset=windows-1252" />
					<title>Warranty Tracking System</title>

					<!-- Main Style -->
					<meta http-equiv="Content-Type" content="text/html" charset=windows-1252" />
					<link href="'._BASE_URL.'/includes/css/style.css"       rel="stylesheet" type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/layout.css"      rel="stylesheet" type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/orbit-1.2.3.css" rel="stylesheet" type="text/css"/>

					<!-- Boot Strap -->
					<link href="'._BASE_URL.'/includes/css/bootstrap.min.css"	  rel="stylesheet">   
					<link href="'._BASE_URL.'/includes/css/jquery.dataTables.min.css" rel="stylesheet">

					<script src="'._BASE_URL.'/includes/js/jquery.min.js" 		 type="text/javascript"></script>
					<script src="'._BASE_URL.'/includes/js/jquery.dataTables.min.js" type="text/javascript"></script>
					<script src="'._BASE_URL.'/includes/js/bootstrap.min.js"	 type="text/javascript"></script>
					<script src="'._BASE_URL.'/includes/js/bootstrap-filestyle.min.js" type="text/javascript"> </script>

					<!-- Autocomplete Tags -->
					<link href="'._BASE_URL.'/includes/css/textext/textext.core.css"  		rel="stylesheet"  type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/textext/textext.plugin.tags.css" 	rel="stylesheet"  type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/textext/textext.plugin.autocomplete.css" rel="stylesheet"  type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/textext/textext.plugin.focus.css"  	rel="stylesheet"  type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/textext/textext.plugin.prompt.css" 	rel="stylesheet"  type="text/css"/>
					<link href="'._BASE_URL.'/includes/css/textext/textext.plugin.arrow.css" 	rel="stylesheet"  type="text/css"/>


					<script src="'._BASE_URL.'/includes/js/textext/textext.core.js" 		type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.tags.js" 		type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.autocomplete.js" 	type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.suggestions.js" 	type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.filter.js" 	type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.focus.js" 	type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.prompt.js" 	type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.ajax.js" 		type="text/javascript" charset="utf-8"></script>
					<script src="'._BASE_URL.'/includes/js/textext/textext.plugin.arrow.js" 	type="text/javascript" charset="utf-8"></script>
			
					<!-- Font Awesome CSS Files-->
					<link href="'._BASE_URL.'/includes/css/font/css/font-awesome.css"  rel="stylesheet"  type="text/css"/>

					<!-- CSS fixes -->					
					<style> * { 	
							border-radius: 0px !important;
						}
						.alert{
    							text-align: center !important;
						}
						th {
    							text-align: center !important;
						}
						.btn-primary, .btn-success, .btn-info, .btn-warning, .btn-danger{
    							color: #FFF !important;
							font-family:"Lucida Grande","Lucida Sans Unicode","Lucida Sans","DejaVu Sans",Verdana,sans-serif !important
						}
						td, th {
    							padding: 0px;
    							vertical-align: middle !important;
						}
						ui-autocomplete, ui-menu, ui-widget, ui-widget-content, ui-corner-all {
							z-index: 1 !important;
    							display: block !important;
    							position: relative !important;
    							top: 0px !important;
    							left: 0px !important;
    							width: 0px !important;
    							z-index: 1 !important;
    							top: 0px !important;
    							left: 0px !important;
    							display: none !important;
    							position: relative !important;
    							width: 0px !important;
						}
						ul, ol {
    							background-color: white;
    							width: 550px !important;
							position: absolute !important;
							padding-left: 15px;
						}
						.text-core .text-wrap input {
    							width: 170px!important;
						}
						.panel{
							background-color:#FDFDF7!important;
						}
						.tit{

							text-align:left!important;
						}
						
					</style>
				                            
					<!-- Charts -->
					<script type="text/javascript" src="'._BASE_URL.'/includes/Chart.js/Chart.js"></script>

					<!-- AutoFill JS Call -->
					<!--	
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
					-->
					<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript"></script>
				
					
					<!-- website default setting -->

					<script type="text/javascript" src="'._BASE_URL.'/includes/js/scriptbreaker-multiple-accordion-1.js"></script>
					<script type="text/javascript" src="'._BASE_URL.'/includes/js/jquery.orbit-1.2.3.min.js"></script></head><body>
					
					<!-- Date Picker -->
					
					<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
					<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
					<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />';

		return $header;
	
	}
	
	# create footer for all pages
	public function footer(){
	
	$footer='<hr></hr>
		 <div id="divFooter">
			<p class="legal" style="font-size:smaller">
			Copyright  2015. PD Water Systems, LLC.<br />
			All Right Reserved.<br />
			<a href="http://www.linkedin.com/company/pd-water-systems" target="_blank"> 
				<img alt="Linkedin" border="0" src="'._BASE_URL.'/images/icon-linkedin.jpg"></a>
			<a href="https://twitter.com/PDWaterSystems" target="_blank"> 
				<img alt="Twitter" border="0" src="'._BASE_URL.'/images/icon-twitter.jpg"></a>
			<a href="https://www.facebook.com/PDWaterSystems" target="_blank">
				<img alt="Facebook" border="0" src="'._BASE_URL.'/images/icon-facebook.jpg"></a>
			</p>
			<div class="footOther">
				<div style="width: 33.00%; float:left;border:solid 1px;border-top:transpatent;border-bottom:transparent;border-left:transparent;border-top:transparent;font-size:smaller;padding-left:5px;">
					<strong>Corporate Info</strong>	<BR />
					<a href="http://www.pdwatersystems.com/TheCompany.aspx">The Company</a><BR />
					<a href="http://www.pdwatersystems.com/Partners.aspx">Partners</a><BR />
					<a href="http://www.pdwatersystems.com/Careers.aspx">Careers</a><BR />
				</div>	
				<div style="width: 33.00%;   display: inline-block;border:solid 1px;border-top:transpatent;border-bottom:transparent;border-left:transparent;border-top:transparent;font-size:smaller;padding-left:5px">
					<strong>Legal</strong>	<BR />
					<a href="http://www.pdwatersystems.com/TermsConditions.aspx">Terms & Conditions</a><BR />
					<a href="http://www.pdwatersystems.com/Privacy.aspx">Privacy Statement</a><BR />
					<a href="http://www.pdwatersystems.com/Warranty.aspx#WA">Warranty</a><BR />
				</div>
				<div style="width: 33.00%; float: right;font-size:smaller;padding-left:5px;">
					<strong>Customer Service</strong><BR />
					<a href="http://www.pdwatersystems.com/Downloads.aspx">Product Specifications</a><BR />
					<a href="http://www.pdwatersystems.com/Catalog.aspx">Catalog Downloads</a><BR />
					<a href="http://www.pdwatersystems.com/Contact.aspx">Contact Us</a><BR />
				</div>
				</div>
			
		</div>';
	
		return $footer;
	}
	



	# create side bar for guest - not logged-in 
	public function guestsidebar(){
	
		$guestsidebar='	<div id="divSidePanel">
				<div id="divLogo"><a href="http://warranty.pdwatersystems.com"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="auto" width="195px" /></a></div><br/><br/>
			   	<span class="Level0">Main Menu</span><br/>
				<!--<span class="Level1"><a href="http://www.pdwatersystems.com">Website</a></span><br />-->
				<span class="Level1"><img src="/images/icon-lock.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/home/Login.php">Login</a></span><br />
				<span class="Level1"><img src="/images/icon-pen.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/SubmitClaimWarranty.php">Create Claim</a></span>
				</div>';

		return $guestsidebar;	
	}




	# create sidebat for user - admin right
	public function usidebar(){
	
		$usidebar='<div id="divSidePanel">
				<div id="divLogo"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="100%" width="100%"></div><br/><br/>				
				<span class="Level0">Main Menu</span><br>
				<span class="Level1"><img src="/images/icon-snapshot.jpg" alt="" width="16" height="16"> <a href="'._BASE_URL.'/home/index.php">Live Snapshot</a></span><br>
				<span class="Level1"><img src="/images/icon-lock.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/home/Logout.php">Logout</a></span><br/><br/>
				<span class="Level0">Warranties</span><br>
				<span class="Level1"><img src="/images/icon-pen.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/SubmitClaimWarranty.php">Create Claim</a></span><br/>
				<span class="Level1"><img src="/images/icon-glass.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/ViewClaimWarranty.php">View Claims</a></span><br/><br/>
				<span class="Level0">Users</span><br>
				<span class="Level1"><img src="/images/icon-user.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/users/ViewUsers.php">View Users</a></span><br>
				<span class="Level1"><img src="/images/icon-customer.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/users/ViewCustomers.php">View Customers</a></span><br/>
				<span class="Level1"><img src="/images/icon-provider.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/users/ViewProviders.php">View Providers</a></span><br/>
				<span class="Level1"><img src="/images/icon-technician.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/users/ViewTechUsers.php">View Technicians</a></span><br/><br/>
				<span class="Level0">Admin</span><br>
				<span class="Level1"><img src="/images/icon-notifications.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/admin/Notification.php">Notifications</a></span><br>
				<span class="Level1"><img src="/images/icon-disk.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/admin/BackupDB.php">Backup DB</a></span><br>
				<span class="Level1"><img src="/images/icon-snapshot.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/admin/Reports.php">Reports</a></span><br>	
	</div>';
		return $usidebar;	
	
	}
	
	# create side bar for client 
	public function csidebar(){
	
		$csidebar='<div id="divSidePanel">
				<div id="divLogo"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="100%" width="auto"></div>				
				<span class="Level0">Main Menu</span><br/>
				<span class="Level1"><img src="/images/icon-pen.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/SubmitClaimWarranty.php">Create Claim</a></span><br>
				<span class="Level1"><img src="/images/icon-glass.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/ViewCustomersClaims.php">View Claims</a></span><br/>
				<span class="Level1"><img src="/images/icon-lock.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/home/Logout.php">Logout</a></span> 
				</div>';
		return $csidebar;	
	
	}

	# create side bar for tech accounts 
 	public function tsidebar(){

                $tsidebar='<div id="divSidePanel">
                                <div id="divLogo"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="100%" width="auto"></div>
                                <span class="Level0">Main Menu</span><br/>
				<span class="Level1"><img src="/images/icon-pen.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/SubmitClaimWarranty.php">Create Claim</a></span><br>
				<span class="Level1"><img src="/images/icon-glass.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/ViewTechClaimWarranty.php">View Claims</a></span><br/>
                                <span class="Level1"><img src="/images/icon-lock.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/home/Logout.php">Logout</a></span>
                                </div>';
                return $tsidebar;

        }

	# create side bar for providers accounts
        public function psidebar(){

                $psidebar='<div id="divSidePanel">
                                <div id="divLogo"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="100%" width="auto"></div>
                                <span class="Level0">Main Menu</span><br/>
				<span class="Level1"><img src="/images/icon-snapshot.jpg" alt="" width="16" height="16"> <a href="'._BASE_URL.'/warranty/ViewProviders.php">View Stats</a></span><br/>
                                <span class="Level1"><img src="/images/icon-glass.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/warranty/ViewProviderClaims.php">View Claims</a></span><br>
                                <span class="Level1"><img src="/images/icon-lock.jpg" width="16" height="16" alt=""> <a href="'._BASE_URL.'/home/Logout.php">Logout</a></span>
                                </div>';
                return $psidebar;

        }



	
	# making side bar dynamics by calling one function and returning based on set sessions access */
	public function sidebar(){
		# return side bar based on access
		if(isset($_SESSION['cid']) && isset($_SESSION['name']) && !isset($_SESSION['tech_id'])){
                	echo $this->usidebar();			
        	}elseif(isset($_SESSION['customerid']) && isset($_SESSION['customername']) &&  !isset($_SESSION['tech_id'])){
                	echo $this->csidebar();
        	}elseif(isset( $_SESSION['tech_id'])){
                	echo $this->tsidebar();
		}elseif(isset( $_SESSION['ProviderID']) && isset($_SESSION['ProviderNAME'])){
			echo $this->psidebar();
        	} else{
                	echo $this->guestsidebar();
        	}	
	}	
	

	# filter information  for general use db and requests
	function filterEverything($data) {
        	$arr = array();
        	foreach($data as $key => $value){
            		$search 	= array("\\","\x00","\n","\r","'",'"',"\x1a");
            		$replace 	= array("\\\\","\\0","\\n","\\r","\'",'\"',"\\Z");
            		$value1 	= str_replace($search, $replace, $value);
            		$arr[$key] 	= (trim($value1));
         	}
		# return clean data	
		return $arr;
        }
		
	# check for empty fields	
	function checkEmpty($fieldName){            
        	if (empty($fieldName)){
        		return false;
        	}else{
            		return true;
            }
        }
}
?>
