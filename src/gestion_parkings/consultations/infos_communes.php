
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
		<h1>informations sur les communes :</h1>

	<?php
	/************* COMMUNES *************/

	// On récupère tout le contenu de la table COMMUNES
	$sqlQuery = 'SELECT * FROM COMMUNES';
	$communesStatement = $mysqlClient->prepare($sqlQuery);
	$communesStatement->execute();
	$communes = $communesStatement->fetchAll();


	// On affiche la requête en SQL
	?>
		<p><?php echo 'La requête en SQL : ' . $sqlQuery . '<br />'. '<br />';  ?></p>

	<!-- On affiche chaque commune une à une -->
	<h1>Résultat :</h1>

	<table class="table">
		<thead>
			<tr>
			<th><?php echo( 'CODE_POSTAL'); ?></th>
			<th><?php echo( 'NOM_COMMUNE'); ?></th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			foreach ($communes as $commune) {
				?>
					<tr>
						<td><?php echo( $commune['CODE_POSTAL']); ?></td>
						<td><?php echo( $commune['NOM_COMMUNE']); ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>

	</table>
	</div>
</body>
</html>