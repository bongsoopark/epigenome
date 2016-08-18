<?php
#--------------------------------------------------------------------------------------------------------- 
# Configuration Library
#---------------------------------------------------------------------------------------------------------
# PHP Library - Configuration Library
# Version 1.0.0
#---------------------------------------------------------------------------------------------------------
# History
#---------------------------------------------------------------------------------------------------------
# Version 1.0.0 
#---------------------------------------------------------------------------------------------------------

function visitCheck($ip_address, $request_uri) {
	# IP Address check
	# 450 Frear North Lab
	$ip_list = array();
	array_push($ip_list, "146.186.153.196");
	array_push($ip_list, "71.58.100.80");
	array_push($ip_list, "73.79.229.76");
	$flag = 0;
	for ($i = 0 ; $i < count($ip_list) ; $i++) {
		if ($ip_list[$i] == $ip_address) {
			$flag = 1;
			break;
		}
	}

	if ($flag == 1) {
		# MySQL connection
		$con = new mysqli("localhost", "bongsoo", "450NFrear", "analysis");
		if ($con->connect_error) {
			echo("Database Connection Error");
		}

		mysqli_query($con, "insert into security_check (ip_address, request_uri, access_time) values ('".$ip_address."','".$request_uri."',now());");
		mysqli_close($con);
	} else {
		echo("Connection Error. Please contact the system administrator.");
		exit;
	}
}

# Visit check
visitCheck($_SERVER["REMOTE_ADDR"],$_SERVER["REQUEST_URI"]);

#-------------- Database Configuration ----------------#

$Conf["DEFAULT_DIRECTORY"] = "/home/html/epigenome";
$Conf["DEFAULT_DIRECTORY_TEMPLATE"] = $Conf["DEFAULT_DIRECTORY"]."/template";
$Conf["DEFAULT_DIRECTORY_DATA"] = $Conf["DEFAULT_DIRECTORY"]."/data";
?>
