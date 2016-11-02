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

$sql = "SELECT * from regulome_class where regulome_type='$class' order by regulome_class asc;";
$result = $con->query($sql);
$data3 = array();
$regulome_ids = "";
while($row = $result->fetch_object()) {
	$regulome_id = $row->id;
	$sql2 = "SELECT * from regulome_genes where regulome_id='$regulome_id';";
	$result2 = $con->query($sql2);
	while($row2 = $result2->fetch_object()) {
		$row2->regulome_class = $row->regulome_class;
		array_push($data3, $row2);
	}
	$result2->free();
	$regulome_ids .= $regulome_id.",";
}
$result->free();

$regulome_ids = substr($regulome_ids, 0, strlen($regulome_ids)-1);
$sql = "SELECT count(distinct(locus_name)) from regulome_genes where regulome_id in ($regulome_ids);";
$result3 = $con->query($sql);
list($regulome_cnt) = $result3->fetch_row();
$result3->free();
$con->close();

####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("/regulome_detail.tpl");
$design->parsing(array("class" => $class, "assay" => $assay,
		"regulome_cnt" => $regulome_cnt, 
		"gid" => $gid, "DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2), 
		"DATA3" => $data3, "list_cnt" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
