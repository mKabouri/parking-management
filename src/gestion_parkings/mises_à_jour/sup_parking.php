
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

    <?php
    

	/************* VEHICULES par PARKING*************/
	?>
        <!-- title -->
        <h1>Supprimer un parking :</h1>
	<?php
    
	
     $sqlQuery = "DELETE from PARKINGS where  NUMERO_PARKING=:parking; "; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- supp_parking -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./sup_parking.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="parking" class="form-label">N°parking</label>
                <input type="number" class="form-control" id="parking" name="parking" ria-describedby="kmail-help" placeholder="exp : 12">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	$N°parking=0;

    $postData = $_POST;
	if (isset($postData['parking']) ) {
		$N°parking=$postData['parking'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "parking" => $N°parking ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("Le parking de N°parking=".$N°parking. " a été bien supprimé.");
        }
    ?>
    
    <?php /*include_once('footer.php');*/ ?>
</body>
</html>