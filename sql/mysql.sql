create database gerci;

CREATE TABLE maquinas (
  id int(11) NOT NULL AUTO_INCREMENT,
  ip varchar(15) NOT NULL,
  local varchar(30) NOT NULL,
  descricao varchar(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `maquinas` (`id`, `ip`, `local`, `descricao`) VALUES (NULL, '172.16.105.11', 'LAB3', 'PC11');



insert into maquinas(ip,local,description)  values ('172.16.103.2','LAB3','Maquina 1');
insert into maquinas(ip,local,description)  values ('172.16.103.3','LAB3','Maquina 2');
insert into maquinas(ip,local,description)  values ('172.16.103.4','LAB3','Maquina 3');
