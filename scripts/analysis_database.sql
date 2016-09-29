CREATE TABLE `security_check` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) DEFAULT NULL,
  `request_uri` varchar(255) DEFAULT NULL,
  `access_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `favorite_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned not null default 0,
  `object_type` int(11) unsigned not null default 0,
  `object_id` varchar(40) not null default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `object_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) not null default '',
  `note` varchar(255) not null default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
