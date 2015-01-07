CREATE TABLE `journalist` (
`id`  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(50) NOT NULL ,
`jouna_code`  varchar(50) NOT NULL ,
`image`  varchar(255) NOT NULL ,
`id_number`  varchar(20) NOT NULL ,
`company`  varchar(255) NULL DEFAULT NULL ,
`content`  text NULL ,
PRIMARY KEY (`id`)
)
;