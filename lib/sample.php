<?php
function getSampleTargetSELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(TARGET) from PughLabSampleInfo where PRI_GENOME='$genome' order by TARGET;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleAntibodySELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(ANTIBODY) from PughLabSampleInfo where PRI_GENOME='$genome' order by ANTIBODY;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleStrainSELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(STRAIN) from PughLabSampleInfo where PRI_GENOME='$genome' order by STRAIN;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleMutationSELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(MUTATION) from PughLabSampleInfo where PRI_GENOME='$genome' order by MUTATION;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleMediaSELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(MEDIA) from PughLabSampleInfo where PRI_GENOME='$genome' order by MEDIA;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSamplePerturbationSELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(PERTURB) from PughLabSampleInfo where PRI_GENOME='$genome' order by PERTURB;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleAssaySELECT($name, $genome, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT distinct(ASSAY_CODE) from PughLabSampleInfo where PRI_GENOME='$genome' order by ASSAY_CODE;";
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	mysql_close($connect);
	$data .= "</select>\n";
	return $data;
}

function getSampleTagNumberSELECT($name, $genome, $selected = "", $javascript = "") {
	$tag_number = array(array("100,000","100000"), array("1,000,000","1000000"), array("5,000,000","5000000"), array("10,000,000","10000000"), array("50,000,000","50000000"));
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	for($i = 0 ; $i < count($tag_number) ; $i++) {
		if ($selected == $tag_number[$i][1]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$tag_number[$i][1]."\"$ss>".$tag_number[$i][0]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}
?>
