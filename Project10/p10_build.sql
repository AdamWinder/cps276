CREATE TABLE contacts
(
  ID       int       NOT NULL AUTO_INCREMENT,
  cName    char(50)  NOT NULL ,
  cAdd     char(50)  NOT NULL ,
  cCity    char(50)  NOT NULL ,
  cState   char(25)  NOT NULL ,
  cPhone   char(12)  NOT NULL ,
  cEmail   char(50)  NOT NULL ,
  cDOB     char(10)  NOT NULL ,
  cCont    char(50) ,
  cRange   char(5)   NOT NULL ,
  PRIMARY KEY(ID)
)ENGINE=InnoDB;

CREATE TABLE admins
(
  ID       int       NOT NULL AUTO_INCREMENT,
  uName    char(50)  NOT NULL ,
  uEmail   char(50)  NOT NULL ,
  Passwd   char(25)  NOT NULL ,
  uStatus  char(5)   NOT NULL ,
  PRIMARY KEY(ID)
)ENGINE=InnoDB;

INSERT INTO admins ( uName, uEmail, Passwd, uStatus ) values ( 'Administrator', 'adm1n@crimes.biz', 'b@dpassword', 'Admin' );
INSERT INTO contacts ( cName, cAdd, cCity, cState, cPhone, cEmail, cDOB, cCont, cRange ) values ( 'Falan Orbiplanax', '5563 Harald Ln.', 'Michigan', 'Arx', '248.248.2480', 'prof_planax@arx.gov', '01/01/1900', 'Newsletter', '51 +' );