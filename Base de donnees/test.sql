/* Test de la mise à null de l'attribut id_rubrique des articles appartenant à la rubrique suprimée */

INSERT INTO RUBRIQUE VALUES (NULL,NULL,"TEST","TEST");
INSERT INTO ARTICLE VALUES(NULL,1,"Article test","Test article","blabla en fr","bla bla en en",TRUE);
DELETE FROM RUBRIQUE WHERE id_rubrique=1;

/* Test de la suppression en cascade des participants d'une équipe lors de la suppression de cette equipe */

INSERT INTO EQUIPE VALUES (NULL,2011);
INSERT INTO PARTICIPANT VALUES (NULL,1,"NACHOUKI","Marie Pierre","tof","mail","ne sert à rien","adore le café","love coffee");
DELETE FROM EQUIPE WHERE id_equipe=1;