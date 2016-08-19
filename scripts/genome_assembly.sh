#hello world
#Retrieve genome assembly script
mkdir -p /home/html/epigenomedb/genome_assembly/GCF_000001735.3_TAIR10
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001735.3_TAIR10/GCF_000001735.3_TAIR10_genomic.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001735.3_TAIR10/GCF_000001735.3_TAIR10_rna.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001735.3_TAIR10/GCF_000001735.3_TAIR10_protein.faa.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001735.3_TAIR10/GCF_000001735.3_TAIR10_genomic.gff.gz
gunzip GCF_000001735.3_TAIR10_genomic.fna.gz
gunzip GCF_000001735.3_TAIR10_rna.fna.gz
gunzip GCF_000001735.3_TAIR10_protein.faa.gz
gunzip GCF_000001735.3_TAIR10_genomic.gff.gz
mv *GCF_000001735.3_TAIR10* /home/html/epigenomedb/genome_assembly/GCF_000001735.3_TAIR10/.
