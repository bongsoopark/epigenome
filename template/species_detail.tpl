%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<h3><a href='/epigenome/browse/species.php'>Species</a></h3>
The species and lineage information are derived from NCBI Taxonomy database. The below are the list of species available in the database. Please let me know if you want to add more species (genomes) here. You can specify the taxon id from NCBI Taxonomy database, or provide us the full name of the species (e.g. genus + species + strain).<br><br> 
<h3>%%$DATA->genus_name%% %%$DATA->species_name%% %%$DATA->strain_name%%</h3>
%%$DATA->lineage%%
<br>
<br>
<h3>Genomes</h3>
<table width=700 border=1>
<tr><td><b>Assembly ID (NCBI)</b></td><td><b>DB Key (UCSC, Galaxy)</b></td><td><b>Chromosome</b></td><td><b>Proteome</b></td><td><b>Reference features</b></td></tr>
%%!if($DATA_CNT2 != 0)%%
%%!section(data = $DATA2)%%
<tr><td><a href='/epigenome/browse/genome/?gid=%%$DATA2[_sidx]->assembly_id%%'>%%$DATA2[_sidx]->assembly_id%%</a></td><td>%%$DATA2[_sidx]->db_key%%</td><td>%%$DATA2[_sidx]->chromosome%%</td><td><a href='/epigenome/browse/proteome/?gid=%%$DATA2[_sidx]->assembly_id%%'>%%$DATA2[_sidx]->proteome%%</a></td>
<td><a href='/epigenome/browse/feature/?gid=%%$DATA2[_sidx]->assembly_id%%'>%%$DATA2[_sidx]->reference_features%%</a></td></tr>
%%!endsection%%
%%!endif%%
</table>
<br>
%%FOOTER%%
</html>
