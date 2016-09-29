<?php
# ECEP Project
# The Main Page
# main page consists of the basic statistics, links, and twitter annoucement.
# Import Libraries
include "../lib/conf.php";
include "../lib/conf_db.php";
include "../lib/common.php";
include "../lib/design.php";
include "../lib/sample.php";

# Security check controller
# Only available for certain query
# The security check is a part of conf.php now.

# MySQL connection
$con = new mysqli($DBConf["ANALYSIS_HOST"], $DBConf["ANALYSIS_USER"], $DBConf["ANALYSIS_PASS"], $DBConf["ANALYSIS_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

# Retrieve the genome statisics
$sql = "SELECT object_type, object_id from favorite_cart where object_type = 2 and user_id = 0;";
$result = $con->query($sql);
$assay_list = "";
while($row = $result->fetch_row()) {
	$assay_list .= "'".$row[1]."',";
}
$assay_list = substr($assay_list, 0, strlen($assay_list)-1);
$result->free();
$con->close();

$con = connectNewDB("DATASET");
if ($con->connect_error) {
	echo("Database Connection Error");
}
$sql = "SELECT * from ngs_assay where sra_id in ($assay_list);";
$result = $con->query($sql);
$data3 = array();
while($row = $result->fetch_object()) {
	array_push($data3, $row);
}
$result->free();
$con->close();
####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("favorite.tpl");
$design->parsing(array(
		"number_of_species" => $number_of_species,
		"number_of_genome" => $number_of_genome,
		"DATA" => $data, "DATA_CNT" => count($data), 
		"DATA3" => $data3, "list_cnt" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
