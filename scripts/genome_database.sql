CREATE TABLE `species` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genus_name` varchar(40) DEFAULT NULL,
  `species_name` varchar(40) DEFAULT NULL,
  `strain_name` varchar(40) DEFAULT NULL,
  `ncbi_txid` varchar(40) DEFAULT NULL,
  `lineage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

CREATE TABLE `genome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `species_id` int(11) unsigned not null default 0,
  `assembly_id` varchar(40) DEFAULT NULL,
  `db_key` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

CREATE TABLE `proteome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `locus_name` varchar(40) DEFAULT NULL,
  `gene_name` varchar(40) DEFAULT NULL,
  `genome_id` int(11) unsigned not null default 0,
  `sequence_id` int(11) unsigned not null default 0,
  `species_complex` varchar(255) DEFAULT NULL,
  `interpro_term` varchar(255) DEFAULT NULL,
  `go_term` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

CREATE TABLE `chromosome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genome_id` int(11) unsigned not null default 0,
  `loc` varchar(40) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `ncbi_accession` varchar(40) DEFAULT NULL,
  `genome_size` varchar(40) DEFAULT NULL,
  `gc_content` varchar(40) DEFAULT NULL,
  `protein` int(11) unsigned not null default 0,
  `rRNA` int(11) unsigned not null default 0,
  `tRNA` int(11) unsigned not null default 0,
  `otherRNA` int(11) unsigned not null default 0,
  `gene` int(11) unsigned not null default 0,
  `pseudogene` int(11) unsigned not null default 0,
  `file_path` varchar(255) DEFAULT NULL,
  `seq` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

CREATE TABLE `sequence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seq_type` varchar(40) DEFAULT NULL,
  `ncbi_accession` varchar(40) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `seq` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  
