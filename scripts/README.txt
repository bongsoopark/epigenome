# 2016-08-16 Project launch
# Eukaryotic Comparative Epigenomics Platform (2016-2018) Rev1
# By Bongsoo Park, Ph.D

# Project Diary
2016-08-16 Download the list of species from NCBI Genome site
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

2016-08-16 Afternoon

1. Create genome database (species, genome, chromosome, nuc_sequence, pro_sequence)

2. Update database using update_genome script
Copy and paste the genome statisitcs page form NCBI genome database

python3 update_genome.py > update_genome.sql
mysql -u bongsoo genome -p < update_genome.sql

