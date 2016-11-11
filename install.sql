CREATE DATABASE IF NOT EXISTS `rbCustomCMS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rbCustomCMS`;

CREATE TABLE rb_users (
   id int(11) unsigned NOT NULL auto_increment,
   nickname varchar(255),
   firstname varchar(60),
   lastname varchar(30),
   password text,
   password_hash_function varchar(60) DEFAULT 'md5' NOT NULL,
   email text,
   inscription_date datetime DEFAULT '0000-00-00 00:00:00',
   lastlog datetime DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (id),
   KEY nickname (nickname),
   KEY firstname (firstname),
   KEY lastname (lastname)
);

INSERT INTO rb_users (id, nickname, firstname, lastname, password, email, inscription_date) 
VALUES ( '1', 'admin@admin.bab', 'Administrateur', 'Admin', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'admin@admin.fr', NOW());

CREATE TRIGGER autoMD5Hash
  BEFORE INSERT ON rb_users
  FOR EACH ROW
    SET NEW.password = md5(NEW.password);