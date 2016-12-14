create database gerci;

CREATE TABLE maquinas (
  id int(11) NOT NULL AUTO_INCREMENT,
  ip varchar(15) NOT NULL,
  local varchar(30) NOT NULL,
  descricao varchar(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
