
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
        <h1>Ajouter une voiture :</h1>
	<?php
    
	
     $sqlQuery = "INSERT INTO `VEHICULES` (`NUMERO_MATRICULE`, `MARQUE`, `DATE_DE_MISE_EN_CIRCULATION`, `KILOMETRAGE`, `ETAT`) 
                VALUES (:matricule, :Marque, :Date_circulation, :Kilometrage, :Etat);"; 
     
    
	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>
    
    <!-- ajout_voiture -->
            <?php if(!isset($loggedUser)): ?>
        <form action="./ajout_voiture.php" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="matricule" class="form-label">N°matricule</label>
                <input type="number" class="form-control" id="matricule" name="matricule" ria-describedby="kmail-help" placeholder="exp : 123456">
                <div id="mail-help" class="form-text">N°matricule contient six chifres.</div>
            </div>
            <div class="mb-3">
                <label for="Marque" class="form-label">Marque</label>
                <input type="text" class="form-control" id="password" name="Marque" placeholder="exp : Audi, BMW, Citroën, Mercedes, Peugeot, Renault, ... ">
            </div>
            <div class="mb-3">
                <label for="Date_circulation" class="form-label">Date de mise en circulation</label>
                <input type="date" class="form-control" id="password" name="Date_circulation" placeholder="a" >
            </div>
            <div class="mb-3">
                <label for="Kilométrage" class="form-label">Kilométrage</label>
                <input type="number" class="form-control" id="password" name="Kilometrage" placeholder="exp : Audi, BMW, Citroën, Mercedes, Peugeot, Renault, ... ">
            </div>
            <div class="mb-3">
                <label for="Etat" class="form-label">Etat</label></br>
                <select name="Etat" id="Etat">
                    <option value="">--Please choose an option--</option>
                    <option valeur="EXCELENT">EXCELENT</option>
                    <option valeur="BIEN">BIEN</option>
                    <option valeur="MOYEN">MOYEN</option>
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    
    </div>

    <?php
    /*************  collect form data after submitting an HTML "$_POST" ************/
	$N°matricule=0;
    $MARQUE=0;
    $DATE;
    $KILOMETRAGE=0;
    $ETAT=0;
	$postData = $_POST;
	if (isset($postData['matricule']) && isset($postData['Marque']) && isset($postData['Date_circulation']) && isset($postData['Kilometrage']) && isset($postData['Etat']) ) {
		$N°matricule=$postData['matricule'];
        $MARQUE=$postData['Marque'];
        $DATE=$postData['Date_circulation'];
        $KILOMETRAGE=$postData['Kilometrage'];
        $ETAT=$postData['Etat'];
        
        $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
        $vehiculesStatement->execute([ 
            "matricule" => $N°matricule,
            "Marque" => $MARQUE,
            "Date_circulation" => $DATE,
            
            "Kilometrage" => $KILOMETRAGE,
            "Etat" => $ETAT ]
        );
        $vehicules = $vehiculesStatement->fetchAll();
        echo("La voiture de N°matricule=".$N°matricule. " a été bien ajoutée.");
        }
    ?>
    
    <?php /*include_once('footer.php');*/ ?>
</body>
</html>