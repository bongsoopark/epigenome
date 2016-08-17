%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform (by Bongsoo Park)</h2>
<br>
<h3>Species</h3>
%%!if($DATA_CNT != 0)%%
%%!section(data = $DATA)%%
%%$DATA[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<br>
<h3>Genomes</h3>
%%!if($DATA_CNT2 != 0)%%
%%!section(data = $DATA2)%%
%%$DATA2[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<br>
<h3>Genome Info</h3>
%%!if($DATA_CNT3 != 0)%%
%%!section(data = $DATA3)%%
%%$DATA3[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<br><br>
<h3>Notes</h3>
Currently, there are five genomes available. (sacCer3, mm10, hg38, dm6, and TAIR10)<br><br>
%%FOOTER%%
</html>
