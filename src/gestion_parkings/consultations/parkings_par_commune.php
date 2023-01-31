
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
	$CODE_POSTAL=0;
	$postData = $_POST;
	if (isset($postData['Code_postale']) ) {
		$CODE_POSTAL=$postData['Code_postale'];
	}


	/************* VEHICULES par PARKING*************/
	?>
	<h1>Parkings par commune :</h1>
	<?php

	// On récupère tout le contenu de la table VEHICULES
	$sqlQuery = 'SELECT *
				from PARKINGS 
				where PARKINGS.CODE_POSTAL =:CODE_POSTAL';
	 $parkingsStatement = $mysqlClient->prepare($sqlQuery);
	 $parkingsStatement->execute( ["CODE_POSTAL" => $CODE_POSTAL] );
	 $parkings = $parkingsStatement->fetchAll();

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

		<form action="./parkings_par_commune.php" method="post">
			<div class="mb-3">
				<label for="Code_postale" class="form-label">Code postale de la commune</label>
				<input type="number" class="form-control" id="Code_postale" name="Code_postale" ria-describedby="kmail-help" placeholder="exp : 132">
				<div id="mail-help" class="form-text">Entrer le code postale de la commune du quel vous voulez lister tous les parkings.</div>
			</div>
			<button type="submit" class="btn btn-primary">Envoyer</button>
	    </form>

	 <!-- Résultat ; On affiche chaque voiture une à une -->
	 </br></br>
	<h1>Résultat :</h1>
	<table class="table">
		<thead>
			<tr>
				<th><?php echo( 'NUMERO_PARKING'); ?></th>
				<th><?php echo( 'ADRESSE'); ?></th>
				<th><?php echo( 'TARIF'); ?></th>
				<th><?php echo( 'CAPACITE'); ?></th>
				<th><?php echo( 'CODE_POSTAL'); ?></th>
    		</tr>
		</thead>
		<tbody>
			<?php
			foreach ($parkings as $parking) {
				?>
					<tr>
						<td><?php echo( $parking['NUMERO_PARKING']); ?></td>
						<td><?php echo( $parking['ADRESSE']); ?></td>
						<td><?php echo( $parking['TARIF']); ?></td>
						<td><?php echo( $parking['CAPACITE']); ?></td>
						<td><?php echo( $parking['CODE_POSTAL']); ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>




</body>
</html>