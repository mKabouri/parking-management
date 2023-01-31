
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
	$JOUR=0;
	$postData = $_POST;
	if (isset($postData['jour']) ) {
		$JOUR=$postData['jour'];
	}


	/************* VEHICULES par PARKING*************/
	?>
	<h1>Parkings qui sont saturés à un jour donnée :</h1>
	<?php

	// On récupère tout le contenu de la table VEHICULES
	$sqlQuery ='SELECT PARKINGS.* 
				from PARKINGS
				where CAPACITE = (select distinct count(*) from STATIONNEMENTS natural join PLACES
    			  	       		  where PARKINGS.NUMERO_PARKING = NUMERO_PARKING and DATE_ET_HEURE_DE_STATIONNEMENT < :jour  )
					and CAPACITE = (select distinct count(*) from STATIONNEMENTS natural join PLACES
    				  	       	  where PARKINGS.NUMERO_PARKING = NUMERO_PARKING and HEURE_SORTIE > DATE_ADD(:jour ,interval 24 HOUR)    )'; 

	 $parkingsStatement = $mysqlClient->prepare($sqlQuery);
	 $parkingsStatement->execute( ["jour" => $JOUR] );
	 $parkings = $parkingsStatement->fetchAll();

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

		<form action="./parkings_saturer_a_un_jour.php" method="post">
			<div class="mb-3">
				<label for="jour" class="form-label">Date</label>
				<input type="date" class="form-control" id="jour" name="jour" ria-describedby="kmail-help" placeholder="exp : 132">
				<div id="mail-help" class="form-text">Entrer la date du quel vous voulez lister tous les parkings qui sont saturés.</div>
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