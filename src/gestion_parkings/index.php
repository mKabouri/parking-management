<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <!-- Navigation -->
    <?php include_once('header.php'); ?>
    <h1>Modèle Conceptuel de Données :</h1>
    <img src="./models/conceptuel_model.png" alt="Logo HubSpot"/>
    <h1>Modèle Relationnel :</h1>
    <section>
            <!-- <h1 style="text-align: center; background-color: lightgreen;" >Modèle relationnel</h1> -->
                <PRE>
                    VEHICULES (<U>N°MATRICULE</U>, MARQUE, DATE_DE_MISE_EN_CIRCULATION, KILOMETRAGE, ETAT)
                    PLACES (<U>ID_PLACE</U>, NUMERO_AFFICHE, #NUMERO_PARKING)
                    PARKINGS (<U>NUMERO_PARGING</U>, ADRESSE, TARIF, CAPACITE, #CODE_POSTAL)
                    COMMUNES (<U>CODE_POSTAL</U>, NOM_COMMUNE)
                    STATIONNEMENTS (<U>DATE_ET_HEURE_DE_STATIONNEMENT, #N°MATRICULE</U>, #ID_PLACE, DATE SORTIE)
                </PRE>    
    </section>
    <?php include_once('footer.php'); ?>
</body>
</html>