<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('header.php'); ?>
        <a class="nav-link" href="./statistiques/moyenne_places_dispo2.php"> moyenne du nombre de places disponibles par parking. </a>
        <a class="nav-link" href="./statistiques/duree_moyenne_stationnement.php"> la durée moyenne de stationnement d'un véhicule par parking. </a>
        <a class="nav-link" href="./statistiques/cout_moy_statio_vehi_par_mois.php"> le cout moyen du stationnement d'un véhicule par mois. </a>
        <a class="nav-link" href="./statistiques/classement_park_moins_util.php"> classement des parking les moins utilisés. </a>
        <a class="nav-link" href="./statistiques/classement_park_plus_rentable_par_commune.php"> classement des parking les plus rentables par commune et par mois. </a>
        <a class="nav-link" href="./statistiques/classement_commune_plus_demandes_par_semaine.php"> classement des communes les plus demandés par semaine. </a>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
