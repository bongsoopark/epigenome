%%HEADER%%
<h3>Species</h3>
We are glad that 20 species have been added into ECEP v0.1. The species and lineage information are derived from NCBI Taxonomy database. The below is a list of species available in the database. Please let us know if you want to add more species and the associated genomes here. You can specify the taxon id from NCBI Taxonomy database, or provide us the full name of the species (e.g. genus + species + strain). If you want to add the third party genome, please specify the URL we can access. <br><br> 
<a href='http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi'>NCBI - Organisms commonly used in molecular research projects:</a><br>
<a href='https://genome.ucsc.edu/cgi-bin/hgGateway'>UCSC - Genome gateway</a><br>
<a href='http://sites.psu.edu/pughlab/'>CEGR - Reference genomes</a><br>
<a href='http://cfgp.riceblast.snu.ac.kr/'>CFGP - Plant & Phytobiome</a>
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
<h4>Request new Species</h4>
<input type=text size=50> [Request]
<br>
<br>
%%FOOTER%%
</html>
