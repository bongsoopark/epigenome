<?php
# ECEP Project
$DBConf["GENOME_DB_TYPE"] = "MySQL";
$DBConf["GENOME_HOST"] = "localhost";
$DBConf["GENOME_DB"] = "genome";
$DBConf["GENOME_USER"] = "bongsoo";
$DBConf["GENOME_PASS"] = "450NFrear";
# MySQL connection
$con = new mysqli($DBConf["GENOME_HOST"], $DBConf["GENOME_USER"], $DBConf["GENOME_PASS"], $DBConf["GENOME_DB"]);
if ($con->connect_error) {
	echo("Database Connection Error");
}
print("#hello world\n");
print("#Retrieve genome assembly script\n");

# You should change this number to register the genome 
$num = 17;

# Update the genome_id
$sql = "SELECT epigenomedb from genome where id=$num;";
$result = $con->query($sql);
$row = $result->fetch_object();
$result->free();
$con->close();

$epigenomedb = $row->epigenomedb;
print("mkdir -p /home/html/epigenomedb/genome_assembly/$epigenomedb\n");
print("wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/$epigenomedb/".$epigenomedb."_genomic.fna.gz\n");
print("wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/$epigenomedb/".$epigenomedb."_rna.fna.gz\n");
print("wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/$epigenomedb/".$epigenomedb."_protein.faa.gz\n");
print("wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/$epigenomedb/".$epigenomedb."_genomic.gff.gz\n");

print("gunzip ".$epigenomedb."_genomic.fna.gz\n");
print("gunzip ".$epigenomedb."_rna.fna.gz\n");
print("gunzip ".$epigenomedb."_protein.faa.gz\n");
print("gunzip ".$epigenomedb."_genomic.gff.gz\n");
print("grep \">\" ".$epigenomedb."_protein.faa > protein_list.txt\n");
print("echo 'python ../extract_proteome.py $num > extract_proteome.sql' > run.sh\n");
print("echo 'python ../extract_feature.py $num ".$epigenomedb."_genomic.gff > extract_feature.sql' >> run.sh\n");
 
print("mv *$epigenomedb* /home/html/epigenomedb/genome_assembly/$epigenomedb/.\n");
print("mv run.sh /home/html/epigenomedb/genome_assembly/$epigenomedb/.\n");
print("mv protein_list.txt /home/html/epigenomedb/genome_assembly/$epigenomedb/.\n");
?>
