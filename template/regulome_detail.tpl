%%HEADER%%
%%!if($class=="gtf")%%
<h3><a href='#'>Regulome (General Transcription Factors: %%$regulome_cnt%%)</a></h3>
In molecular biology and genetics, a transcription factor (sometimes called a sequence-specific DNA-binding factor) is a protein that binds to specific DNA sequences, thereby controlling the rate of transcription of genetic information from DNA to messenger RNA.[1][2] Transcription factors perform this function alone or with other proteins in a complex, by promoting (as an activator), or blocking (as a repressor) the recruitment of RNA polymerase (the enzyme that performs the transcription of genetic information from DNA to RNA) to specific genes.<br>
<br>
A defining feature of transcription factors is that they contain one or more DNA-binding domains (DBDs), which attach to specific sequences of DNA adjacent to the genes that they regulate.[6][7] Additional proteins such as coactivators, chromatin remodelers, histone acetylases, deacetylases, kinases, and methylases, while also playing crucial roles in gene regulation, lack DNA-binding domains, and, therefore, are not classified as transcription factors.<br>
%%!endif%%
%%!if($class=="tf")%%
<h3><a href='#'>Regulome (Specific Transcription Factors: %%$regulome_cnt%%)</a></h3>
Most eukaryotic genes are also regulated by specific transcription factors. Unlike general transcription factors, specific transcription factors control the transcription of specific target genes (not all of the genes in the genome).
Why are specific transcription factors needed? For many genes, general transcription factors alone are not enough (will not cause much transcription). Instead, the right set of specific transcription factors must also be present to put the gene in its "on" state. This means the gene is expressed only under certain conditions, which are signaled by the specific transcription factors.
A typical specific transcription factor is a DNA-binding protein that recognizes a target DNA sequence. Wherever it finds this sequence, the transcription factor will bind to the DNA. The bound transcription factor affects binding of RNA polymerase at a nearby (or sometimes, not-so-nearby!) promoter. [www.khanacademy.org]
%%!endif%%
%%!if($class=="cm")%%
<h3><a href='#'>Regulome (Chromatin Remodeler Proteins: %%$regulome_cnt%%)</a></h3>
Chromatin remodeling is the dynamic modification of chromatin architecture to allow access of condensed genomic DNA to the regulatory transcription machinery proteins, and thereby control gene expression. Such remodeling is principally carried out by 1) covalent histone modifications by specific enzymes, i.e., histone acetyltransferases (HATs), deacetylases, methyltransferases, and kinases, and 2) ATP-dependent chromatin remodeling complexes which either move, eject or restructure nucleosomes.[1] Besides actively regulating gene expression, dynamic remodeling of chromatin imparts an epigenetic regulatory role in several key biological processes, egg cells DNA replication and repair; apoptosis; chromosome segregation as well as development and pluripotency. Aberrations in chromatin remodeling proteins are found to be associated with human diseases, including cancer. Targeting chromatin remodeling pathways is currently evolving as a major therapeutic strategy in the treatment of several cancers.[Wikipedia]<br>
%%!endif%%
%%!if($class=="hm")%%
<h3><a href='#'>Regulome (Histone modifying enzymes: %%$regulome_cnt%%)</a></h3>
Histones are highly basic, nuclear proteins that provide physical means for eukaryotic DNA to be organized and packaged into chromatin. It has been shown that both the histone tails and globular domains are subjected to a diverse array of the posttranslational covalent modifications (for example, acetylation and methylation), and that such modifications are pivotal for regulating chromatin dynamics and transcriptional output of the gene/genome. Histone modifying enzymes are important in this molecular mechanism. Currently, 25 genes were classified to Histone modifying enzymes in Yeast.<br><br>
*Abbreviations: HAT (histone acetyltransferase), HMT (histone methyltransferase), HDM (histone demethylase), and HDAC (histone deacetylase).[dbHiMo]<br>
%%!endif%%
%%!if($class=="sr")%%
<h3><a href='#'>Other regulatory proteins: %%$regulome_cnt%%)</a></h3>
Nuc: Nucloesome remodeling protein
%%!endif%%
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
    <td>%%$DATA3[_sidx]->locus_name%%</td>
    <td>%%$DATA3[_sidx]->gene_name%%</td>
    <td>%%$DATA3[_sidx]->note%%</td>
</tr>
%%!endsection%%
%%!endif%%
</form>
</table>
<br><br>
<br><br>
%%FOOTER%%
</html>
