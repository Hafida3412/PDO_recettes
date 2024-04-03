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

$recipeStatement = $mysqlClient->prepare('SELECT recipe_name, preparation_time, category_name 
FROM recipe
INNER JOIN category
ON recipe.id_category = category.id_category');


$recipeStatement->execute();
$recipe = $recipeStatement->fetchAll();


?>
<table>
	<tr>
		<th>Recipe Name</th>
		<th>Preparation Time</th>
		<th>Category Name</th>
	</tr>
	

<?php foreach ($recipe as $recipe): ?>
 
	<tr>
		<td><?php echo $recipe['recipe_name']; ?></td>
		<td><?php echo $recipe['preparation_time']; ?></td>
		<td><?php echo $recipe['category_name']; ?></td>
	</tr>
	
	<?php endforeach ?>
</table>

<style>
	table {
		border:3px solid black;
	}

	th, td{
		padding:20px;	
	}
</style>

  



