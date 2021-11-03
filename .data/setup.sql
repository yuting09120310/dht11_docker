CREATE DATABASE arduino;
GRANT CREATE, ALTER, INDEX, LOCK TABLES, REFERENCES, UPDATE, DELETE, DROP, SELECT, INSERT ON `arduino`.* TO 'sa'@'%';

use arduino

CREATE TABLE  node (
  ID INT NOT NULL AUTO_INCREMENT,
  location VARCHAR(50),
  temperature double(3,1),
  humidity double(3,1),
  time datetime,
  PRIMARY KEY (ID)  
);

FLUSH PRIVILEGES;