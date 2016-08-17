<?php
function getPughLabFileInfoArray($sample_file_list, $file_type) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT FILE_ID, SAMPLE_ID, FILENAME from PughLabFileInfo where USE_FLAG='Y' and FILE_TYPE like '%$file_type%' and FILE_ID in ($sample_file_list);";
	$result = mysql_query($sql, $connect);
	$cnt = 0;
	$file_id_array = array();
	$filename_array = array();
	while($row = mysql_fetch_array($result)) {
		$filename = $row[2];
		$file_id_array[$cnt] = $row[0];
		$filename_array[$cnt] = $filename;
		$cnt++;
	}
	mysql_free_result($result);
	mysql_close($connect);

	return array($cnt, $file_id_array, $filename_array);
}

function getPughLabFileInfoArray2($sample_file_list, $file_type) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT FILE_ID, UNIQ_ID, FILENAME from PughLabFileInfo where USE_FLAG='Y' and FILE_TYPE like '%$file_type%' and FILE_ID in ($sample_file_list);";
	$result = mysql_query($sql, $connect);
	$cnt = 0;
	$file_id_array = array();
	$filename_array = array();
	$samplename_array = array();
	while($row = mysql_fetch_array($result)) {
		$sql2 = "SELECT NAME from PughLabSampleInfo where UNIQ_ID='$row[1]';";
		$result2 = mysql_query($sql2, $connect);
		list($sample_name) = mysql_fetch_array($result2);
		mysql_free_result($result2);
		
		$file_id_array[$cnt] = $row[0];
		$filename_array[$cnt] = $row[2];
		$samplename_array[$cnt] = $sample_name;
		$cnt++;
	}
	mysql_free_result($result);
	mysql_close($connect);

	return array($cnt, $file_id_array, $filename_array, $samplename_array);
}

function getPughLabOutputFileInfoArray($sample_file_list) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT OUTPUT_FILE_ID, FILENAME from PughLabFileOutputInfo where USE_FLAG='Y' and OUTPUT_FILE_ID in ($sample_file_list);";
	$result = mysql_query($sql, $connect);
	$cnt = 0;
	$file_id_array = array();
	$filename_array = array();
	while($row = mysql_fetch_array($result)) {
		$file_id_array[$cnt] = $row[0];
		$filename_array[$cnt] = $row[1];
		$cnt++;
	}
	mysql_free_result($result);
	mysql_close($connect);
	return array($cnt, $file_id_array, $filename_array);
}

function inputPughLabFileOutputInfo ($task_id, $file_id, $input_file_source, $filename, $file_type) {
	$connect = connectDB("PUGHLAB");
	$sql = "INSERT INTO PughLabFileOutputInfo (TASK_ID, INPUT_FILE_ID, INPUT_FILE_SOURCE, FILENAME, FILE_TYPE) values ('".$task_id."','".$file_id."','".$input_file_source."','".$filename."','".$file_type."');";
	$result = mysql_query($sql, $connect);
	mysql_close($connect);
}

function inputCurrentQueryUserInfo ($user_id, $session_id, $sample_file_list, $file_source = 'FileInfo') {
	$connect = connectDB("PUGHLAB");
	$sql = "DELETE from PughLabCurrentQueryUserInfo where USER_ID=$user_id;";
	$result = mysql_query($sql, $connect);
	$sql = "INSERT INTO PughLabCurrentQueryUserInfo (USER_ID, SESSION_ID, FILE_IDS, FILE_SOURCE) values ('$user_id','$session_id','$sample_file_list', '$file_source');";
	$result = mysql_query($sql, $connect);
	mysql_close($connect);
}

function getCurrentQueryUserInfo ($user_id) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT FILE_IDS, FILE_SOURCE from PughLabCurrentQueryUserInfo where USER_ID=$user_id;";
	$result = mysql_query($sql, $connect);
	list($sample_file_list, $file_source) = mysql_fetch_array($result);
	mysql_free_result($result);


	if ($file_source == "FileInfo") {	
		$sql = "SELECT distinct(a.SAMPLE_ID) from PughLabSampleInfo a, PughLabFileInfo b where a.UNIQ_ID = b.UNIQ_ID and b.FILE_ID in ($sample_file_list);";
		$result = mysql_query($sql, $connect);
		while($row = mysql_fetch_array($result)) {
			$sample_ids .= $row[0].",";
		}
		$sample_ids = substr($sample_ids, 0, strlen($sample_ids)-1);
		mysql_free_result($result);
	} else {
		$sample_ids = "No-FileOutputInfo";
	}
	mysql_close($connect);
	return array($sample_ids, $sample_file_list);
}

function getScriptNameFromScriptID($script_id) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT FILENAME from PughLabScriptInfo where SCRIPT_ID=$script_id;";
	$result = mysql_query($sql, $connect);
	list($name) = mysql_fetch_array($result);
	mysql_free_result($result);
	mysql_close($connect);
	return $name;
}

function getSummaryReportInfo($filename) {
	$connect = connectDB("PUGHLAB");
	$sql = "SELECT SUMMARY_REPORT from PughLabSequencingRunSampleInfo where UNIQ_ID like '%$filename%'";
	$result = mysql_query($sql, $connect);
	list($filename) = mysql_fetch_array($result);
	mysql_free_result($result);
	return $filename;
}

function getMillionNumber($index_count) {
	if ($index_count < 100000) {
		$index_count = '< 0.1';
	} else {
		$index_count = number_format($index_count);
		$count = split(",",$index_count);
		if (count($count) == 3) {
			$index_count = $count[0];
			$index_count = $index_count.".".substr($count[1], 0, 1);
		} else if (count($count) == 2) {
			$index_count = "0.".substr($count[0], 0, 1);
		}
	}
	return $index_count;
}

function goGeneTrack($script, $server, $a, $sample_file_list, $cnt, $max_task_cnt, $parameter_info, $flag1, $flag2, $flag3, $dv1, $dv2, $dv3, $pbs_script1, $pbs_script2, $pbs_script3) {
	$task_id_array = array();
	$pbs_script_array = array();

	if($a == "analysis") {
		list($cnt, $file_id_array, $filename_array) = getPughLabFileInfoArray($sample_file_list, "TAB");
		$file_source = "FileInfo";	
	} else {
		list($cnt, $file_id_array, $filename_array) = getPughLabOutputFileInfoArray($sample_file_list);
		$file_source = "FileOutputInfo";	
	}

	if($cnt == 0) {
		echo("There is no available tab(idx) files");
		exit;
	} else if($cnt > $max_task_cnt) {
		echo("Chip-exo Analysis 0.2 doesn't support more than 3 files now.");
		exit;
	}

	for($i = 0 ; $i < $cnt ; $i++) {
		$pbs_script = "";
		$filename = $filename_array[$i];
		$tmp = split("/", $filename);
		$input_file_name = $tmp[count($tmp)-1];

		$connect = connectDB("PUGHLAB");
		$sql = "INSERT INTO PughLabTaskInfo (SCRIPT_ID, USER_ID, CLUSTER, STATUS, START_TIME, SCRIPT_NAME, INPUT_FILE_NAME, NUM_INPUT_FILES) values ('1','".getCDNUID()."','$server','Q','".time()."','$script','$input_file_name','1');";
		$result = mysql_query($sql, $connect);
		$task_id = mysql_insert_id($connect);
		mysql_close($connect);

		$task_id_array[$i] = $task_id;
		$simple_filename = "/gpfs/cyberstar/pughhpc/archive/2013_Analysis/run_$task_id/".substr($tmp[count($tmp)-1],0,strlen($tmp[count($tmp)-1])-4);

		$parameter_array = split("|", $parameter_info);

		$pbs_script .= "#Step0: Create the target directory\n";
		$pbs_script .= "mkdir /gpfs/cyberstar/pughhpc/archive/2013_Analysis/run_$task_id\n\n";
		$pbs_script .= "#Step1: Copy the tab file\ncp $filename .\n\n";

		if($flag1 == "N") {
		} else {
			$pbs_script .= $pbs_script1."\n";
			$pbs_script .= "
mv /gpfs/home/bxp12/scratch/PBSFREE/run_$task_id/genetrack$dv1/* /gpfs/cyberstar/pughhpc/archive/2013_Analysis/run_$task_id/.\n
";	
			inputPughLabFileOutputInfo($task_id,$file_id_array[$i],$file_source,$simple_filename.$dv1.".gff","GFF");
		}
		if($flag2 == "N") {
		} else {
			$pbs_script .= $pbs_script2."\n";
			$pbs_script .= "
mv /gpfs/home/bxp12/scratch/PBSFREE/run_$task_id/genetrack$dv2/* /gpfs/cyberstar/pughhpc/archive/2013_Analysis/run_$task_id/.\n
";	
			inputPughLabFileOutputInfo($task_id,$file_id_array[$i],$file_source,$simple_filename.$dv2.".gff","GFF");
		}
		$pbs_script_array[$i] = $pbs_script;	
	}

	return array($task_id_array, $pbs_script_array);
}

function getDefaultParameters($id) {
	$xmlDoc=new DOMDocument();
	$xmlDoc->load("/var/www/html/archive/xml_files/scripts_".$id.".xml");
	$x=$xmlDoc->getElementsByTagName('input');
	$x2=$x->item(0)->getElementsByTagName('filetype');
	$input_type = $x2->item(0)->childNodes->item(0)->nodeValue;
	$x=$xmlDoc->getElementsByTagName('output');
	$x2=$x->item(0)->getElementsByTagName('filetype');
	$output_type = $x2->item(0)->childNodes->item(0)->nodeValue;

	$x=$xmlDoc->getElementsByTagName('parameters');

	for($i=0; $i<($x->length); $i++) {
	    $x2=$x->item($i)->getElementsByTagName('parameter');
	    for($j=0; $j<($x2->length); $j++) {
		$y=$x2->item($j)->getElementsByTagName('title');
		$z=$x2->item($j)->getElementsByTagName('value');
		$aData[$i]->PARAMETER.=$y->item(0)->childNodes->item(0)->nodeValue.",";
		$aData[$i]->DEFAULT_VALUE.=$z->item(0)->childNodes->item(0)->nodeValue.",";
	    }
	}
	return array($input_type, $output_type, $aData);
}
?>

