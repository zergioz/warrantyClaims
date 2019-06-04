<?php 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Database Backups</div>
		<hr>	
<div class="alert alert-success" role="alert">Database Backup Successfully.</div>			<!-- Mesg based on action -->
<?php
$dbhost = 'localhost';
$dbuser = 'pdwarrantyuser';
$dbpass = 'P@ssword305!';
$dbname = 'warranty';


# this page need to be modified to use the class --- runnig out of time.. and a butt load to do. :-)
function backup_tables($host,$user,$pass,$name,$tables = '*'){

    $link = mysqli_connect($host,$user,$pass,$name);
    mysqli_query($link,"SET NAMES 'utf8'");


    //get all of the tables
    if($tables == '*'){
        $tables = array();
        $result = mysqli_query($link,'SHOW TABLES');
        while($row = mysqli_fetch_row($result)){
            $tables[] = $row[0];

        }

    } else {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    
    $return='';

    //cycle through
    foreach($tables as $table){
        $result = mysqli_query($link,'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);

        $return.= 'DROP TABLE '.$table.';';
        $var=mysqli_query($link,'SHOW CREATE TABLE '.$table);
        $row2 = mysqli_fetch_row($var);
        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++) 
        {
            while($row = mysqli_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
}

# un backup 
backup_tables($dbhost,$dbuser,$dbpass,$dbname);

?>
</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
