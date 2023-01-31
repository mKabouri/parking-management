
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

	/*************  collect form data after submitting an HTML "$_POST" ************/
	$NUMERO_PARKING=0;
	$postData = $_POST;
	if (isset($postData['N°parking']) ) {
		$NUMERO_PARKING=$postData['N°parking'];
	}


	/************* VEHICULES par PARKING*************/
	?>
	<h1>Voitures par parking :</h1>
	<?php

	// On récupère tout le contenu de la table VEHICULES
	 $sqlQuery = 'SELECT DISTINCT VEHICULES.* FROM VEHICULES
	 			  NATURAL JOIN STATIONNEMENTS
	 			  NATURAL JOIN PLACES
	 			  WHERE PLACES.NUMERO_PARKING=:NUMERO_PARKING;';
	 $vehiculesStatement = $mysqlClient->prepare($sqlQuery);
	 $vehiculesStatement->execute( ["NUMERO_PARKING" => $NUMERO_PARKING] );
	 $vehicules = $vehiculesStatement->fetchAll();

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

		<form action="./voitures_par_parking.php" method="post">
			<div class="mb-3">
				<label for="N°parking" class="form-label">N°parking</label>
				<input type="number" class="form-control" id="N°parking" name="N°parking" ria-describedby="kmail-help" placeholder="exp : 132">
				<div id="mail-help" class="form-text">Entrer le numéro du parking du quel vous voulez lister tous les voitures qui sont dèja stationner au moins une fois.</div>
			</div>
			<button type="submit" class="btn btn-primary">Envoyer</button>
	    </form>

	 <!-- Résultat ; On affiche chaque voiture une à une -->
	 </br></br>
	<h1>Résultat :</h1>
	<table class="table">
		<thead>
			<tr>
				<th><?php echo( 'NUMERO_MATRICULE'); ?></th>
				<th><?php echo( 'DATE_DE_MISE_EN_CIRCULATION'); ?></th>
				<th><?php echo( 'ETAT'); ?></th>
				<th><?php echo( 'KILOMETRAGE'); ?></th>
				<th><?php echo( 'MARQUE'); ?></th>
    		</tr>
		</thead>
		<tbody>
			<?php
			foreach ($vehicules as $vehicule) {
				?>
					<tr>
						<td><?php echo( $vehicule['NUMERO_MATRICULE']); ?></td>
						<td><?php echo( $vehicule['DATE_DE_MISE_EN_CIRCULATION']); ?></td>
						<td><?php echo( $vehicule['ETAT']); ?></td>
						<td><?php echo( $vehicule['KILOMETRAGE']); ?></td>
						<td><?php echo( $vehicule['MARQUE']); ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>




</body>
</html>