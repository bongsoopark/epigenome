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
%%FOOTER%%
</html>
