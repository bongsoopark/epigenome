<?php
include "../../lib/conf.php";
include "../../lib/conf_db.php";
include "../../lib/common.php";
include "../../lib/design.php";
include "../../lib/sample.php";

# MySQL connection
$con = new mysqli($DBConf["GENOME_HOST"], $DBConf["GENOME_USER"], $DBConf["GENOME_PASS"], $DBConf["GENOME_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

$sql = "SELECT id, species_id, assembly_id, db_key, epigenomedb from genome where assembly_id='".$gid."';";
$result = $con->query($sql);
$data = $result->fetch_object();
$result->free();

$sql = "SELECT * from species where id='".$data->species_id."';";
$result = $con->query($sql);
$data2 = $result->fetch_object();
$result->free();

$sql = "SELECT * from chromosome where genome_id='".$data->id."';";
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
$design->readTemplate("/genome_detail.tpl");
$design->parsing(array(
		"gid" => $gid, "DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2), 
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
