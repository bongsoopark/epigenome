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

$p = 1;
$l = 20;

$sql = "SELECT count(*) from genome_features where genome_id=".$data->id.";";
$result = $con->query($sql);
list($tc) = $result->fetch_row();
$result->free();
 
$tp = intval(($tc-1)/$p)+1;
$sp = ($p-1)*$l;

$sql = "SELECT distinct(feature) from genome_features where genome_id='".$data->id."' limit $sp, $l;";
$result = $con->query($sql);
$data3 = array();
while($row = $result->fetch_object()) {
	$sql2 = "SELECT count(*) from genome_features where genome_id='".$data->id."' and feature='".$row->feature."';";
	$result2 = $con->query($sql2);
	list($row->feature_count) = $result2->fetch_row();
	$result2->free();
	array_push($data3, $row);
}
$result->free();
$con->close();

$page_list = "1 2 3 4 5 6 7 8 9 10";
####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("/feature_detail.tpl");
$design->parsing(array(
		"page_list" => $page_list,
		"gid" => $gid, "DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2), 
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
