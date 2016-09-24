<?php
# ECEP Project
# The Main Page
# main page consists of the basic statistics, links, and twitter annoucement.
# Import Libraries
include "./lib/conf.php";
include "./lib/conf_db.php";
include "./lib/common.php";
include "./lib/design.php";
include "./lib/sample.php";

# Security check controller
# Only available for certain query
# The security check is a part of conf.php now.

# MySQL connection
$con = new mysqli($DBConf["GENOME_HOST"], $DBConf["GENOME_USER"], $DBConf["GENOME_PASS"], $DBConf["GENOME_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

# Retrieve the genome statisics
$sql = "SELECT a.genus_name, a.species_name, a.strain_name, b.assembly_id, b.db_key from species a, genome b where a.id = b.species_id;";
$result = $con->query($sql);
$data = array();
while($row = $result->fetch_row()) {
	array_push($data, $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]);
}
$result->free();

$sql = "SELECT count(*) from species;";
$result = $con->query($sql);
list($number_of_species) = $result->fetch_row();
$result->free();

$sql = "SELECT count(*) from genome;";
$result = $con->query($sql);
list($number_of_genome) = $result->fetch_row();
$result->free();
$con->close();
####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("index.tpl");
$design->parsing(array(
		"number_of_species" => $number_of_species,
		"number_of_genome" => $number_of_genome,
		"DATA" => $data, "DATA_CNT" => count($data), 
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
