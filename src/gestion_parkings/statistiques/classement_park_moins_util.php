
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


	/************* VEHICULES par PARKING*************/
	?>
	<h1>Classement des parking les moins utilisés :</h1>
	<?php

	// On récupère tout le contenu de la table VEHICULES
	$sqlQuery = 'SELECT NUMERO_PARKING, avg(TIMESTAMPDIFF( HOUR, DATE_ET_HEURE_DE_STATIONNEMENT, HEURE_SORTIE)) as moyenne
			from PARKINGS natural join PLACES natural join STATIONNEMENTS
			group by NUMERO_PARKING
			order by NUMERO_PARKING ASC;';
	 $parkingsStatement = $mysqlClient->prepare($sqlQuery);
	 $parkingsStatement->execute( [] );
	 $parkings = $parkingsStatement->fetchAll();

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>


	 <!-- Résultat ; On affiche chaque voiture une à une -->
	 </br></br>
	<h1>Résultat :</h1>
	<table class="table">
		<thead>
			<tr>
				<td><?php echo( 'NUMERO_PARKING'); ?></td>	
				<td><?php echo( 'MOYENNE'); ?></td>
    		</tr>
		</thead>
		<tbody>
			<?php
			foreach ($parkings as $parking) {
				?>
					<tr>
						<td><?php echo( $parking['NUMERO_PARKING']); ?></td>
						<td><?php echo( $parking['moyenne']); ?></td>				
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>




</body>
</html>