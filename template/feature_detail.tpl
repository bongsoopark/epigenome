%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<h3><a href='/epigenome/browse/species.php'>Species</a></h3>
The species and lineage information are derived from NCBI Taxonomy database. The below are the list of species available in the database. Please let me know if you want to add more species (genomes) here. You can specify the taxon id from NCBI Taxonomy database, or provide us the full name of the species (e.g. genus + species + strain).<br><br> 
<h3><a href='/epigenome/browse/species/?txid=%%$DATA2->ncbi_txid%%'>%%$DATA2->genus_name%% %%$DATA2->species_name%% %%$DATA2->strain_name%%</a></h3>
%%$DATA2->lineage%%
<br>
<br>
<h3>Reference Features: %%$tc%%</h3>
Search by keyword: <input type=text size=30> [Search]<br><br>
<table width=900 border=1>
<tr>
    <td><b>Chk</b></td>
    <td><b>Feature</b></td>
    <td><b>Count</b></td>
    <td><b>Description</b></td>
    <td><b>Accession#</b></td>
    <td><b>Length(aa)</b></td>
</tr>
%%!if($DATA_CNT3 != 0)%%
%%!section(data = $DATA3)%%
<tr>
    <td><input type=checkbox></td>
    <td>%%$DATA3[_sidx]->feature%%</td>
    <td>%%$DATA3[_sidx]->feature_count%%</td>
    <td>%%$DATA3[_sidx]->name%%</td>
    <td><a href='http://www.ncbi.nlm.nih.gov/protein/%%$DATA3[_sidx]->ncbi_accession%%' target='_blank'>%%$DATA3[_sidx]->ncbi_accession%% <img src='/epigenome/img/link.jpeg' width=20></a></td>
    <td>%%$DATA3[_sidx]->genome_size%%</td>
</tr>
%%!endsection%%
%%!endif%%
</table>
<table width=900 border=1>
<tr><td>
Page navigation First Previous %%$page_list%% Next Last
</td></tr></table>
<br><br>
%%FOOTER%%
</html>
