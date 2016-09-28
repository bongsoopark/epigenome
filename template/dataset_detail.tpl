%%HEADER%%
<h3><a href='/epigenome/browse/datasets.php'>Datasets (NGS Assays)</a></h3>
NGS Datasets are freely available after publications. We collected large dataset for the meta analysis. SRA and GEO are main resource for datasets. Also, yeast, model organisms, mouse, and human ENCODE datasets are available. Please let us know what other datasets you want to use for the analysis.
<h3><a href='/epigenome/browse/species/?txid=%%$DATA2->ncbi_txid%%'>%%$DATA2->genus_name%% %%$DATA2->species_name%% %%$DATA2->strain_name%%</a></h3>
%%$DATA2->lineage%%
<br>
<h3>%%$assay_name%%</h3>
<table width=1000 border=1>
<tr><td colspan=13><a href='javascript:save_to_cart(document.list,"CHECKBOX",%%$list_cnt%%);'>Save to FAVORITE cart</a> <img src='/epigenome/img/help.gif'></td></tr>
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
%%!if($list_cnt != 0)%%
%%!section(data = $DATA3)%%
<tr>
    <td><input type=checkbox id='CHECKBOX_%%#_sidx%%' value='%%$DATA3[_sidx]->sra_id%%'></td>
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
<br><br>
%%FOOTER%%
</html>
