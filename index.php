<?php
# ECEP Project
# Import Libraries
include "./lib/conf.php";
include "./lib/conf_db.php";
include "./lib/common.php";
include "./lib/design.php";
include "./lib/sample.php";

# Security check controller
# Only available for certain query

# MySQL connection
$con = new mysqli("localhost", "bongsoo", "450NFrear", "genome");
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
$con->close();
####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("index.tpl");
$design->parsing(array(
		"DATA" => $data, "DATA_CNT" => count($data), 
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
