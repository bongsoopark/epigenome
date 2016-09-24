# 2016-08-16 Project launch
# Eukaryotic Comparative Epigenomics Platform (2016-2018) Rev1
# By Bongsoo Park, Ph.D

# Project Diary
@2016-09-24 3:14AM
I came back to my project.
1 Month later, I forgot many things. What can I do?
First, I would like to add more genomes. For examples,
21 genomes in the main page of Taxonomy browser. 

1) python3 check_taxonomy.py Bos taurus
2) I created a sql file named "check_taxonomy.sql", then
update the database, and main page. 
3) I want to update the genome dataset too.
first, manually insert new key
insert into genome (species_id, assembly_id, db_key, epigenomedb) values ('6','GCA_000003205.6','','GCA_000003205.6_Btau_5.0.1');
then, create shell script.
php genome_assembly.php > genome_assembly.sh

4) Bos Taurus genome have two assemblies, so this is the first 
case that we have two genome version for one species.
Copy and Paste the genome information from NCBI genome assembly.
python genome_update.py 6 > genome_update.sql
mysql -u bongsoo genome -p < genome_update.sql
It's done. Currently, 6 genome doesn't have any proteome. 
so, we will use assembly 7. UMD version.

@2016-08-18 Afternoon
1) Proteome update script has been updated.
proteome_update.py will create the 'proteome_update.fa'
It can be a subject to InterPro scanning. 
2) InterProScan v5.19-58.0 downloaed.
It works in the lionx cluster or zeus VM.
sh interproscan.sh -i test_proteins.fasta -f tsv

#2016-08-18 Morning
1)Update the database architecture to support epigenomedb key
2)php script to retrieve the genome datasets, reference features
php genome_assembly.php > genome_assembly.sh
-> Please update the database, php file manually (1-5)
-> You have to assign genome_id. Better idea?
3)Execute the genome_assembly script
sh genome_assembly.sh

#2016-08-17 Download the genome info table is time consuming. Is there any way to make it automated?
1)Check, Taxon ID, and Lineage
2)Copy and paste the genome info to excel file
3)Replicate ',' to '', then create genome_update.csv
4)Transfer the file into ATLAS epigenome/scripts folder
5)Execute the update_genome python script

#2016-08-16 Afternoon
1. Create genome database (species, genome, chromosome, nuc_sequence, pro_sequence)
2. Update database using update_genome script
Copy and paste the genome statisitcs page form NCBI genome database
python3 update_genome.py > update_genome.sql
mysql -u bongsoo genome -p < update_genome.sql

#2016-08-16 Download the list of species from NCBI Genome site
Currently, 16811 genomes are available. Among them, 3357 genomes belong to Eukaryotes
1. Download yeast genome
- Commonly used genome list featured
2. Check the top taxonomy
http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi
Archaea, Bacteria, Eukaryota, Viroids, Viruses, Other, Unclassfied
3. Download Saccharomyces cerevisiae genome (txid4932)
Lineage(Full) - cellular organisms; Eukaryota; Opisthokonta; Fungi; Dikarya; Ascomycota; saccharomyceta; Saccharomycotina; Saccharomycetes; Saccharomycetales; Saccharomycetaceae; Saccharomyces
4. Attempting to Obtain Taxonomic Information from BioPython
Document:
http://stackoverflow.com/questions/16504238/attempting-to-obtain-taxonomic-information-from-biopython
5. Retrieve
python3 check_taxonomy.py


