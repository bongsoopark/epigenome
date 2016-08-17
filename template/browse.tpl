%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
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
<h3>Proteomes</h3>
%%!if($DATA_CNT3 != 0)%%
%%!section(data = $DATA3)%%
%%$DATA3[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<br>
<h3>Regulomes (by Protein families)</h3>
Chromatin Remodelers<br>
Transcription Factors<br>
Histone Modifications<br>
<br>
<h3>Datasets (by Assay)</h3>
ChIP-exo<br>
ChIP-seq<br>
DNase-seq<br>
RNA-seq<br>
MNase-seq<br>
<br>
<h3>Notes</h3>
Currently, there are five genomes available. (sacCer3, mm10, hg38, dm6, and TAIR10)<br><br>
%%FOOTER%%
</html>
