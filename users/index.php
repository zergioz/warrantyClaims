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
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Warranty Claims</div>
		<?php $warranty->ViewClaimsList();?>	
	</div>
</div>
<!-- end divPage -->
<?php include "../includes/PageFooter.php"; ?>
</body>
</html>