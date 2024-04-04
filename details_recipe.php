<?php


//CONNEXION
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

//1ER EXO: REQUETE POUR RECUPERER LES ELEMENTS

$id_recipe = $_GET["id"];

//METHODE PREPARE
$recipeStatement = $mysqlClient->prepare('SELECT id_recipe, instructions, recipe_name, preparation_time, category_name 
FROM recipe
INNER JOIN category
ON recipe.id_category = category.id_category
WHERE id_recipe = :id'); // ":id" correspond ici à id-recipe/ "id est repris dans la méthode EXECUTE sans les ":"


$recipeStatement->execute(array(
    ':id' => $id_recipe
));

$recipe = $recipeStatement->fetch();/*car on recherche un élément (fecthAll pour plusieurs éléments)*/

echo $recipe["recipe_name"]; //AFFICHAGE DU NOM DE LA RECETTE SELECTIONNEE


//2EME EXO: REQUETE POUR RECUPERER LES ELEMENTS (Quantity, Ingredient Name)

//METHODE PREPARE
$recipeStatement = $mysqlClient->prepare('SELECT * FROM ingredient
INNER JOIN recipe_ingredients
ON ingredient.id_ingredient = recipe_ingredients.id_ingredient
WHERE id_recipe = :id');

//METHODE EXECUTE
$recipeStatement->execute(array(
    ':id' => $id_recipe
));

$ingredient = $recipeStatement->fetchAll();

//AFFICHAGE DU TABLEAU AAVEC LES RESULTATS
?>

<table>  
	<tr>
		<th>Quantity</th>
		<th>Ingredient Name</th>
			</tr>

	<?php foreach ($ingredient as $ingredient) : ?>
    <tr>
	<td><?php echo $ingredient['quantity'];?></td>
    <td><?php echo $ingredient['ingredient_name'];?></td>
	<tr>
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

  


  


