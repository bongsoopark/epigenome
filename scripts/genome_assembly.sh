#hello world
#Retrieve genome assembly script
mkdir -p /home/html/epigenomedb/genome_assembly/GCA_000003055.5_Bos_taurus_UMD_3.1.1
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCA_000003055.5_Bos_taurus_UMD_3.1.1/GCA_000003055.5_Bos_taurus_UMD_3.1.1_genomic.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCA_000003055.5_Bos_taurus_UMD_3.1.1/GCA_000003055.5_Bos_taurus_UMD_3.1.1_rna.fna.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCA_000003055.5_Bos_taurus_UMD_3.1.1/GCA_000003055.5_Bos_taurus_UMD_3.1.1_protein.faa.gz
wget ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCA_000003055.5_Bos_taurus_UMD_3.1.1/GCA_000003055.5_Bos_taurus_UMD_3.1.1_genomic.gff.gz
gunzip GCA_000003055.5_Bos_taurus_UMD_3.1.1_genomic.fna.gz
gunzip GCA_000003055.5_Bos_taurus_UMD_3.1.1_rna.fna.gz
gunzip GCA_000003055.5_Bos_taurus_UMD_3.1.1_protein.faa.gz
gunzip GCA_000003055.5_Bos_taurus_UMD_3.1.1_genomic.gff.gz
mv *GCA_000003055.5_Bos_taurus_UMD_3.1.1* /home/html/epigenomedb/genome_assembly/GCA_000003055.5_Bos_taurus_UMD_3.1.1/.
