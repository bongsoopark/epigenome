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

$DBConf["PEGR_DB_TYPE"] = "MySQL";
$DBConf["PEGR_HOST"] = "localhost";
$DBConf["PEGR_DB"] = "pegr";
$DBConf["PEGR_USER"] = "bongsoo";
$DBConf["PEGR_PASS"] = "450NFrear";

$DBConf["PARKLAB_DB_TYPE"] = "MySQL";
$DBConf["PARKLAB_HOST"] = "localhost";
$DBConf["PARKLAB_DB"] = "parklab";
$DBConf["PARKLAB_USER"] = "bongsoo";
$DBConf["PARKLAB_PASS"] = "450NFrear";

$DBConf["PUGHLAB_DB_TYPE"] = "MySQL";
$DBConf["PUGHLAB_HOST"] = "localhost";
$DBConf["PUGHLAB_DB"] = "pughlab";
$DBConf["PUGHLAB_USER"] = "bongsoo";
$DBConf["PUGHLAB_PASS"] = "450NFrear";

$DBConf["GENOME_DB_TYPE"] = "MySQL";
$DBConf["GENOME_HOST"] = "localhost";
$DBConf["GENOME_DB"] = "genome";
$DBConf["GENOME_USER"] = "bongsoo";
$DBConf["GENOME_PASS"] = "450NFrear";

$DBConf["ANAYSIS_DB_TYPE"] = "MySQL";
$DBConf["ANAYSIS_HOST"] = "localhost";
$DBConf["ANAYSIS_DB"] = "analysis";
$DBConf["ANAYSIS_USER"] = "bongsoo";
$DBConf["ANAYSIS_PASS"] = "450NFrear";

$DBConf["DATASET_DB_TYPE"] = "MySQL";
$DBConf["DATASET_HOST"] = "localhost";
$DBConf["DATASET_DB"] = "dataset";
$DBConf["DATASET_USER"] = "bongsoo";
$DBConf["DATASET_PASS"] = "450NFrear";

function connectNewDB ($name) {
	return new mysqli($DBConf[$name."_HOST"], $DBConf[$name."_USER"], $DBConf[$name."_PASS"], $DBConf[$name."_DB"]);
}
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.
#-------------- Database Configuration ----------------#
?>
