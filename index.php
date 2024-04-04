<?php

try
{
	$mysqlClient = new PDO(
		'mysql:host=localhost;dbname=recettes_hafida;charset=utf8',
		'root',
		''
	);

	//echo "Connexion réussie";
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//On récupère tout le contenu de la table recipe
$recipeStatement = $mysqlClient->prepare('SELECT * FROM recipe');
$recipeStatement->execute();
$recipe = $recipeStatement->fetchAll();

/*On affiche chaque recette une à une
foreach ($recipe as $recipe) {
	?>
		<p><?php echo $recipe['recipe_name']; ?></p>
	<?php
	}
*/


//REQUETE POUR SELECTIONNER LES ELEMENTS(Recipe Name, Preparation Time, Category Name)

//METHODE PREPARE
$recipeStatement = $mysqlClient->prepare('SELECT id_recipe, recipe_name, preparation_time, category_name 
FROM recipe
INNER JOIN category
ON recipe.id_category = category.id_category');


//METHODE EXECUTE
$recipeStatement->execute();
$recipe = $recipeStatement->fetchAll();

//AFFICHER LES RECETTES DANS UN TABLEAU HTML AVEC 3 COLONNES
?>

<table>  
	<tr>
		<th>Recipe Name</th>
		<th>Preparation Time</th>
		<th>Category Name</th>
	</tr>
	

<?php foreach ($recipe as $recipe): ?>
	
	<tr>
		<td><a href = "details_recipe.php?id=<?= $recipe["id_recipe"] ?>" target=_blank><?php echo $recipe['recipe_name'];?></a></td>
		<td><?php echo $recipe['preparation_time']; ?></td>
		<td><?php echo $recipe['category_name']; ?></td>
	</tr>
	
	<?php endforeach 
?>
</table>


<style> /*MISE EN FORME DU TABLEAU CSS*/
	table {
		border:3px solid black;
	}

	th, td{
		padding:20px;	
	}
</style>

  



