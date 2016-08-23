%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<h3><a href='/epigenome/browse/species.php'>Species</a></h3>
The species and lineage information are derived from NCBI Taxonomy database. The below are the list of species available in the database. Please let me know if you want to add more species (genomes) here. You can specify the taxon id from NCBI Taxonomy database, or provide us the full name of the species (e.g. genus + species + strain).<br><br> 
<h3><a href='/epigenome/browse/species/?txid=%%$DATA2->ncbi_txid%%'>%%$DATA2->genus_name%% %%$DATA2->species_name%% %%$DATA2->strain_name%%</a></h3>
%%$DATA2->lineage%%
<br>
<br>
<h3>Genomes</h3>
<table width=1000 border=1>
<tr>
    <td><b>Loc</b></td>
    <td><b>Type</b></td>
    <td><b>Name</b></td>
    <td><b>Accession</b></td>
    <td><b>Genome size (M)</b></td>
    <td><b>GC content (%)</b></td>
    <td><b>Protein</b></td>
    <td><b>rRNA</b></td>
    <td><b>tRNA</b></td>
    <td><b>otherRNA</b></td>
    <td><b>gene</b></td>
    <td><b>pseudogene</b></td>
</tr>
%%!if($DATA_CNT3 != 0)%%
%%!section(data = $DATA3)%%
<tr>
    <td>%%$DATA3[_sidx]->loc%%</td>
    <td>%%$DATA3[_sidx]->type%%</td>
    <td>%%$DATA3[_sidx]->name%%</td>
    <td><a href='http://www.ncbi.nlm.nih.gov/nuccore/%%$DATA3[_sidx]->ncbi_accession%%' target='_blank'>%%$DATA3[_sidx]->ncbi_accession%% <img src='/epigenome/img/link.jpeg' width=20></a></td>
    <td>%%$DATA3[_sidx]->genome_size%%</td>
    <td>%%$DATA3[_sidx]->gc_content%%</td>
    <td>%%$DATA3[_sidx]->protein%%</td>
    <td>%%$DATA3[_sidx]->rRNA%%</td>
    <td>%%$DATA3[_sidx]->tRNA%%</td>
    <td>%%$DATA3[_sidx]->otherRNA%%</td>
    <td>%%$DATA3[_sidx]->gene%%</td>
    <td>%%$DATA3[_sidx]->pseudogene%%</td>
</tr>
%%!endsection%%
%%!endif%%
</table>
<br>
<h3>Proteomes</h3>
<a href='/epigenome/browse/proteome/?gid=%%$gid%%'>Browse the proteomes</a><br>
<a href='/epigenomedb/genome_assembly/%%$DATA->epigenomedb%%/%%$DATA->epigenomedb%%_protein.faa' target='_blank'>Protein fasta download [NCBI]<img src='/epigenome/img/link.jpeg' width=20></a>
<br><br>
<h3>Genomic features</h3>
<a href='/epigenome/browse/feature/?gid=%%$gid%%'>Browse the reference features</a><br>
<a href='/epigenomedb/genome_assembly/%%$DATA->epigenomedb%%/%%$DATA->epigenomedb%%_genomic.gff' target='_blank'>Genomic feature download [NCBI]<img src='/epigenome/img/link.jpeg' width=20></a>
<br><br>
<br><br>
%%FOOTER%%
</html>
