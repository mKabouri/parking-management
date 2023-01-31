
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

    <?php
	try
	{
		// On se connecte à MySQL
		$mysqlClient = new PDO('mysql:host=localhost;dbname=parking;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
	        die('Erreur : '.$e->getMessage());
	}
    ?>

    <!-- Navigation -->
    <?php /*include_once('../header.php');*/ ?>

    
    <!-- title -->
    <h1>Ajouter un stationnement :</h1>

    <?php
    
	
    $sqlQuery = "INSERT INTO `STATIONNEMENTS` (`ID_PLACE`, `DATE_ET_HEURE_DE_STATIONNEMENT`, `NUMERO_MATRICULE`) 
    VALUES (:ID_PLACE, :DATE_ET_HEURE_DE_STATIONNEMENT, :NUMERO_MATRICULE); "; 
    
   
   // On affiche la requête en SQL
   ?>
       <p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

    <!-- ajout_stationnement -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./ajout_stationnement.php" method="post">
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo($errorMessage); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="num" class="form-label">N°matricule</label>
                <input type="number" class="form-control" id="num" name="num" ria-describedby="kmail-help" placeholder="exp : 123456">
                <div id="mail-help" class="form-text">N°matricule contient six chifres.</div>
            </div>
            <div class="mb-3">
                <label for="Id_place" class="form-label">ID_palce</label>
                <input type="number" class="form-control" id="Id_place" name="Id_place" placeholder="exp : 113 ">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date et heure de stationnement</label>
                <input type="datetime-local" class="form-control" id="date" name="date" >
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <?php else: ?>
            <div class="alert alert-success" role="alert">
                Bonjour <?php echo($loggedUser['email']); ?> !
            </div>
        <?php endif; ?>
    
    </div>


    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	
    $Id_place=0;
    $Date=0;
    $Num_matriculation=0;

    $postData = $_POST;
    if (isset($postData['Id_place']) && isset($postData['date']) && isset($postData['num']) ) {
        $Id_place=$postData['Id_place'];
        $Date=$postData['date'];
        $Num_matriculation=$postData['num'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "ID_PLACE" => $Id_place,
            "DATE_ET_HEURE_DE_STATIONNEMENT" => $Date,
            "NUMERO_MATRICULE" => $Num_matriculation ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("La voiture de N°matricule = ".$Num_matriculation. " a été bien stationée à la place d'identifiant = " .$Id_place.".");
       
        } 
    ?>

    <?php /*include_once('footer.php');*/ ?>
</body>
</html>