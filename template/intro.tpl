%%HEADER%%
<body>
<h2>Eukaryotic Comparative Epigenomics Platform</h2>
<br>
<h3>ECEP - Introduction (v0.0.6)</h3>
<b>Motivation:</b><br>
Epigenome is a broad definition about entire biological and biochemical ecosystem, including the diverse interactions between the cellulcar system and the environmental system. The cellular system triggered by environmental change (such as temporature, UV treatment, pH, ion influx, and etc). In eukaryotic organisms, the molecular mechanisms are much more complicated because of the involvement of the chromatin structure. Histone modification enzymes, chromatin remodelers, and transcription factors are highly co-regulated to do a certain biological function. 'Omics' datasets are overflowing nowadays, however, there is one single platform to conduct all derired NGS analysis. The ECEP (i-sep) will facilitate the easy-to-use bioinformatics analysis using any NGS reads (RNA-seq, ChIP-seq, DNase-seq, and MNase-seq). Moreover, it will provide the comparative genomics tools to understand the human genomes based on the observation from model organisms. Yeast, Fly, Mouse are good examples. Last updated 2016-08-18.<br><br>
Not only we are interested in the human model organisms, but it is also important to investigate other biological systems. It includes plant and plant-associated organisms. The entired eukaryotic species, and their omics datasets are the topics of interest. Therefore, plant model organism such as arabidopsis, rice, and the associated micro-organisms such as plant pathogens are a part of ECEP. Plant and phytobiome can be more easily expained by interaction between host-pathogen mechanisms. Environmental factor is very important part of this interaction. Human microbiome is another big topic in the field of biology, however we are more focused on the eukaryotic gene regulation. Eventually, all living organisms are related each other. Therefore, we will include some of micro organisms as well this database. (bacteria, archea, and virus).<br><br>
<img src="/epigenome/img/epigenome_intro.png">
<br>
CRs : Chromatin Remodelers <br>
TFs : Transcription Factors <br>
HMs : Histone Modifications <br>
<br>
This platform was inspred by Yeast, Mouse and Human ENCODE projects. We will cover many publicaly available NGS datasets for their meta analysis. Guest users are allowed to upload their own experimental datasets for the further in-depth analysis. We provide the platform, and you analyze what you want. Sometimes, the analysis pileline is quite similiar with others, then you can share your workflow with others. It's a win-win! The background analyses will be conducted by Galaxy framework; which is a widely used bioinformatics workflow platform. (Galaxy's home is here at Penn State!). Finally, the analysis result will be displayed via PHP (or Django,Groovy) frameworks. (Galaxy-API to the frameworks with RESTful API). The initial version don't have any fancy graphical interface. It's a long term project. Please see how it evolve in the future.<br><br>
%%FOOTER%%
</html>
