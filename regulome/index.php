<?php
include "../lib/conf.php";
include "../lib/conf_db.php";
include "../lib/common.php";
include "../lib/design.php";
include "../lib/sample.php";

# MySQL connection
$con = new mysqli($DBConf["DATASET_HOST"], $DBConf["DATASET_USER"], $DBConf["DATASET_PASS"], $DBConf["DATASET_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

$sql = "SELECT * from regulome_class;";
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
$design->readTemplate("/regulome_detail.tpl");
$design->parsing(array("assay_name" => $assay_name[$assay], "assay" => $assay,
		"gid" => $gid, "DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2), 
		"DATA3" => $data3, "list_cnt" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
