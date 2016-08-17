%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<h3>Species</h3>
The species and lineage information are derived from NCBI Taxonomy database. The below are the list of species available in the database. Please let me know if you want to add more species (genomes) here. You can specify the taxon id from NCBI Taxonomy database, or provide us the full name of the species (e.g. genus + species + strain).<br><br> 
<br>
<h4>Top five species frequently used</h4>
%%!if($DATA_CNT != 0)%%
%%!section(data = $DATA)%%
%%$DATA[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<h4>Search by species name</h4>
<input type=text size=50> [Search]
<br>
<br>
<br>
%%FOOTER%%
</html>
