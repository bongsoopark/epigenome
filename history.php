<?php
include "./lib/conf.php";
include "./lib/conf_db.php";
include "./lib/common.php";
include "./lib/design.php";
include "./lib/sample.php";

####--------------- Template Engine ---------------####
$design = new Design;
$design->loadData("index.dat");
$design->readTemplate("history.tpl");
$design->parsing(array(
		"DATA" => $data, "DATA_CNT" => count($data), 
		"DATA2" => $data2, "DATA_CNT2" => count($data2),
		"DATA3" => $data3, "DATA_CNT3" => count($data3), "tc" => $tc
		));
$design->display();
####--------------- Template Engine ---------------####
?>
