<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="accueil.css" />
        <title>Toolbis</title>
    </head>

    <body>
	<?php include("menus.php"); ?>
	
	<div id="conteneur">
        <h1>Bienvenue sur Toolbis !</h1>
		
		<p style="text-align:center">
			Regarde nos annonces </br>
			Elles sont jolies.
		</p>
		
		<form action="cible_envoi.php" method="post" enctype="multipart/form-data">
			<p>
                Formulaire d'envoi de fichier :<br />
                <input type="file" name="monfichier" /><br />
                <input type="submit" value="Envoyer le fichier" />
			</p>

		</form>
		
	</div>
    </body>
</html>