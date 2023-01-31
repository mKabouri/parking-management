
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
    <?php /*include_once('../header.php');*/ ?>

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

    <!-- title -->
    <h1>Ajouter un parking :</h1>
    <?php
    
	
     $sqlQuery = "INSERT INTO `PARKINGS` (`NUMERO_PARKING`, `ADRESSE`, `TARIF`, `CAPACITE`, `CODE_POSTAL`) 
                    VALUES (:parking, :Adresse, :Tarif, :Capacite, :Code_postal); "; 

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- ajout_voiture -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./ajout_parking.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="parking" class="form-label">N°parking</label>
                <input type="number" class="form-control" id="parking" name="parking" ria-describedby="kmail-help" placeholder="exp : 12">
                <div id="mail-help" class="form-text">N°parking est unique.</div>
            </div>
            <div class="mb-3">
                <label for="Adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="exp : Unitec Pessac ">
            </div>
            <div class="mb-3">
                <label for="Tarif" class="form-label">Tarif</label>
                <input type="number" class="form-control" id="Tarif" name="Tarif" placeholder="Tarif en €">
            </div>
            <div class="mb-3">
                <label for="Capacité" class="form-label">Capacité</label>
                <input type="number" class="form-control" id="Capacité" name="Capacité" placeholder="Capacité maximal du parking, exp : 100 ">
            </div>
            <div class="mb-3">
                <label for="Code_postal" class="form-label">Code_postal</label>
                <input type="number" class="form-control" id="Code_postal" name="Code_postal" placeholder="le code postale contient cinq chiffres, exp : 33400 ">
            </div>
            
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
    $N°parking=0;
    $Adresse=0;
    $Tarif=0;
    $Capacité=0;
    $Code_postal=0;
	
    $postData = $_POST;
	if (isset($postData['parking']) /*&& isset($postData['Adresse']) && isset($postData['Tarif']) && isset($postData['Capacité'])&& isset($postData['Code_postal'])*/ ) {
        $N°parking=$postData['parking'];
        $MARQUE=$postData['Adresse'];
        $DATE=$postData['Tarif'];
        $KILOMETRAGE=$postData['Capacité'];
        $Code_postal=$postData['Code_postal'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "parking" => $N°parking,
            "Adresse" => $Adresse,
            "Tarif" => $Tarif,
            "Capacite" => $Capacité,
            "Code_postal" => $Code_postal ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("Le parking de N°parking = ".$N°parking. " a été bien ajouté.");
       
        } 
    ?>

    <?php /*include_once('footer.php');*/ ?>
</body>
</html>