
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
	$DATE_HEURE=0; 
	$postData = $_POST;
	if (isset($postData['Date_heure']) ) {
		$DATE_HEURE=$postData['Date_heure'];
	}


	/************* VEHICULES par PARKING*************/
	?>
	<h1>Moyenne du nombre de places disponibles par parking :</h1>
	<?php

	// On récupère tout le contenu de la table VEHICULES
	$sqlQuery = 'SELECT avg(S.NB_PLACES_DISPO) as MOYENNE_PLACE_DISPONIBLE
				from (
				select L.NUMERO_PARKING, count(L.ID_PLACE) as NB_PLACES_DISPO
				from (
					  select PLACES.*
					  from PLACES
					  except
					  select PLACES.*
					  from PLACES natural join STATIONNEMENTS
					  where DATE_ET_HEURE_DE_STATIONNEMENT <= :moment
							and HEURE_SORTIE >= :moment) L
				group by L.NUMERO_PARKING) S;';
	 $parkingsStatement = $mysqlClient->prepare($sqlQuery);
	 $parkingsStatement->execute( ["moment" => $DATE_HEURE] );
	 $parkings = $parkingsStatement->fetchAll();

	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />' .'<br />';  ?></p>

		<form action="./moyenne_places_dispo2.php" method="post">
			<div class="mb-3">
				<label for="Date_heure" class="form-label">Moment (Date et heure)</label>
				<input type="datetime-local" class="form-control" id="Date_heure" name="Date_heure" ria-describedby="kmail-help" placeholder="exp : 132">
				<div id="mail-help" class="form-text">Entrer le momment au quel vous voulez lister les places disponibles par parking.</div>
			</div>
			<button type="submit" class="btn btn-primary">Envoyer</button>
	    </form>

	 <!-- Résultat ; On affiche chaque voiture une à une -->
	 </br></br>
	<h1>Résultat :</h1>
	<table class="table">
		<thead>
			<tr>
				<th><?php echo( 'MOYENNE_PLACE_DISPONIBLE'); ?></th>
    		</tr>
		</thead>
		<tbody>
			<?php
			foreach ($parkings as $parking) {
				?>
					<tr>
						<td><?php echo( $parking['MOYENNE_PLACE_DISPONIBLE']); ?></td>
						
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>




</body>
</html>