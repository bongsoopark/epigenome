%%HEADER%%
<h3><a href='#'>Regulome (Histone modifying enzymes)</a></h3>
Histones are highly basic, nuclear proteins that provide physical means for eukaryotic DNA to be organized and packaged into chromatin. It has been shown that both the histone tails and globular domains are subjected to a diverse array of the posttranslational covalent modifications (for example, acetylation and methylation), and that such modifications are pivotal for regulating chromatin dynamics and transcriptional output of the gene/genome. Histone modifying enzymes are important in this molecular mechanism. Currently, 25 genes were classified to Histone modifying enzymes in Yeast.
<h3><a href='/epigenome/browse/species/?txid=%%$DATA2->ncbi_txid%%'>%%$DATA2->genus_name%% %%$DATA2->species_name%% %%$DATA2->strain_name%%</a></h3>
%%$DATA2->lineage%%
<br>
<h3>%%$assay_name%%</h3>
<table width=1000 border=1>
<tr><td colspan=13><a href='javascript:save_to_cart(document.list,"CHECKBOX",%%$list_cnt%%);'>Save to FAVORITE cart</a> <img src='/epigenome/img/help.gif'></td></tr>
<tr>
    <td><b>Chk</b></td>
    <td><b>Regulome class</b></td>
    <td><b>Locus name</b></td>
    <td><b>Gene name</b></td>
    <td><b>Description</b></td>
    <td><b>Accession#</b></td>
    <td><b>Length(aa)</b></td>
</tr>
<form name=list method=post action=/epigenome/save_to_cart.php>
<input type=hidden id=sample_ids name=sample_ids value="">
<input type=hidden id=a name=a value="save">
<input type=hidden id=redirect name=redirect value="/epigenome/browse/dataset/?assay=%%$assay%%">
%%!if($list_cnt != 0)%%
%%!section(data = $DATA3)%%
<tr>
    <td><input type=checkbox id='CHECKBOX_%%#_sidx%%' value='2:%%$DATA3[_sidx]->sra_id%%'></td>
    <td>%%$DATA3[_sidx]->regulome_class%%</td>
    <td>%%$DATA3[_sidx]->note%%</td>
    <td>%%$DATA3[_sidx]->antibody%%</td>
    <td>%%$DATA3[_sidx]->celltype%%</td>
    <td>%%$DATA3[_sidx]->mutation%%</td>
    <td>%%$DATA3[_sidx]->media%%</td>
</tr>
%%!endsection%%
%%!endif%%
</form>
</table>
<br><br>
<br><br>
%%FOOTER%%
</html>
