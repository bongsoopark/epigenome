<?php
$arrayKeys = array_keys($_GET);
foreach ($arrayKeys as $value) {
	if (!is_array($_GET[$value])) {
		$data = preg_replace('/\$/', '\\\\$', $_GET[$value]);
		eval("\$$value = \"".$data."\";");
		if($value == "id") {
			settype($id, 'integer');
		}	
	} else {
		eval("\$".$value." = \$_GET[\$value];");
	}
}

# It is code for POST method
$arrayKeys = array_keys($_POST);
foreach ($arrayKeys as $value) {
	if (!is_array($_POST[$value])) {
		$data = preg_replace('/\$/', '\\\\$', $_POST[$value]);
		eval("\$$value = \"".$data."\";");
		if($value == "id") {
			settype($id, 'integer');
		}	
	} else {
		eval("\$".$value." = \$_POST[\$value];");
		if($value == "id") {
			settype($id, 'integer');
		}	
	}
}
unset($data);


#---------------------------------------------------------------------------------------------------------
# Functions to connect to database with various methods
#---------------------------------------------------------------------------------------------------------
function connectDBCustomC($DBType, $host, $db, $user, $pass, $opt = 0) {
	switch ($DBType) {
		case "MySQL":
			return connectDBMySQLCustomC($host, $db, $user, $pass, $opt);
			break;
		case "MSSQL":
			return connectDBMSSQLCustom($host, $db, $user, $pass, $opt);
			break;
		default:
			alertForm("invalid DB TYPE!! check DBType argument");
			break;
	}
}

function connectDBCustom($DBType, $host, $db, $user, $pass, $opt = 0) {
	switch ($DBType) {
		case "MySQL":
			return connectDBMySQLCustom($host, $db, $user, $pass, $opt);
			break;
		case "MSSQL":
			return connectDBMSSQLCustom($host, $db, $user, $pass, $opt);
			break;
		default:
			alertForm("invalid DB TYPE!! check DBType argument");
			break;
	}
}

function connectDBC($label = "") {
	global $DBConf;
	if ($label != "") { $type = $label."_DB_TYPE"; } else { $type = "DB_TYPE"; } 
	switch ($DBConf[$type]) {
		case "MySQL":
			return connectDBCMySQL($label);
			break;
		case "MSSQL":
			return connectDBCMSSQL($label);
			break;
		default:
			alertForm("invalid DB TYPE!! check conf.ph");
			break;
	}
}

function connectDB($label = "") {
	global $DBConf;
	if ($label != "") { $type = $label."_DB_TYPE"; } else { $type = "DB_TYPE"; } 
	switch ($DBConf[$type]) {
		case "MySQL":
			return connectDBMySQL($label);
			break;
		case "MSSQL":
			return connectDBMSSQL($label);
			break;
		default:
			alertForm("invalid DB TYPE!! check conf.ph");
			break;
	}
}

function connectDB2($label = "") {
	global $DBConf;
	if ($label != "") { $type = $label."_DB_TYPE"; } else { $type = "DB_TYPE"; } 
	switch ($DBConf[$type]) {
		case "MySQL":
			return connectDBMySQL2($label);
			break;
		default:
			alertForm("invalid DB TYPE!! check conf.ph");
			break;
	}
}

function connectDBCMySQL($label = "") {
	global $DBConf;
	if ($label != "") { $label .= "_"; }
	$c = mysql_pconnect("localhost","root","qhdtncjswo980!ABC") 
		or errorMsg("Unable to connect to mysql server [".$DBConf[$label."HOST"]."] [".mysql_error($c)."]");
	mysql_select_db($DBConf[$label."DB"], $c)
		or errorMsg("Unable to select Database (1) [".$DBConf[$label."DB"]."]");
	return $c;
}

function connectDBMySQL($label = "") {
	global $DBConf;
echo $lable;
	if ($label != "") { $label .= "_"; }
	$c = mysql_pconnect($DBConf[$label."HOST"], $DBConf[$label."USER"], $DBConf[$label."PASS"])
		or errorMsg("Unable to connect to mysql server [".$DBConf[$label."HOST"]."] [".mysql_error($c)."]");
	mysql_select_db($DBConf[$label."DB"], $c)
		or errorMsg("Unable to select Database (1) [".$DBConf[$label."DB"]."]");
	return $c;
}

function connectDBMySQL2($label = "") {
	global $DBConf2;
echo $lable;
	for ($i=0;$i<count($DBConf2[$label]);$i++) {
		$c = mysql_pconnect($DBConf2[$label][$i]["HOST"], $DBConf2[$label][$i]["USER"], $DBConf2[$label][$i]["PASS"])
			or writeErrDBLog("Unable to connect to mysql server [".$DBConf2[$label][$i]["HOST"]."] [".mysql_errno($c).":".mysql_error($c)."]");
		mysql_select_db($DBConf2[$label][$i]["DB"], $c)
			or writeErrDBLog("Unable to select Database [".$DBConf2[$label][$i]["DB"]."] [".mysql_errno($c).":".mysql_error($c)."]");
		$connect[$i]->CONNECT = $c;
		$connect[$i]->HOSTNAME = $DBConf2[$label][$i]["HOST"];
		$connect[$i]->DB = $DBConf2[$label][$i]["DB"];
		$connect[$i]->USER = $DBConf2[$label][$i]["USER"];
		$connect[$i]->PASSWORD = $DBConf2[$label][$i]["PASS"];
	}
	return $connect;
}

function connectDBMySQLCustomC($host, $db, $user, $pass, $opt = 0) {
	if (!($c = @mysql_connect($host, $user, $pass))) {
		if ($opt == 0) {
			errorMsg("Unable to connect to mysql server [$host] [$db] [$user] [".mysql_error($c)."]");
		} else {
			writeErrLog("Unable to connect to mysql server [$host]");
		}
		return -1;
	}
	if ($db != "") {
		if (!(@mysql_select_db($db, $c))) {
			if ($opt == 0) {
				errorMsg("Unable to select Database (2) [$db]");
			} else {
				writeErrLog("Unable to select Database (2) [$db]");
			}
			return -1;
		}
	}
	return $c;
}

function connectDBMySQLCustom($host, $db, $user, $pass, $opt = 0) {
	if (!($c = @mysql_connect($host, $user, $pass))) {
		if ($opt == 0) {
			errorMsg("Unable to connect to mysql server [$host] [$db] [$user] [".mysql_error($c)."]");
		} else {
			writeErrLog("Unable to connect to mysql server [$host]");
		}
		return -1;
	}
	return $c;
}

function connectDBCMSSQL($label = "") {
	global $DBConf;
	if ($label != "") { $label .= "_"; }
	$c = mssql_connect($DBConf[$label."HOST"], $DBConf[$label."USER"], $DBConf[$label."PASS"])
		or errorMsg("Unable to connect to mysql server [".$DBConf[$label."HOST"]."] [".mssql_error($c)."]");
	mssql_select_db($DBConf[$label."DB"], $c)
		or errorMsg("Unable to select Database (3) [".$DBConf[$label."DB"]."]");
	return $c;
}

function connectDBMSSQL($label = "") {
	global $DBConf;
	if ($label != "") { $label .= "_"; }
	$c = mssql_pconnect($DBConf[$label."HOST"], $DBConf[$label."USER"], $DBConf[$label."PASS"])
		or errorMsg("Unable to connect to mysql server [".$DBConf[$label."HOST"]."] [".mssql_error($c)."]");
	mssql_select_db($DBConf[$label."DB"], $c)
		or errorMsg("Unable to select Database (3) [".$DBConf[$label."DB"]."]");
	return $c;
}

function connectDBMSSQLCustom($host, $db, $user, $pass) {
	$c = mssql_pconnect($host, $user, $pass)
		or errorMsg("Unable to connect to mysql server [$host] [".mysql_error($c)."]");
	if ($db != "") {
		mssql_select_db($db, $c)
			or errorMsg("Unable to select Database (4) [$db]");
	}
	return $c;
}

function addMSSQLslash($data) {
	$data = preg_replace("/'/", "''", $data);
	return $data;
}
#---------------------------------------------------------------------------------------------------------

function getCDNUID() {
        $id = $_SERVER["REMOTE_USER"];
	$con = connectDB("PUGHLAB");
	$sql = "SELECT USER_ID from PughLabUserInfo where EMAIL = '$id@psu.edu';";
	$result = mysql_query($sql, $con);
	list($user_id) = mysql_fetch_array($result);
	mysql_free_result($result);
	return $user_id;
}

function getCDNEMAIL() {
        return $_SERVER["REMOTE_USER"]."@psu.edu";
}

function getUserID() {
        return $_SERVER["REMOTE_USER"];
}

function getUserEmail() {
        return $_SERVER["REMOTE_USER"]."@psu.edu";
}

function isAdmin() {
        $id = $_SERVER["REMOTE_USER"];
	if ($id == "bxp12" or $id == "bfp2" or $id == "gja2" or $id == "wkl2" or $id == "npf5017" or $id == "sam77" or $id == "kep5239") {
		return 1;
	} else {
		return 0;
	}
}

function viewtypeSELECT ($l, $o, $url, $val, $opt = 0, $depth = 0) {
	$data = "\n<script language=\"javascript\">\n";
	$data .= "<!--\n";
	$data .= "function changeViewtype(list,o) {\n";
	$data .= "if(o == 2 && list != 'd') o = 0;";
	$data .= "if(o != 2 && list == 'd') { o = 2; list = 10; }";
	if (empty($depth) || $depth == 1) {
		$data .= "location.href= '".$url."?"."l='+list+'&o='+o+'".$val."'\n";
	} elseif ($depth > 1) {
		$data .= "location.href= '".$url."?"."l".$depth."='+list+'&o='+o+'".$val."'\n";
	}
	$data .= "}\n";
	$data .= "-->\n";
	$data .= "</script>\n";

	$list = array(5, 15, 20, 30, 60, 100, 200, 500, 1000);

	$data .= "<select name='viewtypeselect' onChange=\"changeViewtype(this.value, '".$o."')\" style='width:180px'>";
	for ($i=0;$i<count($list);$i++) {
		if ($list[$i] == $l) { $ss = " selected"; } else { $ss = ""; }
		$data .= "<option value=".$list[$i]." ".$ss.">".$list[$i]." items</option>";
	}
	if($opt == 1) $data .= "<option value='d' ".$od.">Detailed</option>";
	$data .= "</select>";

	return $data;
}

function getNavigationStrSELECT ($p, $l, $t, $c, $url, $val, $o = 0, $depth = 0) {
	// $o == 0 : Compact / $o == 1 : Detailed / $o == 2 : New design
	// depth == 2 : p2, depth == 3 : p3.....

	$sSub = intval (($c-1)/2);
	if (($p - $sSub) < 1) {
		$sSub = 1;
	} else {
		$sSub = $p - $sSub;
	}

	$sAdd = $sSub + $c - 1;
	if ($sAdd > $t) {
		$sAdd = $t;
		if (($sAdd-$sSub+1) < $l) { 
			//왼쪽을 보강해야 한다.
			$sSub = $sAdd - $c + 1;
			if ($sSub < 1) { $sSub = 1; }
		}
	}

	if (preg_match("/\?/", $url)) { $deli = "&"; } else { $deli = "?"; }

	$data = "\n<script language=\"javascript\">\n";
	$data .= "<!--\n";
	$data .= "function changeThisPage(page) {\n";

	if (empty($depth) || $depth == 1) {
		$data .= "location.href= '".$url."?"."p='+page+'&l=".$l.$val."'\n";
	} elseif ($depth > 1) {
		$data .= "location.href= '".$url."?"."p".$depth."='+page+'&l".$depth."=".$l.$val."'\n";
	}

	$data .= "}\n";
	$data .= "-->\n";
	$data .= "</script>\n";

	$data .= "<select name='pagenavigation' onChange=\"changeThisPage(this.value)\">";

	if ($p != 1 && $o != 0) {
		$data .= "<option value=1>First</option>";
	}

	//이전 c개만큼 넘어가기
	if (($sAdd - $c +1 > 1) && ($o != 0)) {
		$data .= "<option value=".($sAdd-$c).">Prev</option>";
	}

	for ($i=$sSub;$i<$sAdd + 1;$i++) {
		if ($p == $i) {
			$data .= "<option value=$i SELECTED>".number_format($i)."</option>";
		} else {
			$data .= "<option value=$i>".number_format($i)."</option>";
		}
	}

	//다음 c개 만큼 넘어가기
	if (($sSub + $c -1 < $t) && ($o != 0)) {
		$data .= "<option value=".($sAdd+1).">Next</option>";
	}

	if ($p != $t && $o != 0) {
		$data .= "<option value=$t>Last</option>";
	}

	$data .= "</select>";

	if($o == 2) {
		$data .= " of ".number_format($t);
	} else {
		$data .= "/".number_format($t);
	}

	if($o == 2) {
		$next_p = $p + 1;
		if($next_p > $t) {
			$nextstr = "<img src='/img/common/next_u.gif'>";
		} else {
			if ($depth > 1) {
				$nextstr = "<a href='$url?p".$depth."=$next_p&l".$depth."=".$l.$val."'><img src='/img/common/next.gif' border=0></a>";
			} else {
				$nextstr = "<a href='$url?p=$next_p&l=".$l.$val."'><img src='/img/common/next.gif' border=0></a>";
			}
		}

		$prev_p = $p - 1;
		if($prev_p < 1) {
			$prevstr = "<img src='/img/common/prev_u.gif'>";
		} else {
			if ($depth > 1) {
				$prevstr = "<a href='$url?p".$depth."=$prev_p&l".$depth."=".$l.$val."'><img src='/img/common/prev.gif' border=0></a>";
			} else {
				$prevstr = "<a href='$url?p=$prev_p&l=".$l.$val."'><img src='/img/common/prev.gif' border=0></a>";
			}
		}

		if($p == 1) {
			$firststr = "<img src='/img/common/first_u.gif'>";
		} else {
			if ($depth > 1) {
				$firststr = "<a href='$url?p".$depth."=1&l".$depth."=".$l.$val."'><img src='/img/common/first.gif'></a>";
			} else {
				$firststr = "<a href='$url?p=1&l=".$l.$val."'><img src='/img/common/first.gif'></a>";
			}
		}

		if($p == $t) {
			$laststr = "<img src='/img/common/last_u.gif'>";
		} else {
			if ($depth > 1) {
				$laststr = "<a href='$url?p".$depth."=$t&l".$depth."=".$l.$val."'><img src='/img/common/last.gif'></a>";
			} else {
				$laststr = "<a href='$url?p=$t&l=".$l.$val."'><img src='/img/common/last.gif'></a>";
			}
		}


		$data = $firststr."&nbsp;&nbsp;".$prevstr."&nbsp;&nbsp;<img src='/img/common/split.gif'>&nbsp;&nbsp;Page ".$data."&nbsp;&nbsp;<img src='/img/common/split.gif'>&nbsp;&nbsp;".$nextstr."&nbsp;&nbsp;".$laststr;
	}

	return $data;
}

#================= SELECT FUNCTIONS =====================#
function getYesNoSELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript>\n";
	$candidate = array(array("Y", "Yes"), array("N", "No"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getBamIdxFileSELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:150px'>\n";
	$candidate = array(array("BAM", "BAM"), array("IDX", "IDX"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function genomeSELECT($name, $selected = "", $javascript = "") {
	$data = "<select name=\"$name\" $javascript>\n";
	$candidate = array(array("sacCer3", "sacCer3"), array("mm9", "mm9"), array("hg19", "hg19"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function sampleViewSELECT($name, $selected = "", $javascript = "") {
	$data = "<select id=\"$name\" $javascript style='width:180px'>\n";
	$flag = isAdmin();
	if($flag == 1) {
		$candidate = array(array("MySamples", "My Samples"), array("PughLabSamples", "Pugh Lab Samples"), array("PeconicSamples", "Peconic Samples"));
	} else {
		$candidate = array(array("MySamples", "My Samples"), array("PughLabSamples", "Pugh Lab Samples"));
	}
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function peopleViewSELECT($name, $selected = "", $javascript = "") {
	$data = "<select id=\"$name\" $javascript style='width:180px'>\n";
	$flag = isAdmin();
	if($flag == 1) {
		$candidate = array(array("PughLab", "PughLab/CEGR"), array("Collaborators", "Collaborators"), array("Customers", "Customers"));
	} else {
		$candidate = array(array("PughLab", "PughLab/CEGR"), array("Collaborators", "Collaborators"));
	}
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function reportViewSELECT($name, $selected = "", $javascript = "") {
	$data = "<select id=\"$name\" $javascript style='width:160px;font-size:11px'>\n";
	$candidate = array(array("Options", "No Singletons"), array("Singleton", "Report with Singleton"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function versionViewSELECT($name, $selected = "", $javascript = "") {
	$data = "<select id=\"$name\" $javascript style='width:160px;font-size:11px'>\n";
	$flag = isAdmin();
	if ($flag == 1) {
		$candidate = array(array("Version0", "Original report"), array("Version1", "Re-Analysis v1"));
	} else {
		$candidate = array(array("Version0", "Original report"));
	}
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function taskViewSELECT($name, $selected = "", $javascript = "") {
	$data = "<select id=\"$name\" $javascript style='width:180px'>\n";
	$flag = isAdmin();
	$candidate = array(array("MyTasks", "My Tasks"), array("PughLabTasks", "Pugh Lab Tasks"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function sampleDetailViewSELECT($name, $sample_ids, $selected = "", $javascript = "") {
	$sample_ids = substr($sample_ids, 0, strlen($sample_ids)-1);
	$connect = connectDB("PUGHLAB");
	$data = "<select id=\"$name\" $javascript style=\"width:550px\">\n";
	$sql = "SELECT SAMPLE_ID, NAME from PughLabSampleInfo where SAMPLE_ID in ($sample_ids) order by UNIQ_ID;";
	$result = mysql_query($sql, $connect);
	$candidate = array();
	while($row = mysql_fetch_array($result)) {
		array_push($candidate, $row);
	}
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	mysql_close($connect);
	return $data;
}

function getHowManySampleSELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript>\n";
	for ($i=1;$i<49;$i++) {
		if ($selected == $i) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$i."\"$ss>".$i."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getPughLabSampleSELECT($name, $number_of_sample, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript>\n";
	for ($i=1;$i<=$number_of_sample;$i++) {
		if ($selected == $i) { $ss = " selected"; } else { $ss = ""; }
		if ($i < 10) {
			$num = "0".$i;
			$data .= "\t<option value=\"".$num."\"$ss>".$num."</option>\n";
		} else {
			$data .= "\t<option value=\"".$i."\"$ss>".$i."</option>\n";
		}	
	}
	$data .= "</select>\n";
	return $data;
}

function getGenomeChrSELECT($name, $genome_id, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:100px'>\n";
	for ($i=1;$i<23;$i++) {
		if ($selected == "chr".$i) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"chr".$i."\"$ss>chr".$i."</option>\n";
	}
		$data .= "\t<option value=\"chrX\"$ss>chrX</option>\n";
		$data .= "\t<option value=\"chrY\"$ss>chrY</option>\n";
	$data .= "</select>\n";
	return $data;
}

function getClusterServerSELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:120px'>\n";
	if(getCDNUID() == 1) {
		$candidate = array(array("lionxg","Lionxg"));
		#$candidate = array(array("zeus", "Zeus"), array("zeus2","Zeus2"), array("zeus3","Zeus3"), array("hammer","Hammer"), array("lionxf", "Lionxf"), array("lionxg","Lionxg"), array("lionxv","Lionxv"));
	} else {
		$candidate = array(array("lionxg","Lionxg"));
	}
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getClusterWalltimeSELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:120px'>\n";
	$candidate = array(array("00:30:00", "30 minutes"), array("2:00:00", "2 hours"), array("10:00:00","10 hours"), array("20:00:00","20 hours"), array("50:00:00","50 hours"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getClusterMemorySELECT($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:120px'>\n";
	$candidate = array(array("1gb","1gb"), array("2gb", "2gb"), array("4gb","4gb"), array("6gb","6gb"), array("10gb","10gb"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function getPughLabScriptSELECT($name, $selected = "", $javascript = "") {
	$connect = connectDB("PUGHLAB");
	$data = "<select name=\"$name\" $javascript style='width:200px'>\n";
	$sql = "SELECT FILENAME from PughLabScriptInfo where USE_FLAG='Y';";
	$result = mysql_query($sql, $connect);
	while ($row = mysql_fetch_array($result)) {
		if ($selected == $row[0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$row[0]."\"$ss>".$row[0]."</option>\n";
	}
	mysql_free_result($result);
	$data .= "</select>\n";
	mysql_close($connect);
	return $data;
}

function getPughLabScriptSELECT2($name, $selected = "", $javascript = "") {
	global $connect;
	$data = "<select name=\"$name\" $javascript style='width:200px'>\n";
	$candidate = array(array("example.pbs","example.pbs"), array("gem.jar","gem.jar"));
	for ($i=0;$i<count($candidate);$i++) {
		if ($selected == $candidate[$i][0]) { $ss = " selected"; } else { $ss = ""; }
		$data .= "\t<option value=\"".$candidate[$i][0]."\"$ss>".$candidate[$i][1]."</option>\n";
	}
	$data .= "</select>\n";
	return $data;
}

function moveURL($url) {
	echo("<html><script language=javascript> location.href='$url' </script></html>");
}

function moveURLMessage($url, $message) {

	echo("<html><script language=javascript> alert('$message'); location.href='$url'; </script></html>");
}

# Secure Session Functions
function sec_session_start() {
        $session_name = 'pughlab_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(); // regenerated the session, delete the old one.  
}

function login($email, $password, $mysqli) {
   // Using prepared Statements means that SQL injection is not possible. 
   if ($stmt = $mysqli->prepare("SELECT USER_ID, EMAIL, PASSWORD FROM PughLabUserInfo WHERE EMAIL = '".getCDNEMAIL()."' LIMIT 1")) { 
      $stmt->bind_param('s', $email); // Bind "$email" to parameter.
      $stmt->execute(); // Execute the prepared query.
      $stmt->store_result();
      $stmt->bind_result($user_id, $username, $db_password); // get variables from result.
      $stmt->fetch();
      $password = hash('sha512', md5($password)); // hash the password with the unique salt.
 
      if($stmt->num_rows == 1) { // If the user exists
         // We check if the account is locked from too many login attempts
         if(checkbrute($user_id, $mysqli) == true) { 
            // Account is locked
            // Send an email to user saying their account is locked
            return false;
         } else {
         if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
            // Password is correct!
 
 
               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
               $_SESSION['user_id'] = $user_id; 
               $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
               $_SESSION['username'] = $username;
               $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
               
		echo($_SESSION['user_id']);exit;
		// Login successful.
               return true;    
         } else {
            // Password is not correct
            // We record this attempt in the database
            $now = time();
            #$mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
            return false;
         }
      }
      } else {
         // No user exists. 
         return false;
      }
   }
}

function checkbrute($user_id, $mysqli) {
   return false;

   // Get timestamp of current time
   $now = time();
   // All login attempts are counted from the past 2 hours. 
   $valid_attempts = $now - (2 * 60 * 60); 
 
   if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
      $stmt->bind_param('i', $user_id); 
      // Execute the prepared query.
      $stmt->execute();
      $stmt->store_result();
      // If there has been more than 5 failed logins
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

function login_check($mysqli) {
   // Check if all session variables are set
   if(isset($_SESSION['user_email'], $_SESSION['login_string'])) {
     $user_email = $_SESSION['user_email'];
     $login_string = $_SESSION['login_string'];
 
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
     if ($stmt = $mysqli->prepare("SELECT PASSWORD FROM PughLabUserInfo WHERE USER_ID = ".getCDNUID()." LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($password); // get variables from result.
           $stmt->fetch();
           $login_check = hash('sha512', $password.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
              return true;
           } else {
              // Not logged in
              return false;
           }
        } else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}

# Alert Form

function alertFormR ($message, $url) {
	$message = ereg_replace("\n", "\\n", $message);
	$message = ereg_replace("\t", "\\t", $message);
	$message = ereg_replace("'", "\\'", $message);
?>
<html>
<body>
<script language="javascript">
	alert("<?php echo($message);?>");
	location.href="<?php echo($url);?>";
</script>
</body> 
</html>
<?php
	exit();
} 
?>
