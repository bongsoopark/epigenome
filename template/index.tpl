%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<br>
<h3>Database Statistics</h3>
5 Species<br>
5 Genomes<br>
XX Datasets<br>
XX Tools<br>
XX Analysis<br>
<br>
<h3>Sub-Database Statistics</h3>
XX CRs<br>
XX TFs<br>
XX HMs<br>
<br>
<h3>Top Species</h3>
%%!if($DATA_CNT != 0)%%
%%!section(data = $DATA)%%
%%$DATA[_sidx]%%<br>
%%!endsection%%
%%!endif%%
<br>
<h3>User Statistics</h3>
XX Visits this week
<br><br>
<h3>SNS Update - Twitter etc.</h3>
What's going on?
<br><br>
Currently, there are five genomes available. (sacCer3, mm10, hg38, dm6, and TAIR10)<br><br>
%%FOOTER%%
</html>
