## Tecnologia: MYSQL
## Base de dados : vendatsic

CREATE SCHEMA `vendatsic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

use vendatsic;

Create Table produto (
	id_produto integer(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    ds_codigo_produto varchar(255),
	ds_produto varchar(255),
	vl_produto float DEFAULT NULL,
    UNIQUE KEY UX_DS_CODIGO_PRODUTO (ds_codigo_produto),
	Primary Key(id_produto)
);

## TO-DO Verificar se o numero é necessario / não ID
## TO-DO manter tinyint ou boolean?
Create Table documento (
	id_documento integer(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	vl_total_documento float DEFAULT NULL,
	sn_documento_confirmado tinyint(1) DEFAULT 0, 
    sn_documento_cancelado tinyint(1) DEFAULT 0, 
	Primary Key(id_documento)
);

Create Table documento_produto (
	id_produto integer(11) UNSIGNED not null,
	id_documento integer(11) UNSIGNED not null,
	Foreign Key(id_produto) references produto (id_produto),
	Foreign Key(id_documento) references documento (id_documento)
);