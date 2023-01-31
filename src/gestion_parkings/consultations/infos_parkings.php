
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
	<!-- title -->
	    <h1>Informations sur les parkings :</h1>

	<?php
	/************* PARKINGS *************/

	// On récupère tout le contenu de la table PARKING
	 $sqlQuery = 'SELECT * FROM PARKINGS';
	 $parkingsStatement = $mysqlClient->prepare($sqlQuery);
	 $parkingsStatement->execute();
	 $parkings = $parkingsStatement->fetchAll();
	?>

	<!-- On affiche la requête en SQL -->
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />'. '<br />';  ?></p>

	<!-- On affiche chaque parking un à un -->
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

</body>
</html>