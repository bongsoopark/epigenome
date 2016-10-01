%%HEADER%%
<h3>Favorite Cart</h3>
Favorite Cart is the repository of any given sequences or NGS assays. You can also save the reference features here. It is a cart of collection of sequence, so you can submit any additional jobs from here. Generally, you will collect the sequences from browser to start the comparative genomics analysis. If you want to do any epigenome analysis, you will collect the samples from NGS dataset. In case of the comparative epigenomics, you will have epigenome dataset along with multiple species (yeast vs mouse, yeast vs human, or mouse vs human). You can also think about a senario that you can compare different cell types or different source from the same cell types such as cancer cells. Cancer cells are known to be highly heterogenious, so comparative epigenomics approach may be useful.  
<h3><a href='/epigenome/browse/species/?txid=%%$DATA2->ncbi_txid%%'>%%$DATA2->genus_name%% %%$DATA2->species_name%% %%$DATA2->strain_name%%</a></h3>
<h3>1) Saved Sequences <img src='/epigenome/img/help.gif'></h3>
Comparative Genomics with selected sequences (e.g. homolog search)
<br>
<br>
<h3>2) Saved NGS Assays <img src='/epigenome/img/help.gif'></h3>
Epigenomics with selected samples (e.g. Heatmap around tags)<br><br>
<table width=960 border=1>
<tr><td colspan=13><a href='javascript:save_to_cart(document.list,"CHECKBOX",%%$list_cnt%%);'>Remove from FAVORITE cart</a> <img src='/epigenome/img/help.gif'></td></tr>
<tr>
    <td><b>Chk</b></td>
    <td><b>Target</b></td>
    <td><b>Antibody</b></td>
    <td><b>Cell type</b></td>
    <td><b>Mutation</b></td>
    <td><b>Media</b></td>
    <td><b>Perturbation</b></td>
    <td><b>Assay (Rep#)</b></td>
    <td><b>Genome</b></td>
    <td><b>Index Count <img src='/epigenome/img/help.gif'></b></td>
    <td><b>Unique mapped reads <img src='/epigenome/img/help.gif'></b></td>
    <td><b>SRA ID</b></td>
    <td><b>ReadType</b></td>
</tr>
<form name=list method=post action=/epigenome/save_to_cart.php>
<input type=hidden id=sample_ids name=sample_ids value="">
<input type=hidden id=a name=a value="remove">
<input type=hidden id=redirect name=redirect value="/epigenome/favorite/?user_id=0">
%%!if($list_cnt != 0)%%
%%!section(data = $DATA3)%%
<tr>
    <td><input type=checkbox id='CHECKBOX_%%#_sidx%%' value='2:%%$DATA3[_sidx]->sra_id%%'></td>
    <td>%%$DATA3[_sidx]->target%%</td>
    <td>%%$DATA3[_sidx]->antibody%%</td>
    <td>%%$DATA3[_sidx]->celltype%%</td>
    <td>%%$DATA3[_sidx]->mutation%%</td>
    <td>%%$DATA3[_sidx]->media%%</td>
    <td>%%$DATA3[_sidx]->perturb%%</td>
    <td>%%$DATA3[_sidx]->assay%% (%%$DATA3[_sidx]->replicate%%)</td>
    <td>%%$DATA3[_sidx]->genome%%</td>
    <td>%%$DATA3[_sidx]->index_count%%</td>
    <td>%%$DATA3[_sidx]->uniq_reads%%</td>
    <td><a href='http://www.ncbi.nlm.nih.gov/sra/?term=%%$DATA3[_sidx]->sra_id%%'>%%$DATA3[_sidx]->sra_id%%<img src='/epigenome/img/link.jpeg' width=20></a></td>
    <td>%%$DATA3[_sidx]->read_type%%</td>
</tr>
%%!endsection%%
%%!endif%%
</form>
</table>
<br><br>
<h3>3) Saved Reference features <img src='/epigenome/img/help.gif'></h3>
Default: RP Gene, SAGA, TFIID, SUTs, CUTs, XUTs
<br>
<br><br>
<h3>4) Strategic Methods <img src='/epigenome/img/help.gif'></h3>
Default: HeatMap Generation after Quantile normalization, Align to the mid point from Gene (TSS-TES) sorted by the length of the genes
<br><br>
<a href='javascript:go_analysis()'><img src=/epigenome/img/go_analysis.png></a><br><br>
%%FOOTER%%
</html>
