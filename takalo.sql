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
CREATE TABLE echange (
    echange_objet_id1 INTEGER not null,
    echange_objet_id2 INTEGER not null,
    echange_date_demande DATETIME not null,
    echange_date_acceptation DATETIME,
    Foreign Key (echange_objet_id1) REFERENCES objet(objet_id),
    Foreign Key (echange_objet_id2) REFERENCES objet(objet_id)
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
-- liste objet par utilisateur dans profile
SELECT objet_id,objet_description,objet_prix,objet_categorie_id,objet_utilisateur_id FROM objet,echange where objet_utilisateur_id = echange_objet_id1 or objet_utilisateur_id = echange_objet_id2  and  echange_date_acceptation is null;
SELECT * FROM echange where echange_objet_id1 in (SELECT objet_id FROM objet where objet_utilisateur_id = %d)  and  echange_date_acceptation is null;
-- liste demande a chaque objet d'un utilisateur
SELECT * FROM echange WHERE echange_objet_id1 in (SELECT objet_id FROM objet where objet_utilisateur_id = 1) and echange_objet_id2 is not null and echange_date_demande is not null and echange_date_acceptation is null;
-- insert objet and photobjet and echange 
INSERT into objet VALUES (NULL,'%s',%d,%d,%d);
INSERT photobjet VALUES(null,'%s',%d);
SELECT objet_id FROM WHERE objet_description = '%s' and objet_prix = %d and objet_categorie_id = '%s' and objet_utilisateur_id = %d;
INSERT into echange (null,%d,NULL,NULL,NULL);

-- --------------------------------------------------- requete  transaction objet entre deux utilisateurs ----------------------------------------------------------------------------------------------
-- envoye demande
UPDATE echange set echange_date_demande = now(),echange_objet_id2 = 4 WHERE echange_id = 1;
UPDATE echange set echange_date_demande = now(),echange_objet_id2 = 2 WHERE echange_id = 1;
-- refus demande 
UPDATE echange set echange_date_demande = null, echange_objet_id2 = null WHERE echange_id = %d;

-- acceptation demande 
UPDATE echange set echange_date_acceptation = now() WHERE echange_id = %d;

-- echange proprietaire


