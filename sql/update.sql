----------------------- mis à jours ------------------------

-- Ajouter une voiture
SET @matricule="91645";
SET @Marque="R4";
SET @Date_circulation=STR_TO_DATE('31-MAR-2022', '%d-%M-%Y');
SET @Kilometrage="2000";
SET @Etat="BIEN";
INSERT INTO `VEHICULES` (`NUMERO_MATRICULE`, `MARQUE`, `DATE_DE_MISE_EN_CIRCULATION`, `KILOMETRAGE`, `ETAT`) 
                VALUES (@matricule, @Marque, @Date_circulation, @Kilometrage, @Etat); 

-- Ajouter un parking
SET @parking=7;
SET @Adresse="Rue du maréchal Foch";
SET @Tarif=5;
SET @Capacite=20;
SET @Code_postal=33150;
INSERT INTO `PARKINGS` (`NUMERO_PARKING`, `ADRESSE`, `TARIF`, `CAPACITE`, `CODE_POSTAL`) 
                VALUES (@parking, @Adresse, @Tarif, @Capacite, @Code_postal); 

-- Ajouter une commune
SET @Code_postal=20000;
SET @Nom_commune="DS";
INSERT INTO `COMMUNES` (`CODE_POSTAL`, `NOM_COMMUNE`) 
                VALUES (@Code_postal, @Nom_commune); 

-- Ajouter un stationnement

SET @Id_place=5;
SET @date_stationnement=STR_TO_DATE('02-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s');
SET @num=9074;
INSERT INTO `STATIONNEMENTS` (`ID_PLACE`, `DATE_ET_HEURE_DE_STATIONNEMENT`, `NUMERO_MATRICULE`) 
                VALUES (@Id_place, @date_stationnement, @num); 

-- Ajouter une fin stationemnet

SET @date_sortie=STR_TO_DATE('02-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s');
SET @num=9074;
update `STATIONNEMENTS`
SET  `HEURE_SORTIE` = @date_sortie
WHERE `NUMERO_MATRICULE` = 9074
AND `HEURE_SORTIE` = NULL; 


-- Modifier une voiture
SET @matricule="91645";
SET @Marque="R4";
SET @Date_circulation=STR_TO_DATE('31-MAR-2022', '%d-%M-%Y');
SET @Kilometrage="4000";
SET @Etat="BIEN";

update `VEHICULES`
SET  `MARQUE` = @Marque, `DATE_DE_MISE_EN_CIRCULATION`=@Date_circulation , `KILOMETRAGE`=@Kilometrage , `ETAT`=@Etat 
WHERE `NUMERO_MATRICULE` = @matricule;

-- Modifier un parking
SET @parking=19;
SET @Adresse="Rue du maréchal Foch";
SET @Tarif=5;
SET @Capacite=20;
SET @Code_postal=33150;
update `PARKINGS`
SET `ADRESSE`=@Adresse, `TARIF`=@Tarif, `CAPACITE`=@Capacite, `CODE_POSTAL`=@Code_postal
WHERE `NUMERO_PARKING`=@parking;

-- Modifier une commune
SET @Code_postal=20000;
SET @Nom_commune="DS";

update `COMMUNES`
SET `NOM_COMMUNE`=@Nom_commune
WHERE `CODE_POSTAL`=@Code_postal;

-- Modifier un stationnement

-- Modifier une fin stationemnet



-- Supprimer une voiture
SET @matricule="91645";
DELETE from VEHICULES where  NUMERO_MATRICULE=@matricule;

-- Supprimer une parking
SET @parking=7;
DELETE from PARKINGS where  NUMERO_PARKING=@parking;

-- Supprimer une commune
SET @Code_postal=20000;
DELETE from COMMUNES where  Code_postal=@Code_postal;

-- Supprimer un stationnement
SET @date_stationnement=STR_TO_DATE('02-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s');
SET @num=9074;
DELETE FROM STATIONNEMENTS
WHERE `STATIONNEMENTS`.`DATE_ET_HEURE_DE_STATIONNEMENT` = @date_stationnement 
AND `STATIONNEMENTS`.`NUMERO_MATRICULE` = @num;

-- Supprimer une fin stationemnet
SET @date_sortie=STR_TO_DATE('02-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s');
SET @num=9074;
update `STATIONNEMENTS`
SET  `HEURE_SORTIE` = NULL
WHERE `NUMERO_MATRICULE` = 9074
AND `HEURE_SORTIE` = @date_sortie; 
