CREATE TABLE files
(
  fNo      int       NOT NULL AUTO_INCREMENT,
  fName    char(30)  NOT NULL ,
  fPath    char(50)  NOT NULL ,
  PRIMARY KEY(fNo)
) ENGINE=InnoDB;