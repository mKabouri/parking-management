
drop table if exists `STATIONNEMENTS`;


drop table if exists `PLACES`;


drop table if exists `PARKINGS`;


drop table if exists `VEHICULES`;


drop table if exists `DATES`;


drop table if exists `COMMUNES`;


-- ============================================================
--   Nom de la base   :  PARKING                                
--   Nom de SGBD      :  ORACLE Version 7.0                    
--   Date de creation :  01/11/22  14:15                       
-- ============================================================

-- ============================================================
--   Table : VEHICULES                                            
-- ============================================================

create table VEHICULES
(
    NUMERO_MATRICULE                INT         not null,
    MARQUE                          CHAR(20)    not null,
    DATE_DE_MISE_EN_CIRCULATION     DATE                ,
    KILOMETRAGE                     FLOAT(6)            ,
    ETAT               				CHAR(20)            ,
    primary key(NUMERO_MATRICULE)
);

-- SHOW COUNT(*) WARNINGS;
-- \&warning_count;

-- =======================================================
--   Table : COMMUNES
-- =======================================================

create table COMMUNES
(
	CODE_POSTAL	    INT	        not null,
	NOM_COMMUNE	    CHAR(20)	not null,
	primary key(CODE_POSTAL)
);

-- =======================================================
--   Table : PARKINGS
-- =======================================================

create table PARKINGS
(
	NUMERO_PARKING 	INT	        not null,
	ADRESSE		    CHAR(30)	not null,
	TARIF		    DEC 	    not null,
	CAPACITE	    INT	        not null,
	CODE_POSTAL	    INT	        not null,
	primary key(NUMERO_PARKING)
);

-- =======================================================
--   Table : PLACES
-- =======================================================

create table PLACES
(
    ID_PLACE                   INT         not null,
    NUMERO_AFFICHE             INT         not null,
    NUMERO_PARKING             INT         not null, 
    primary key (ID_PLACE)
);

-- =======================================================
--   Table : STATIONNEMENTS
-- =======================================================

create table STATIONNEMENTS
(
    ID_PLACE                  	    INT          not null,
    DATE_ET_HEURE_DE_STATIONNEMENT  DATETIME     not null,
    NUMERO_MATRICULE                INT          not null,
    HEURE_SORTIE		            DATETIME             ,
    primary key(DATE_ET_HEURE_DE_STATIONNEMENT, NUMERO_MATRICULE)
);

-- =======================================================
--   Adding foreign keys
-- =======================================================

alter table STATIONNEMENTS
    add constraint fk1_stationnements foreign key (ID_PLACE)
    references PLACES (ID_PLACE)
    on DELETE SET DEFAULT;

alter table STATIONNEMENTS
    add constraint fk3_stationnements foreign key (NUMERO_MATRICULE)
    references VEHICULES (NUMERO_MATRICULE)
    on DELETE SET DEFAULT;

alter table PLACES
      add constraint fk1_places foreign key (NUMERO_PARKING)
      	  references PARKINGS (NUMERO_PARKING)
        on DELETE CASCADE;

alter table PARKINGS
      add constraint fk1_parkings foreign key (CODE_POSTAL)
      	references COMMUNES (CODE_POSTAL)
        on DELETE CASCADE;

commit;
