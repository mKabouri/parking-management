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

        <a class="nav-link" href="./consultations/infos_parkings.php">Informations sur les parkings. </a>
        <a class="nav-link" href="consultations/infos_voitures.php">Informations sur les voitures. </a>
        <a class="nav-link" href="consultations/infos_communes.php">Informations sur les communes. </a>
        <a class="nav-link" href="consultations/voitures_par_parking.php">Liste des voitures par parking. </a>
        <a class="nav-link" href="consultations/parkings_par_commune.php">Liste des parkings par commune. </a>
        <a class="nav-link" href="consultations/parkings_saturer_a_un_jour.php">Liste des parkings qui sont saturés à un jour donnée. </a> 
        <a class="nav-link" href="consultations/places_disponibles_par_parking.php">Liste des places disponibles, par parking, à un moment donné . </a> 
        <a class="nav-link" href="consultations/voitures_garer_dans_deux_parking.php">liste de voitures qui se sont garées dans deux parkings dfférents au cours d'une journée. </a> 
    
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
