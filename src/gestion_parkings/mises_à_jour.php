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
        
            <a class="nav-link" href="./mises_à_jour/ajout_voiture.php">Ajouter une voiture. </a>
            <a class="nav-link" href="./mises_à_jour/ajout_parking.php">Ajouter un parking. </a>
            <a class="nav-link" href="./mises_à_jour/ajout_commune.php">Ajouter une commune. </a> 
            <a class="nav-link" href="./mises_à_jour/ajout_stationnement.php">Ajouter un stationnement. </a> 
            <a class="nav-link" href="./mises_à_jour/ajout_fin_stationnement.php">Ajouter une fin stationnement. </a> 
            
            <a class="nav-link" href="contact.php">Modifier une voiture. </a>
            <a class="nav-link" href="contact.php">Modifier un parking. </a>
            <a class="nav-link" href="contact.php">Modifier une commune. </a> 
            <a class="nav-link" href="contact.php">Modifier un stationnement. </a> 
            <a class="nav-link" href="contact.php">Modifier une fin stationnement. </a> 
            
            <a class="nav-link" href="./mises_à_jour/sup_voiture.php">supprimer une voiture. </a>
            <a class="nav-link" href="./mises_à_jour/sup_parking.php">supprimer un parking. </a>
            <a class="nav-link" href="./mises_à_jour/sup_commune.php">supprimer une commune. </a> 
            <a class="nav-link" href="./mises_à_jour/sup_stationnement.php">supprimer un stationnement. </a> 
            <a class="nav-link" href="contact.php">supprimer une fin stationnement. </a> 
            
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
