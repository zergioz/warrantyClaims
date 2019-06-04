<!-- start page --> 
<?php 
session_start();
//error_reporting(0);
#necessary files
include"../includes/html.php";
if(!isset($_SESSION['cid']) && !isset($_SESSION['name']))
{
  header('location: '._BASE_URL.'/home/Login.php');
}
$html= new html();
#include header
echo $html->header();
/**
 * start class
 */
$warranty = new warranty;

?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Warranty Claims : Change Password </div>
		<div class="Box1">
		  <!-- include change password teplate-->
		  <?php $warranty->ViewPasswordChange();?>
		</div>
	</div>
	<!-- end divBodyPanel -->
</div>
<!-- end divPage -->
<?php include "../includes/PageFooter.php"; ?>

</body>
</html>
