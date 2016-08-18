#hello world
#Retrieve genome assembly script
mkdir -p /home/html/epigenomedb/genome_assembly/GCF_000001405.34_GRCh38.p8
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001405.34_GRCh38.p8/GCF_000001405.34_GRCh38.p8_genomic.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001405.34_GRCh38.p8/GCF_000001405.34_GRCh38.p8_rna.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001405.34_GRCh38.p8/GCF_000001405.34_GRCh38.p8_protein.faa.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF_000001405.34_GRCh38.p8/GCF_000001405.34_GRCh38.p8_genomic.gff.gz
gunzip GCF_000001405.34_GRCh38.p8_genomic.fna.gz
gunzip GCF_000001405.34_GRCh38.p8_rna.fna.gz
gunzip GCF_000001405.34_GRCh38.p8_protein.faa.gz
gunzip GCF_000001405.34_GRCh38.p8_genomic.gff.gz
mv *GCF_000001405.34_GRCh38.p8* /home/html/epigenomedb/genome_assembly/GCF_000001405.34_GRCh38.p8/.
