/**
  * date de mise en circulation inférieur à la date d'entrée au parking.
  */
delimiter |
create trigger if not exists BEFORE_STATIONNEMENTS_INSERT_1
before insert on STATIONNEMENTS
for each row 
begin
    declare date_circulation DATETIME;
    select VEHICULES.DATE_DE_MISE_EN_CIRCULATION into date_circulation
    from VEHICULES
    where VEHICULES.NUMERO_MATRICULE = new.NUMERO_MATRICULE;
    if new.DATE_ET_HEURE_DE_STATIONNEMENT < date_circulation
    then
        SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Date de mise en circulation ne doit pas être supérieur à la date entrée';
    end if;
end;
|

/**
  * Date de sortie doit être supérieur à la date d'entrée au parking.
  * et
  */
create trigger if not exists BEFORE_STATIONNEMENTS_INSERT_2
before insert on STATIONNEMENTS
for each row 
begin
    if new.DATE_ET_HEURE_DE_STATIONNEMENT > new.HEURE_SORTIE
    then
        SIGNAL SQLSTATE '50002' SET MESSAGE_TEXT = 'Heure entrée ne peut être supérieur à heure de sortie';
    end if; 
end;
|

/**
  * On ne peut pas garer une voiture qui est encore garer.
  */
create trigger if not exists BEFORE_STATIONNEMENTS_INSERT_3
before insert on STATIONNEMENTS
for each row
begin
    declare date_stationnement DATETIME;
    select STATIONNEMENTS.DATE_ET_HEURE_DE_STATIONNEMENT into date_stationnement
    from STATIONNEMENTS
    where STATIONNEMENTS.NUMERO_MATRICULE = new.NUMERO_MATRICULE;
    
    declare date_sortie DATETIME;
    select STATIONNEMENTS.HEURE_SORTIE into date_sortie
    from STATIONNEMENTS
    where STATIONNEMENTS.NUMERO_MATRICULE = new.NUMERO_MATRICULE;

    if date_stationnement < new.DATE_ET_HEURE_DE_STATIONNEMENT and date_sortie > new.DATE_ET_HEURE_DE_STATIONNEMENT
    then
        SIGNAL SQLSTATE '50003' SET MESSAGE_TEXT = 'Voiture déjà garer dans un autre parking dans cette date de stationnement';
    end if;
end;
|

delimiter ;

commit;
