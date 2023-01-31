
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
    <h1>Ajouter une fin de stationnement :</h1>

    <?php
	
    $sqlQuery = "UPDATE `STATIONNEMENTS`
    SET  `HEURE_SORTIE` = :HEURE_SORTIE
    WHERE `NUMERO_MATRICULE` = :NUMERO_MATRICULE
    AND ISNULL(`HEURE_SORTIE`); "; 
    
   
   // On affiche la requête en SQL
   ?>
       <p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

    <!-- ajout_fin_stationnement -->
            <?php if(!isset($loggedUser)): ?>
        
        <form action="./ajout_fin_stationnement.php" method="post">
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
                <label for="date_sortie" class="form-label">Date et heure de sortie</label>
                <input type="datetime-local" class="form-control" id="date_sortie" name="date_sortie" >
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
    $NUMERO_MATRICULE=0;
    $HEURE_SORTIE=0;

    $postData = $_POST;
	if (isset($postData['num']) && isset($postData['date_sortie']) ) {
		$NUMERO_MATRICULE=$postData['num'];
        $HEURE_SORTIE=$postData['date_sortie'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "NUMERO_MATRICULE" => $NUMERO_MATRICULE,
            "HEURE_SORTIE" => $HEURE_SORTIE ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("La voiture de N°matricule=".$NUMERO_MATRICULE. " a sortie du parking.");
       
        } 
    ?>

    <?php /*include_once('footer.php');*/ ?>
</body>
</html>