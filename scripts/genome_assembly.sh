#hello world
#Retrieve genome assembly script
mkdir -p /home/html/epigenomedb/genome_assembly/GCF_000001895.5_Rnor_6.0
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_genomic.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_rna.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_protein.faa.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_genomic.gff.gz
gunzip GCF_000001895.5_Rnor_6.0_genomic.fna.gz
gunzip GCF_000001895.5_Rnor_6.0_rna.fna.gz
gunzip GCF_000001895.5_Rnor_6.0_protein.faa.gz
gunzip GCF_000001895.5_Rnor_6.0_genomic.gff.gz
grep ">" GCF_000001895.5_Rnor_6.0_protein.faa > protein_list.txt
echo 'python ../extract_proteome.py 17 > extract_proteome.sql' > run.sh
echo 'python ../extract_feature.py 17 GCF_000001895.5_Rnor_6.0_genomic.gff > extract_feature.sql' >> run.sh
mv *GCF_000001895.5_Rnor_6.0* /home/html/epigenomedb/genome_assembly/GCF_000001895.5_Rnor_6.0/.
mv run.sh /home/html/epigenomedb/genome_assembly/GCF_000001895.5_Rnor_6.0/.
mv protein_list.txt /home/html/epigenomedb/genome_assembly/GCF_000001895.5_Rnor_6.0/.
