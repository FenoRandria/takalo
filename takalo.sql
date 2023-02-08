create DATABASE takalo;
use takalo;
CREATE TABLE utilisateur (
    utilisateur_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    utilisateur_name VARCHAR(150),
    utilisateur_mail VARCHAR(150) not null,
    utilisateur_pwd VARCHAR(60) not null
);
CREATE TABLE photodeprofil (
    pdp_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    pdp_photo VARCHAR(150),
    pdp_utilisateur_id INTEGER not null,
    Foreign Key (pdp_utilisateur_id) REFERENCES utilisateur(utilisateur_id)
);
CREATE TABLE categorie (
    categorie_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    categorie_name VARCHAR(150)
);
alter table categorie add corbeil integer default 0;
CREATE TABLE objet (
    objet_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    objet_description TEXT,
    objet_prix DOUBLE,
    objet_categorie_id INTEGER not NULL,
    objet_utilisateur_id INTEGER not null,
    Foreign Key (objet_utilisateur_id) REFERENCES utilisateur(utilisateur_id),
    Foreign Key (objet_categorie_id) REFERENCES categorie(categorie_id)
);
CREATE TABLE photobjet (
    photobjet_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    photobjet_photo VARCHAR(150),
    photobjet_objet_id INTEGER not null,
    Foreign Key (photobjet_objet_id) REFERENCES objet(objet_id)
);
CREATE TABLE publication (
    pub_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    pub_objet_id1 INTEGER,
    pub_objet_id2 INTEGER,
    pub_date_demande DATETIME,
    pub_date_acceptation DATETIME,
    Foreign Key (pub_objet_id1) REFERENCES objet(objet_id),
    Foreign Key (pub_objet_id2) REFERENCES objet(objet_id)
);
-- --------------------------------------------------- requete pour l'utilisateur ----------------------------------------------------------------------------------------------
-- login
SELECT * from utilisateur where utilisateur_mail = '' and utilisateur_pwd = '';
-- sign up
insert INTO utilisateur VALUES (null,'%s','%s','%s');
insert INTO photodeprofil VALUES(null,'%s',%d);

-- --------------------------------------------------- requete pour l'objet ----------------------------------------------------------------------------------------------
-- detail objet
SELECT * FROM objet WHERE objet_id = %d;
-- liste objet par utilisateur
SELECT * FROM publication where pub_objet_id1 = %d and  pub_date_acceptation is null;
-- liste demande a chaque objet d'un utilisateur
SELECT * FROM publication WHERE pub_objet_id1 = %d and pub_objet_id2 is not null and pub_date_acceptation is null;
-- insert objet and photobjet and publication 
INSERT into objet VALUES (NULL,'%s',%d,%d,%d);
INSERT photobjet VALUES(null,'%s',%d);
SELECT objet_id FROM WHERE objet_description = '%s' and objet_prix = %d and objet_categorie_id = '%s' and objet_utilisateur_id = %d;
INSERT into publication (null,%d,NULL,NULL,NULL);

-- --------------------------------------------------- requete  transaction objet entre deux utilisateurs ----------------------------------------------------------------------------------------------
-- envoye demande
UPDATE publication set pub_date_demande = now(),pub_objet_id2 = %d WHERE pub_id = %d;
-- refus demande 
UPDATE publication set pub_date_demande = null, pub_objet_id2 = null WHERE pub_id = %d;

-- acceptation demande 
UPDATE publication set pub_date_acceptation = now() WHERE pub_id = %d;

-- echange proprietaire


