
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
        <h1>Supprimer une commune :</h1>
	<?php
    
	
     $sqlQuery = "DELETE from COMMUNES where Code_postal=:Code_postal; "; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- supp_commune -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./sup_commune.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="Code_postal" class="form-label">Code postal</label>
                <input type="number" class="form-control" id="Code_postal" name="Code_postal" ria-describedby="kmail-help" placeholder="exp : 30400">
                <div id="mail-help" class="form-text">Le code postal contient cinq chifres.</div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	$Code_postal=0;

    $postData = $_POST;
	if (isset($postData['Code_postal']) ) {
		$Code_postal=$postData['Code_postal'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "Code_postal" => $Code_postal ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("La commune de code postale =".$Code_postal. " a été bien supprimée.");
        }
    ?>
    
    <?php /*include_once('footer.php');*/ ?>
</body>
</html>