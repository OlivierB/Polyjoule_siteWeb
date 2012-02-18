# script créé le : Tue Nov 17 14:08 2011 par Alexandre BISIAUX
USE Polyjoule;

DROP TABLE IF EXISTS EQUIPE ;
CREATE TABLE EQUIPE (
	id_equipe INT AUTO_INCREMENT NOT NULL,
	annee_equipe INT(4),
	PRIMARY KEY (id_equipe)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS PARTICIPANT ;
CREATE TABLE PARTICIPANT (
	id_participant INT AUTO_INCREMENT NOT NULL,
	id_equipe INT NOT NULL,
	nom_participant VARCHAR(30),
	prenom_participant VARCHAR(30),
	photo_participant VARCHAR(100),
	mail_participant VARCHAR(100),
	role_participant VARCHAR(100),
	bioFR_participant TEXT,
	bioEN_participant TEXT,
	PRIMARY KEY (id_participant) 
) ENGINE=InnoDB;

DROP TABLE IF EXISTS COURSE ;
CREATE TABLE COURSE (
	id_course INT AUTO_INCREMENT NOT NULL,
	id_equipe INT NOT NULL,
	date_course DATE,
	lieu_course VARCHAR(30),
	img_course VARCHAR(100),
	descFR_course TEXT,
	descEN_course TEXT,
	PRIMARY KEY (id_course)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS PARTENAIRE ;
CREATE TABLE PARTENAIRE (
	id_partenaire INT AUTO_INCREMENT NOT NULL,
	nom_partenaire VARCHAR(30),
	logo_partenaire VARCHAR(100),
	site_partenaire VARCHAR(100),
	descFR_partenaire TEXT,
	descEN_partenaire TEXT,
	PRIMARY KEY (id_partenaire)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS RESULTAT ;
CREATE TABLE RESULTAT (
	id_resultat INT AUTO_INCREMENT NOT NULL,
	position_resultat INT,
	record_resultat TEXT,
	PRIMARY KEY (id_resultat)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS ECOLE ;
CREATE TABLE ECOLE (
	id_ecole INT AUTO_INCREMENT NOT NULL,
	nom_ecole VARCHAR(30),
	adresse_ecole VARCHAR(100),
	photo_ecole VARCHAR(100),
	descFR_ecole TEXT,
	descEN_ecole TEXT,
	PRIMARY KEY (id_ecole)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS FORMATION ;
CREATE TABLE FORMATION (
	id_formation INT AUTO_INCREMENT NOT NULL,
	id_ecole INT NOT NULL,
	titreFR_formation VARCHAR(100),
	titreEN_formation VARCHAR(100),
	lien_formation VARCHAR(100),
	descFR_formation TEXT,
	descEN_formation TEXT,
	PRIMARY KEY (id_formation)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS LIVRE_OR ;
CREATE TABLE LIVRE_OR (
	id_post INT AUTO_INCREMENT NOT NULL,
	posteur_post VARCHAR(30),
	mail_post VARCHAR(100),
	date_post DATETIME,
	message_post TEXT,
	PRIMARY KEY (id_post)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS ALBUM ;
CREATE TABLE ALBUM (
	id_album INT AUTO_INCREMENT NOT NULL,
	nom_album VARCHAR(30),
	date_album DATE,
	PRIMARY KEY (id_album)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS PHOTO ;
CREATE TABLE PHOTO (
	id_photo INT AUTO_INCREMENT NOT NULL,
	id_album INT,
	titreFR_photo VARCHAR(50),
	titreEN_photo VARCHAR(50),
	lien_photo VARCHAR(100),
	date_photo DATE,
	PRIMARY KEY (id_photo)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS ARTICLE ;
CREATE TABLE ARTICLE (
	id_article INT AUTO_INCREMENT NOT NULL,
	id_rubrique INT,
	titreFR_article TEXT,
	titreEN_article TEXT,
	contenuFR_article TEXT,
	contenuEN_article TEXT,
	auteur_article VARCHAR(50),
	statut_article BOOL,
	autorisation_com BOOL,
	date_article INT,
	PRIMARY KEY (id_article)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS RUBRIQUE ;
CREATE TABLE RUBRIQUE (
	id_rubrique INT AUTO_INCREMENT NOT NULL,
	id_mere INT DEFAULT NULL, /* Une rubrique principale a null comme id_mere alors qu'une sous rubrique possede l'id de la rubrique mere ce qui crée une arborescence*/
	titreFR_rubrique VARCHAR(100),
	titreEN_rubrique VARCHAR(100),
	descFR_rubrique TEXT,
	descEN_rubrique TEXT,
	PRIMARY KEY (id_rubrique)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS COMMENTAIRE ;
CREATE TABLE COMMENTAIRE (
	id_commentaire INT AUTO_INCREMENT NOT NULL,
	id_article INT NOT NULL,
	date_commentaire DATETIME,
	posteur_commentaire VARCHAR(30),
	mail_commentaire VARCHAR(50),
	message_commentaire TEXT,
	PRIMARY KEY (id_commentaire)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS SPONSORISE ;
CREATE TABLE SPONSORISE (
	id_equipe INT NOT NULL,
	id_partenaire INT NOT NULL,
	PRIMARY KEY (id_equipe, id_partenaire)
 ) ENGINE=InnoDB;

DROP TABLE IF EXISTS OBTIENT ;
CREATE TABLE OBTIENT (
	id_equipe INT NOT NULL,
	id_course INT NOT NULL,
	id_resultat INT NOT NULL,
	PRIMARY KEY (id_equipe, id_course, id_resultat)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS AFFICHE ;
CREATE TABLE AFFICHE (
	id_photo INT NOT NULL,
	id_article INT NOT NULL,
	PRIMARY KEY (id_photo, id_article)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS APPARTIENT ;
CREATE TABLE APPARTIENT (
	id_participant INT NOT NULL,
	id_formation INT NOT NULL,
	PRIMARY KEY (id_participant, id_formation)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS COMPOSE ;
CREATE TABLE COMPOSE (
	id_participant INT NOT NULL,
	id_equipe INT NOT NULL,
	PRIMARY KEY (id_participant, id_equipe)
) ENGINE=InnoDB;

/* Pour les comptes administrateurs */
DROP TABLE IF EXISTS MEMBRE ;
CREATE TABLE MEMBRE (
	id_membre INT AUTO_INCREMENT NOT NULL,
	pseudo_membre VARCHAR(30),
	mdp_membre varchar(150),
	mail_membre varchar(100),
	statut_membre varchar(30) CHECK( statut_membre IN ('admin','user')),
	photo_membre varchar(150),
	PRIMARY KEY(id_membre,pseudo_membre) /* PSEUDO différent pour chaque membre*/
);
/*-----------------------------------------*/

ALTER TABLE PARTICIPANT ADD CONSTRAINT FK_PARTICIPANT_id_equipe FOREIGN KEY (id_equipe) REFERENCES EQUIPE (id_equipe) ON DELETE CASCADE; 

ALTER TABLE COURSE ADD CONSTRAINT FK_COURSE_id_equipe FOREIGN KEY (id_equipe) REFERENCES EQUIPE (id_equipe);

ALTER TABLE FORMATION ADD CONSTRAINT FK_FORMATION_id_ecole FOREIGN KEY (id_ecole) REFERENCES ECOLE (id_ecole);

ALTER TABLE PHOTO ADD CONSTRAINT FK_PHOTO_id_album FOREIGN KEY (id_album) REFERENCES ALBUM (id_album) ON DELETE SET NULL;

ALTER TABLE ARTICLE ADD CONSTRAINT FK_ARTICLE_id_rubrique FOREIGN KEY (id_rubrique) REFERENCES RUBRIQUE (id_rubrique) ON DELETE SET NULL;

ALTER TABLE COMMENTAIRE ADD CONSTRAINT FK_COMMENTAIRE_id_article FOREIGN KEY (id_article) REFERENCES ARTICLE (id_article);

ALTER TABLE COMPOSE ADD CONSTRAINT FK_COMPOSE_id_participant FOREIGN KEY (id_participant) REFERENCES PARTICIPANT (id_participant);
ALTER TABLE COMPOSE ADD CONSTRAINT FK_COMPOSE_id_equipe FOREIGN KEY (id_equipe) REFERENCES EQUIPE (id_equipe);

ALTER TABLE SPONSORISE ADD CONSTRAINT FK_SPONSORISE_id_equipe FOREIGN KEY (id_equipe) REFERENCES EQUIPE (id_equipe);
ALTER TABLE SPONSORISE ADD CONSTRAINT FK_SPONSORISE_id_partenaire FOREIGN KEY (id_partenaire) REFERENCES PARTENAIRE (id_partenaire);

ALTER TABLE OBTIENT ADD CONSTRAINT FK_OBTIENT_id_equipe FOREIGN KEY (id_equipe) REFERENCES EQUIPE (id_equipe);
ALTER TABLE OBTIENT ADD CONSTRAINT FK_OBTIENT_id_course FOREIGN KEY (id_course) REFERENCES COURSE (id_course);
ALTER TABLE OBTIENT ADD CONSTRAINT FK_OBTIENT_id_resultat FOREIGN KEY (id_resultat) REFERENCES RESULTAT (id_resultat);

ALTER TABLE AFFICHE ADD CONSTRAINT FK_AFFICHE_id_photo FOREIGN KEY (id_photo) REFERENCES PHOTO (id_photo);
ALTER TABLE AFFICHE ADD CONSTRAINT FK_AFFICHE_id_article FOREIGN KEY (id_article) REFERENCES ARTICLE (id_article);


ALTER TABLE APPARTIENT ADD CONSTRAINT FK_APPARTIENT_id_participant FOREIGN KEY (id_participant) REFERENCES PARTICIPANT (id_participant);
ALTER TABLE APPARTIENT ADD CONSTRAINT FK_APPARTIENT_id_formation FOREIGN KEY (id_formation) REFERENCES FORMATION (id_formation);

/*INSERTION DU COMPTE admin POUR LES TESTS */
INSERT INTO MEMBRE VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@admin','admin','ressources/data/Membres/defaut.png');
