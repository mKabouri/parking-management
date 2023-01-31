---- Informations sur les parkings, les voitures, les places.

select * 
from PARKINGS;

select *
from VEHICULES;

select *
from PLACES;

---- Liste des voitures par parking, la liste des parkings par commune.

SELECT DISTINCT VEHICULES.* FROM VEHICULES
	 			  NATURAL JOIN STATIONNEMENTS
	 			  NATURAL JOIN PLACES
	 			  WHERE PLACES.NUMERO_PARKING=@NUMERO_PARKING; 

SELECT *
from PARKINGS 
where PARKINGS.CODE_POSTAL =@CODE_POSTAL;

---- Liste des parkings qui sont saturés à un jour donnée
---- on a supposé que la requete a pour but de retourner les parkings dont tout les places été occupé pendant une de 24 heures.

select PARKINGS.*
from PARKINGS
where CAPACITE = (select distinct count(*) 
                  from STATIONNEMENTS inner join PLACES 
                       on STATIONNEMENTS.ID_PLACE = PLACES.ID_PLACE
                       where PARKINGS.NUMERO_PARKING = NUMERO_PARKING 
                       and DATE_ET_HEURE_DE_STATIONNEMENT < @jour 
                       and HEURE_SORTIE > @jour+interval 24 HOUR);

---- Liste des places disponibles, par parking, à un moment donné

select PL.NUMERO_AFFICHE, PL.ID_PLACE from
( select PLACES.* 
from PLACES
except
select PLACES.*
from PLACES natural join STATIONNEMENTS ) as PL
where NUMERO_PARKING=@numero_parking;

-- --- Liste de voitures qui se sont garées dans deux parkings différents au cours d'une journée

select VEHICULES.NUMERO_MATRICULE
from VEHICULES inner join

      ( select PLACES.NUMERO_PARKING, VEHICULES.NUMERO_MATRICULE, count(NUMERO_MATRICULE) as COUNT
	from (VEHICULES natural join STATIONNEMENTS)
	natural join PLACES
	where convert(STATIONNEMENTS.DATE_ET_HEURE_DE_STATIONNEMENT, DATE) = convert(STATIONNEMENTS.HEURE_SORTIE, DATE)
      group by PLACES.NUMERO_PARKING, VEHICULES.NUMERO_MATRICULE ) T 

on T.NUMERO_MATRICULE = VEHICULES.NUMERO_MATRICULE
where COUNT >= 2;  


--------------- Reqûetes de statistiques ---------------

---- Moyenne du nombre de places disponibles par parking

select avg(S.NB_PLACES_DISPO) as MOYENNE_PLACE_DISPONIBLE
from (
select L.NUMERO_PARKING, count(L.ID_PLACE) as NB_PLACES_DISPO
from (
      select PLACES.*
      from PLACES
      except
      select PLACES.*
      from PLACES natural join STATIONNEMENTS
      where DATE_ET_HEURE_DE_STATIONNEMENT <= @moment
            and HEURE_SORTIE >= @moment) L
group by L.NUMERO_PARKING) S;

---- La durée moyenne de stationnement d'un véhicule par parking(EN h)

select NUMERO_PARKING,avg(moyenne) as moyenne_en_heure 
from (select NUMERO_PARKING, TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE) as moyenne 
from PARKINGS natural join PLACES natural join STATIONNEMENTS) as L
group by NUMERO_PARKING;

---- Classement des parkings les moins utilisés

select NUMERO_PARKING, avg(TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE)) as moyenne
from PARKINGS natural join PLACES natural join STATIONNEMENTS
group by NUMERO_PARKING
order by NUMERO_PARKING ASC;

---- Le cout moyen du stationnement d'un véhicule par mois

select avg(m) from (select NUMERO_PARKING, TARIF * avg(TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE)) as m
from PARKINGS natural join PLACES natural join STATIONNEMENTS
where year(DATE_ET_HEURE_DE_STATIONNEMENT) == year(@mois) and (MONTH(DATE_ET_HEURE_DE_STATIONNEMENT)= month(@mois) or  MONTH(HEURE_SORTIE) = month(@mois))
group by NUMERO_PARKING) as TAB;

---- classement des parking les plus rentables par commune et par mois,
select NUMERO_PARKING ,TARIF*sum(TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE)) as GAIN
from COMMUNES natural join PARKINGS natural join PLACES natural join STATIONNEMENTS
where (year(DATE_ET_HEURE_DE_STATIONNEMENT) = year(@mois)) and (MONTH(DATE_ET_HEURE_DE_STATIONNEMENT)= @mois or  MONTH(HEURE_SORTIE) = @mois) and CODE_POSTAL=@code
group by NUMERO_PARKING;


---- classement des communes les plus demandés par semaine
 select NOM_COMMUNE from (select NOM_COMMUNE,sum(TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE)) as duree
                        from  COMMUNES natural join PARKINGS natural join PLACES natural join STATIONNEMENTS
                        where DATE_ET_HEURE_DE_STATIONNEMENT >= @jour and HEURE_SORTIE <=  DATE_ADD(@jour ,interval 7 DAY) 
                        group by NOM_COMMUNE
                        order by duree DESC )as demande;



---- Bonus:

---- Classement des véhicules qui ont le plus payé.

select SR.NUMERO_MATRICULE, SUM(SR.TARIF_VEHICULE) as TOTAL_PAYE
from (select S.NUMERO_MATRICULE, 
             PA.TARIF*TIMESTAMPDIFF(HOUR, S.DATE_ET_HEURE_DE_STATIONNEMENT, S.HEURE_SORTIE) as TARIF_VEHICULE,
             S.DATE_ET_HEURE_DE_STATIONNEMENT
      from (STATIONNEMENTS S inner join PLACES PL 
            on S.ID_PLACE = PL.ID_PLACE)
                             inner join PARKINGS PA
            on PA.NUMERO_PARKING = PL.NUMERO_PARKING
      group by S.DATE_ET_HEURE_DE_STATIONNEMENT, S.NUMERO_MATRICULE
) SR
group by SR.NUMERO_MATRICULE
order by TOTAL_PAYE desc;

