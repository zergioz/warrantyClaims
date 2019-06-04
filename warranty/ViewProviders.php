<?php
# debug
//ini_set("display_errors", 1);
 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

#check access
if(!isset($_SESSION['ProviderID']) && !isset($_SESSION['ProviderNAME'])){
	
	header('location: '._BASE_URL.'/home/Login.php');
}



################################################### PIE CHART
# pie charts queries - total numbe of pump
$PumpCount=DBi::$conn->prepare("SELECT 	COUNT(*) AS Total, 		       `tblWarrantyClaim`.`PumpType` 
				FROM    	 		`"._DB_NAME."`.`tblWarrantyClaim`
				WHERE					       `tblWarrantyClaim`.`WarrantyProvider` = ?
                        	GROUP BY			               `tblWarrantyClaim`.`PumpType`");

# bind results as mysqlnd driver is not istalled
$PumpCount->bind_param("s",$_SESSION['ProviderID']);

# run query
$PumpCount->execute();

# store result
$PumpCount->store_result();

# bind results to use
$PumpCount->bind_result($TotalPUMPS,$PumpTYPE);

# empty pie pump array	
$PieArray = array ();	

# fetch information
while ($PumpCount->fetch()){
	$PieArray[$PumpTYPE][] = $TotalPUMPS;

}

# AG set values of retur 0
if(isset($PieArray['AG'][0])){
	# set db result value
	$AG = $PieArray['AG'][0];
}else{
	# set 0
	$AG = 0;
}

# VER set values of retur 0
if(isset($PieArray['VER'][0])){
        # set db result value
        $VER = $PieArray['VER'][0];
}else{
        # set 0
        $VER = 0;
}

# SUB set values of retur 0
if(isset($PieArray['SUB'][0])){
        # set db result value
        $SUB = $PieArray['SUB'][0];
}else{
        # set 0
        $SUB = 0; 
}

# SES set values of retur 0
if(isset($PieArray['SES'][0])){
        # set db result value
        $SES = $PieArray['SES'][0];
}else{
        # set 0
        $SES = 0; 
}


############################################### LINE CHART

# LINE chart
$PumpCountMonth=DBi::$conn->prepare("SELECT 				COUNT(*) 				 AS Total,  
				     MONTHNAME				(`tblWarrantyClaim`.`WarrantyClaimDate`) AS CurrentMONTH 
				     FROM		  `"._DB_NAME."`.`tblWarrantyClaim` 
				     WHERE 				 `tblWarrantyClaim`.`WarrantyProvider` = ? 
				     GROUP 	BY 		   MONTH(`tblWarrantyClaim`.`WarrantyClaimDate`)");



# bind results as mysqlnd driver is not istalled
$PumpCountMonth->bind_param("s",$_SESSION['ProviderID']);

# run query
$PumpCountMonth->execute();

# store result
$PumpCountMonth->store_result();

# bind results to use
$PumpCountMonth->bind_result($TotalPUMPS,$CurrentMONTH);

# empty pie pump array
$LineArray = array ();

# fetch information - this array is not being used and will be used to create bars charts
while ($PumpCountMonth->fetch()){
        $LineArray[$CurrentMONTH] .= $TotalPUMPS;

}


# Months values or return 0
if(isset($LineArray['January'])){
        # set db result value
        $LineJan = $LineArray['January'];
}else{
        # set 0
        $LineJan = 0 ;
}

# Months values or return 0
if(isset($LineArray['February'])){
        # set db result value
        $LineFeb = $LineArray['February'];
}else{
        # set 0
        $LineFeb = 0 ;
}


# Months values or return 0
if(isset($LineArray['March'])){
        # set db result value
        $LineMar = $LineArray['March'];
}else{
        # set 0
        $LineMar = 0 ;
}

# Months values or return 0
if(isset($LineArray['April'])){
        # set db result value
        $LineApr = $LineArray['April'];
}else{
        # set 0
        $LineApr = 0 ;
}

# Months values or return 0
if(isset($LineArray['May'])){
        # set db result value
        $LineMay = $LineArray['May'];
}else{
        # set 0
        $LineMay = 0 ;
}


# Months values or return 0
if(isset($LineArray['June'])){
        # set db result value
        $LineJun = $LineArray['June'];
}else{
        # set 0
        $LineJun = 0 ;
}

# Months values or return 0
if(isset($LineArray['July'])){
        # set db result value
        $LineJul = $LineArray['July'];
}else{
        # set 0
        $LineJul = 0 ;
}

# Months values or return 0
if(isset($LineArray['August'])){
        # set db result value
        $LineAug = $LineArray['August'];
}else{
        # set 0
        $LineAug = 0 ;
}

# Months values or return 0
if(isset($LineArray['September'])){
        # set db result value
        $LineSep = $LineArray['September'];
}else{
        # set 0
        $LineSep = 0 ;
}

# Months values or return 0
if(isset($LineArray['October'])){
        # set db result value
        $LineOct = $LineArray['October'];
}else{
        # set 0
        $LineOct = 0 ;
}

# Months values or return 0
if(isset($LineArray['November'])){
        # set db result value
        $LineNov = $LineArray['November'];
}else{
        # set 0
        $LineNov = 0 ;
}

# Months values or return 0
if(isset($LineArray['December'])){
        # set db result value
        $LineDec = $LineArray['December'];
}else{
        # set 0
        $LineDec = 0 ;
}



########################## BAR CHART

$January=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/01/01' AND '2015/02/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Jan = mysqli_num_rows ($January);
$February=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/02/01' AND '2015/03/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Feb = mysqli_num_rows ($February);
$March=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/03/01' AND '2015/04/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Mar = mysqli_num_rows ($March);
$April=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/04/01' AND '2015/05/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Apr = mysqli_num_rows ($April);
$May=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/05/01' AND '2015/06/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Ma = mysqli_num_rows ($May);
$June=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/06/01' AND '2015/07/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Jun = mysqli_num_rows ($June);
$July=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/07/01' AND '2015/08/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Jul = mysqli_num_rows ($June);
$August=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/08/01' AND '2015/09/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Aug = mysqli_num_rows ($June);
$September=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/09/01' AND '2015/10/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Sep = mysqli_num_rows ($June);
$October=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/10/01' AND '2015/11/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Oct = mysqli_num_rows ($June);
$November=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/11/01' AND '2015/12/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Nov = mysqli_num_rows ($June);
$December=DBi::$conn->query("SELECT * FROM `tblWarrantyClaim` WHERE `WarrantyClaimDate`  between '2015/12/01' AND '2016/01/01' AND  `WarrantyProvider`={$_SESSION['ProviderID']}");
$Dec = mysqli_num_rows ($June);
###################End of Bar chart Here######################
$html= new html();
#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<!-- guest sidebar -->
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<!-- Create SnapShot-->
		<div id="divHeader"><?php echo _TITLE_HEADER_DEFAULT_SHORT;?> : Live Snapshot</div>
		<hr>
		<!-- line chart canvas element -->
        	<canvas id="buyers" width="400" height="250"></canvas>
        	<!-- pie chart canvas element -->
        	<canvas id="countries" width="250" height="250"></canvas>
        	<!-- bar chart canvas element -->
        	<canvas id="income" width="700" height="250"></canvas>
       	 	<script>
            	// line chart data
            	var buyerData = {
                		labels : [	"January",
					  	"February",
				  		"March",
				  		"April",
				 	 	"May",
				  		"June",
				  		"July",
				  		"August",
				  		"September",
						"October",
						"November",
						"December"	],
                		datasets : [{	fillColor : "rgba(172,194,132,0.4)",
                    				strokeColor : "#ACC26D",
                    				pointColor : "#fff",
                    				pointStrokeColor : "#9DB86D",
                    		data : [	<?php echo $LineJan ;?>,
						<?php echo $LineFeb ;?>,
						<?php echo $LineMar ;?>,
						<?php echo $LineApr ;?>,
						<?php echo $LineMar ;?>,
						<?php echo $LineJun ;?>,
						<?php echo $LineJul ;?>,
						<?php echo $LineAug ;?>,
						<?php echo $LineSep ;?>,
						<?php echo $LineOct ;?>,
						<?php echo $LineNov ;?>,
						<?php echo $LineDec ;?>	]}]
            	}

            // get line chart canvas
            var buyers = document.getElementById('buyers').getContext('2d');
            // draw line chart
            new Chart(buyers).Line(buyerData);
            // pie chart data
            var pieData = [	{  	value: <?php  echo $AG;?>,
                    			color:"#878BB6",
		    			label: "AGP"	},
                   		{	value : <?php echo $VER;?>,
                    			color : "#4ACAB4",
		    			label : "VER" 	},            	   
				{	value : <?php echo $SUB;?>,
                    			color : "#FF8153",
		    			label : "SUB"	},
                		{	value : <?php echo $SES;?>,
                    			color : "#FFEA88",
		    			label : "SES"
                		}];


            // pie chart options
            var  pieOptions = {
                 segmentShowStroke : true,
                 animateScale  : true,
		 animateRotate : false
		  
            }
            // get pie chart canvas
            var countries= document.getElementById("countries").getContext("2d");
            // draw pie chart
            new Chart(countries).Pie(pieData, pieOptions);
            

	    // bar chart data
            var barData = {
                	labels : [	"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sep",
					"Oct",
					"Nov",
					"Dec"	],
                	datasets : [{
                        		fillColor : "#48A497",
                        		strokeColor : "#48A4D1",
                        data : [	<?php echo $LineJan ;?>,
					<?php echo $LineFeb ;?>,
					<?php echo $LineMar ;?>,
					<?php echo $LineApr ;?>,
					<?php echo $LineMar ;?>,
					<?php echo $LineJun ;?>,
					<?php echo $LineJul ;?>,
					<?php echo $LineAug ;?>,
					<?php echo $LineSep ;?>,			
					<?php echo $LineOct ;?>,
					<?php echo $LineNov ;?>,
					<?php echo $LineDec ;?>	]

	                           }


			]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
       	    </script>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
<!-- end of Page -->
</body>

</html>
