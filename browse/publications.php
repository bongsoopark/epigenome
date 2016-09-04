<?php
include "../lib/conf.php";
include "../lib/conf_db.php";
include "../lib/common.php";
include "../lib/design.php";
include "../lib/sample.php";

# MySQL connection
$con = new mysqli($DBConf["GENOME_HOST"], $DBConf["GENOME_USER"], $DBConf["GENOME_PASS"], $DBConf["GENOME_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

$sql = "SELECT genus_name, species_name, strain_name, ncbi_txid from species order by frequency desc limit 5;";
$result = $con->query($sql);
$data = array();
while($row = $result->fetch_row()) {
	array_push($data, "<a href='/epigenome/browse/species/?txid=$row[3]'>".$row[0]." ".$row[1]." ".$row[2]."</a>");
}
$result->free();
$con->close();
####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("/publications.tpl");
$design->parsing(array(
		"DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2),
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
