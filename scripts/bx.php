<?php
include "../lib/conf.php";
include "../lib/conf_db.php";
include "../lib/common.php";
include "../lib/design.php";
include "../lib/sample.php";

#exit;
#$tf = file_get_contents("http://http://igenomics.org/epigenome/scripts/cis-bp-locus_name.txt");
#echo($tf);
#exit;


# MySQL connection
$con = new mysqli($DBConf["DATASET_HOST"], $DBConf["DATASET_USER"], $DBConf["DATASET_PASS"], $DBConf["DATASET_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

$sql = "SELECT * from regulome_genes;";
$result = $con->query($sql);
while($row = $result->fetch_object()) {
	$row->gene_name = strtoupper($row->gene_name);
	echo($row->locus_name."<BR>");
	#echo("UPDATE regulome_genes set gene_name='".$row->gene_name."' where locus_name='".$row->locus_name."';<br>");
}
$result->free();

$con->close();
####--------------- Template Engine ---------------####
?>
