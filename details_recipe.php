<?php

$id = $_GET["id"];

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

//REQUETE POUR RECUPERER LES ELEMENTS

//METHODE PREPARE
$recipeStatement = $mysqlClient->prepare('SELECT id_recipe, instructions, recipe_name, preparation_time, category_name 
FROM recipe
INNER JOIN category
ON recipe.id_category = category.id_category
WHERE id_recipe = :id'); // ":id" correspond ici à id-recipe/ "id est repris dans la méthode EXECUTE sans les ":"


//METHODE EXECUTE
$recipeStatement->execute([
    "id" => $id 
]);

$recipe = $recipeStatement->fetch();/*car on recherche un élément (fecthAll pour plusieurs éléments)*/

echo $recipe["recipe_name"];

$recipeStatement = $mysqlClient->prepare('SELECT * FROM ingredient
INNER JOIN recipe_ingredients
ON ingredient.id_ingredient = recipe_ingredients.id_ingredient
WHERE id_recipe = :id');

$recipeStatement->execute([
    "id" => $id 
]);

$recipe = $recipeStatement->fetchAll();

foreach ($ingredient as $ingredient){
    ?>
		<p><?php echo $ingredient['id_ingredient']; ?></p>
		<p><?php echo $ingredient['id_recipe']; ?></p>
        <p><?php echo $ingredient['quantity']; ?></p>

	<?php	
}
?>