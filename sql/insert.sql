-- ============================================================
--    suppression des donnees
-- ============================================================

delete from STATIONNEMENTS;
delete from PLACES ;
delete from PARKINGS;
delete from VEHICULES ;
delete from COMMUNES;

commit ;

-- ============================================================
--    creation des donnees
-- ============================================================

-- VEHICULES

insert into VEHICULES  values(1     , 'LEXUS LFA'      , STR_TO_DATE('31-MAR-2021', '%d-%M-%Y'), 30    , 'EXCELENT');
insert into VEHICULES  values(123466, 'RENAULT EXPRESS', STR_TO_DATE('02-MAY-1997', '%d-%M-%Y'), 300000, 'MOYEN'   );
insert into VEHICULES  values(123066, 'TESLA'          , STR_TO_DATE('31-DEC-2019', '%d-%M-%Y'), 100000, 'BIEN'    );
insert into VEHICULES  values(123766, 'RENAULT CLIO'   , STR_TO_DATE('09-JAN-2020', '%d-%M-%Y'), 120000, 'MOYEN'   );
insert into VEHICULES  values(123966, 'FERRARI GTB'    , STR_TO_DATE('31-JAN-2021', '%d-%M-%Y'), 30000 , 'EXCELENT');
insert into VEHICULES  values(123166, 'ROLLSROYCE'     , STR_TO_DATE('22-SEP-2021', '%d-%M-%Y'), 30000 , 'EXCELENT');
insert into VEHICULES  values(987654, 'ROLLSROYCE'     , STR_TO_DATE('16-JUN-2021', '%d-%M-%Y'), 30000 , 'EXCELENT');
insert into VEHICULES  values(176221, 'DACIA LOGAN'    , STR_TO_DATE('22-SEP-2020', '%d-%M-%Y'), 305100, 'MOYEN'   );
insert into VEHICULES  values(338211, 'AUDI A5'        , STR_TO_DATE('29-JUN-2016', '%d-%M-%Y'), 40500 , 'BIEN'    );
insert into VEHICULES  values(321098, 'Ford Maverick'  , STR_TO_DATE('05-JUN-2021', '%d-%M-%Y'), 4000  , 'EXCELENT');
insert into VEHICULES  values(338511, 'Ford Mustang'   , STR_TO_DATE('05-MAR-2019', '%d-%M-%Y'), 51500 , 'BIEN'    );
insert into VEHICULES  values(369000, 'Porsche Cayenne', STR_TO_DATE('28-OCT-2018', '%d-%M-%Y'), 56500 , 'BIEN'    );
insert into VEHICULES  values(538200, 'DACIA LOGAN    ', STR_TO_DATE('25-JAN-2009', '%d-%M-%Y'), 500   , 'BIEN'    );
insert into VEHICULES  values(100000, 'Ford Fiesta    ', STR_TO_DATE('18-SEP-2017', '%d-%M-%Y'), 50000 , 'BIEN'    );
insert into VEHICULES  values(200011, 'DACIA DUSTER   ', STR_TO_DATE('16-JUN-2015', '%d-%M-%Y'), 20000 , 'MOYEN'   );
insert into VEHICULES  values(500040, 'AUDI A4        ', STR_TO_DATE('08-JUL-2018', '%d-%M-%Y'), 11500 , 'MOYEN'   );
insert into VEHICULES  values(500200, 'PEUGEAUT 307   ', STR_TO_DATE('09-SEP-2012', '%d-%M-%Y'), 100000, 'BIEN'    );
insert into VEHICULES  values(835800, 'CITROEN C4     ', STR_TO_DATE('11-AUG-2019', '%d-%M-%Y'), 98700 , 'BIEN'    );

commit;

-- COMMUNES

insert into COMMUNES values ( 33000, 'Bordeaux');
insert into COMMUNES values ( 33600, 'Pessac');
insert into COMMUNES values ( 33400, 'Talence');
insert into COMMUNES values ( 33700, 'Mérignac');
insert into COMMUNES values ( 33170, 'Gradignan');
insert into COMMUNES values ( 33110, 'Bouscat');
insert into COMMUNES values ( 33130, 'Bègles');
insert into COMMUNES values ( 33150, 'Cenon');
insert into COMMUNES values ( 33270, 'Floirac');


commit; 

-- PARKINGS

insert into PARKINGS values (1, 'Unitec Pessac'          , 1  , 9  , 33600);
insert into PARKINGS values (2, 'Victoire Bordeaux'      , 2.5, 50 , 33000);
insert into PARKINGS values (3, 'Arts et métiers Talence', 1  , 60 , 33400);
insert into PARKINGS values (4, 'Aéroport Mérignac'      , 1  , 100, 33700);
insert into PARKINGS values (5, 'Gare de Pessac Alouette', 4  , 25 , 33600);
insert into PARKINGS values (6, 'Arts et Métiers'        , 2  , 100, 33400);

commit;

-- PLACES

-- Places Parking 1: "Unitec"
insert into PLACES values (1, 1, 1);
insert into PLACES values (2, 2, 1);
insert into PLACES values (3, 3, 1);
insert into PLACES values (4, 4, 1);
insert into PLACES values (5, 5, 1);
insert into PLACES values (6, 6, 1);
insert into PLACES values (7, 7, 1);
insert into PLACES values (8, 8, 1);
insert into PLACES values (9, 9, 1);

-- Places Parking 2: "Victoire"
insert into PLACES values (10, 1, 2);
insert into PLACES values (11, 2, 2);
insert into PLACES values (12, 3, 2);
insert into PLACES values (13, 4, 2);
insert into PLACES values (14, 5, 2);
insert into PLACES values (15, 6, 2);

-- Places Parking 3: "Arts et métiers"
insert into PLACES values (16, 1, 3);
insert into PLACES values (17, 2, 3);
insert into PLACES values (18, 3, 3);
insert into PLACES values (19, 4, 3);
insert into PLACES values (20, 5, 3);
insert into PLACES values (21, 6, 3);
insert into PLACES values (22, 7, 3);
insert into PLACES values (23, 8, 3);
insert into PLACES values (24, 9, 3);
insert into PLACES values (25, 10, 3);
insert into PLACES values (26, 11, 3);
insert into PLACES values (27, 12, 3);
insert into PLACES values (28, 13, 3);
insert into PLACES values (29, 14, 3);
insert into PLACES values (30, 15, 3);

-- Places parking 4: "Aéroport"
insert into PLACES values (31, 1, 4);
insert into PLACES values (32, 2, 4);
insert into PLACES values (33, 3, 4);
insert into PLACES values (34, 4, 4);
insert into PLACES values (35, 5, 4);
insert into PLACES values (36, 6, 4);
insert into PLACES values (37, 7, 4);
insert into PLACES values (38, 8, 4);

-- Places parking 5: "Gare de Pessac Alouette"
insert into PLACES values (39, 1, 5);
insert into PLACES values (40, 2, 5);
insert into PLACES values (41, 3, 5);
insert into PLACES values (42, 4, 5);
insert into PLACES values (43, 5, 5);
insert into PLACES values (44, 6, 5);
insert into PLACES values (45, 7, 5);
insert into PLACES values (46, 8, 5);
insert into PLACES values (47, 9, 5);
insert into PLACES values (48, 10, 5);
insert into PLACES values (49, 11, 5);
insert into PLACES values (50, 12, 5);
insert into PLACES values (51, 13, 5);

-- Places parking 6: "Arts et Métiers"
insert into PLACES values (52, 1, 6);
insert into PLACES values (53, 2, 6);
insert into PLACES values (54, 3, 6);
insert into PLACES values (55, 4, 6);
insert into PLACES values (56, 5, 6);
insert into PLACES values (57, 6, 6);
insert into PLACES values (58, 7, 6);
insert into PLACES values (59, 8, 6);


commit ;

-- STATIONNEMENTS

insert into STATIONNEMENTS values (1 , STR_TO_DATE('02-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s'), 123466, STR_TO_DATE('02-JAN-2022 17:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (2 , STR_TO_DATE('03-JAN-2022 12:19:43', '%d-%M-%Y %H:%i:%s'), 123066, STR_TO_DATE('03-JAN-2022 17:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (23, STR_TO_DATE('04-JAN-2022 15:19:43', '%d-%M-%Y %H:%i:%s'), 123766, STR_TO_DATE('04-JAN-2022 17:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (24, STR_TO_DATE('05-JAN-2022 09:19:43', '%d-%M-%Y %H:%i:%s'), 123166, STR_TO_DATE('05-JAN-2022 12:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (15, STR_TO_DATE('06-JAN-2022 08:19:43', '%d-%M-%Y %H:%i:%s'), 1     , STR_TO_DATE('06-JAN-2022 10:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (30, STR_TO_DATE('07-JAN-2022 16:19:43', '%d-%M-%Y %H:%i:%s'), 123766, STR_TO_DATE('07-JAN-2022 19:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (29, STR_TO_DATE('08-JAN-2022 18:19:43', '%d-%M-%Y %H:%i:%s'), 1     , STR_TO_DATE('08-JAN-2022 20:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (24, STR_TO_DATE('05-JAN-2022 19:19:43', '%d-%M-%Y %H:%i:%s'), 123166, STR_TO_DATE('05-JAN-2022 22:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (9 , STR_TO_DATE('05-JAN-2022 20:19:44', '%d-%M-%Y %H:%i:%s'), 369000, STR_TO_DATE('05-JAN-2022 21:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (11, STR_TO_DATE('17-MAR-2022 20:19:44', '%d-%M-%Y %H:%i:%s'), 500200, STR_TO_DATE('17-MAR-2022 21:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (3 , STR_TO_DATE('29-MAR-2022 17:20:44', '%d-%M-%Y %H:%i:%s'), 835800, STR_TO_DATE('31-MAR-2022 19:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (44, STR_TO_DATE('31-MAR-2022 20:19:44', '%d-%M-%Y %H:%i:%s'), 538200, STR_TO_DATE('31-MAR-2022 21:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (54, STR_TO_DATE('18-APR-2022 00:19:44', '%d-%M-%Y %H:%i:%s'), 200011, STR_TO_DATE('18-APR-2022 21:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (55, STR_TO_DATE('20-APR-2022 07:19:44', '%d-%M-%Y %H:%i:%s'), 100000, STR_TO_DATE('20-APR-2022 20:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (58, STR_TO_DATE('18-MAR-2022 10:19:44', '%d-%M-%Y %H:%i:%s'), 500200, STR_TO_DATE('18-MAR-2022 21:30:45', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (57, STR_TO_DATE('08-FEB-2022 18:19:43', '%d-%M-%Y %H:%i:%s'), 538200, STR_TO_DATE('08-FEB-2022 20:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (21, STR_TO_DATE('08-DEC-2022 11:19:43', '%d-%M-%Y %H:%i:%s'), 200011, STR_TO_DATE('08-DEC-2022 20:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (1 , STR_TO_DATE('18-DEC-2022 11:19:43', '%d-%M-%Y %H:%i:%s'), 1     , STR_TO_DATE('20-DEC-2022 12:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (2 , STR_TO_DATE('18-DEC-2022 12:19:43', '%d-%M-%Y %H:%i:%s'), 123466, STR_TO_DATE('20-DEC-2022 13:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (3 , STR_TO_DATE('18-DEC-2022 13:19:43', '%d-%M-%Y %H:%i:%s'), 338511, STR_TO_DATE('20-DEC-2022 14:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (4 , STR_TO_DATE('18-DEC-2022 14:19:43', '%d-%M-%Y %H:%i:%s'), 369000, STR_TO_DATE('20-DEC-2022 15:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (5 , STR_TO_DATE('18-DEC-2022 15:19:43', '%d-%M-%Y %H:%i:%s'), 538200, STR_TO_DATE('20-DEC-2022 16:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (7 , STR_TO_DATE('18-DEC-2022 17:19:43', '%d-%M-%Y %H:%i:%s'), 200011, STR_TO_DATE('20-DEC-2022 18:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (6 , STR_TO_DATE('18-DEC-2022 16:19:43', '%d-%M-%Y %H:%i:%s'), 100000, STR_TO_DATE('20-DEC-2022 17:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (8 , STR_TO_DATE('18-DEC-2022 18:19:43', '%d-%M-%Y %H:%i:%s'), 500040, STR_TO_DATE('20-DEC-2022 19:30:43', '%d-%M-%Y %H:%i:%s'));
insert into STATIONNEMENTS values (9 , STR_TO_DATE('18-DEC-2022 19:19:43', '%d-%M-%Y %H:%i:%s'), 500200, STR_TO_DATE('20-DEC-2022 20:30:43', '%d-%M-%Y %H:%i:%s'));

commit;
