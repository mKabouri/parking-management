
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
    <h1>Ajouter une commune :</h1>

    <?php
    
	
     $sqlQuery = "INSERT INTO `COMMUNES` (`CODE_POSTAL`, `NOM_COMMUNE`) 
     VALUES (:CODE_POSTAL, :NOM_COMMUNE);"; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    

    <!-- ajout_commune -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./ajout_commune.php" method="post">
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo($errorMessage); ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="Code postale de la commune" class="form-label">Code postale de la commune</label>
                <input type="number" class="form-control" id="Code_postal" name="Code_postal" placeholder="exp : 33600">
                <div id="mail-help" class="form-text"> Le code postal en France est une suite de cinq chiffres.</div>
            </div>
            
            <div class="mb-3">
                <label for="Nom de la commune" class="form-label">Nom de la commune</label>
                <input type="text" class="form-control" id="Nom_commune" name="Nom_commune" placeholder="exp : PESSAC ">
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
	
    $CODE_POSTAL=0;
    $NOM_COMMUNE=0;

    $postData = $_POST;
	
    if (isset($postData['Code_postal']) && isset($postData['Nom_commune']) ) {
	    $CODE_POSTAL=$postData['Code_postal'];
        $NOM_COMMUNE=$postData['Nom_commune'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "CODE_POSTAL" => $CODE_POSTAL,
            "NOM_COMMUNE" => $NOM_COMMUNE ]
        );

        $vehicules = $vehiculesStatement->fetchAll();
        echo("La commune de code postale =".$CODE_POSTAL. " a été bien ajoutée.");
       
        } 
    ?>

    <?php /*include_once('footer.php');*/ ?>
</body>
</html>