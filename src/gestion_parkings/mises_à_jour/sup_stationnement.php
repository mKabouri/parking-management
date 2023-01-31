
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
        <h1>Supprimer un stationnement :</h1>
	<?php
    
	
     $sqlQuery = "DELETE FROM STATIONNEMENTS
     WHERE `STATIONNEMENTS`.`DATE_ET_HEURE_DE_STATIONNEMENT` = :DATE_DE_STATIONNEMENT 
     AND `STATIONNEMENTS`.`NUMERO_MATRICULE` = :NUMERO_MATRICULE; "; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- supp_stationnement -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./sup_stationnement.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="matricule" class="form-label">N°matricule</label>
                <input type="number" class="form-control" id="matricule" name="matricule" ria-describedby="kmail-help" placeholder="exp : 123456">
                <div id="mail-help" class="form-text">N°matricule contient six chifres.</div>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date de stationnement :</label>
                <input type="datetime-local" class="form-control" id="date" name="date" ria-describedby="kmail-help" placeholder="exp : 123456">
                <div id="mail-help" class="form-text">N°matricule contient six chifres.</div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	$NUMERO_MATRICULE=0;
	$DATE_DE_STATIONNEMENT=0;

    $postData = $_POST;
	if (isset($postData['matricule']) && isset($postData['date']) ) {
		$NUMERO_MATRICULE=$postData['matricule'];
		$DATE_DE_STATIONNEMENT=$postData['date'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "NUMERO_MATRICULE" => $NUMERO_MATRICULE, 
            "DATE_DE_STATIONNEMENT" => $DATE_DE_STATIONNEMENT ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("Le stationnement du voiture de N°matricule=".$NUMERO_MATRICULE. " à : " .$DATE_DE_STATIONNEMENT. ", a été bien supprimée.");
        }
    ?>
    
    <?php /*include_once('footer.php');*/ ?>
</body>
</html>