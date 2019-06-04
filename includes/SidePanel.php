<div id="divSidePanel">
	<div id="divLogo"><img src="http://www.pdwatersystems.com/images/Logo.jpg" height="200px" width="auto" /></div>	
	<?php $warranty->CreateMainMenu();?>
	<!-- login -->
<div id="divUserInfo">You are logged in as: <strong><?php if (@$_SESSION["UserIn"] == "Yes") echo $_SESSION["UserName"]; else echo 'Guest';?></strong> </div>
</div>
