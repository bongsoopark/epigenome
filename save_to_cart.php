<?php
include "./lib/conf.php";
include "./lib/conf_db.php";
include "./lib/common.php";
include "./lib/design.php";
include "./lib/sample.php";

$sample_ids = $_POST["sample_ids"];
$sample_ids = substr($sample_ids, 0, strlen($sample_ids)-1);
$samples = split(",",$sample_ids);

# MySQL connection
$con = new mysqli($DBConf["ANALYSIS_HOST"], $DBConf["ANALYSIS_USER"], $DBConf["ANALYSIS_PASS"], $DBConf["ANALYSIS_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}

if ($a == "save") {
	for($i=0; $i < count($samples) ; $i++) {
		$sample = split(":",$samples[$i]);
		
		$sql = "select count(*) from favorite_cart where user_id='0' and object_type='$sample[0]' and object_id='$sample[1]';";
		$result = $con->query($sql);
		list($cnt) = $result->fetch_row();
		$result->free();

		if ($cnt == 0) {
			$sql = "insert into favorite_cart (user_id, object_type, object_id) values ('0','$sample[0]','$sample[1]');";
			$con->query($sql);
		}
	}
	if (count($sample) > 1) {
		moveURLMessage($redirect, "Save to Favorite was successfull");
	} else {
		moveURLMessage($redirect, "There is no selected items");
	}
} else {
	for($i=0; $i < count($samples) ; $i++) {
		$sample = split(":",$samples[$i]);
		
		$sql = "delete from favorite_cart where user_id = '0' and object_type = '$sample[0]' and object_id='$sample[1]';";
		$con->query($sql);
	}
	if (count($sample) > 1) {
		moveURLMessage($redirect, "Remove from Favorite was successfull");
	} else {
		moveURLMessage($redirect, "There is no selected items");
	}
}
mysql_close($con);
?>
