
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
        <h1>Supprimer une voiture :</h1>
	<?php
    
	
     $sqlQuery = "DELETE from VEHICULES where  NUMERO_MATRICULE=:matricule; "; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- supp_voiture -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./sup_voiture.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="matricule" class="form-label">N°matricule</label>
                <input type="number" class="form-control" id="matricule" name="matricule" ria-describedby="kmail-help" placeholder="exp : 123456">
                <div id="mail-help" class="form-text">N°matricule contient six chifres.</div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	$N°matricule=0;

    $postData = $_POST;
	if (isset($postData['matricule']) ) {
		$N°matricule=$postData['matricule'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "matricule" => $N°matricule ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("La voiture de N°matricule=".$N°matricule. " a été bien supprimée.");
        }
    ?>
    
    <?php /*include_once('footer.php');*/ ?>
</body>
</html>