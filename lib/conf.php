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
	# MySQL connection
	$con = new mysqli("localhost", "bongsoo", "450NFrear", "analysis");
	if ($con->connect_error) {
		echo("Database Connection Error");
	}

	mysqli_query($con, "insert into security_check (ip_address, request_uri, access_time) values ('".$ip_address."','".$request_uri."',now());");
	mysqli_close($con);
}

# Visit check
visitCheck($_SERVER["REMOTE_ADDR"],$_SERVER["REQUEST_URI"]);

#-------------- Database Configuration ----------------#

$Conf["DEFAULT_DIRECTORY"] = "/home/html/epigenome";
$Conf["DEFAULT_DIRECTORY_TEMPLATE"] = $Conf["DEFAULT_DIRECTORY"]."/template";
$Conf["DEFAULT_DIRECTORY_DATA"] = $Conf["DEFAULT_DIRECTORY"]."/data";
?>
