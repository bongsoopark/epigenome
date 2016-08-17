<?php
function getScriptLanguageSELECT($name, $selected = "", $javascript = "") {
	$ele = array(array("Compiled Software","Compiled Software"),array("C++","C++"),array("Java","Java"),array("Perl","Perl"), array("Python","Python"), array("R Script","R Script"), array("Shell Script","Shell Script"));
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	for($i = 0 ; $i < count($ele) ; $i++) {
		if ($selected == $ele[$i][1]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$ele[$i][1]."\"$ss>".$ele[$i][0]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getScriptTypeSELECT($name, $selected = "", $javascript = "") {
	$ele = array(array("======== Classification ========","========= Classification ========="), array("Consolidation","Consolidation"), array("Distance","Distance"), array("FormatConversion","FormatConversion"), array("Mapping","Mapping"), array("MotifSearch","MotifSearch"), array("SequencePipeline","SequencePipeline"), array("SequenceSearch","SequenceSearch"), array("SoftwarePackage","SoftwarePackage"), array("Statistics","Statistics"));
	$result = mysql_query($sql, $connect);
	$data = "<select name=\"$name\" $javascript>\n";
	for($i = 0 ; $i < count($ele) ; $i++) {
		if ($selected == $ele[$i][1]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$ele[$i][1]."\"$ss>".$ele[$i][0]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}
?>
