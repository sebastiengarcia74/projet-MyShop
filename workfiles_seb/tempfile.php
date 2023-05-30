<!-- $productname = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING); -->



<?php
// Select all products
$products = $PDO_connection->query("SELECT * FROM products");

// Output products in HTML table
echo '<table>';
echo '<thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Action</th></tr></thead>';
echo '<tbody>';
foreach ($products as $product) {
  echo '<tr>';
  echo '<td>' . $product['id'] . '</td>';
  echo '<td>' . $product['name'] . '</td>';
  echo '<td>' . $product['price'] . '</td>';
  echo '<td>' . $product['description'] . '</td>';
  echo '<td><a href="modify_product.php?id=' . $product['id'] . '">Modify</a></td>';
  echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>





<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$productname = $_POST["name"];
	$price = $_POST["price"];
	$description = $_POST["description"];
	
	// Handle file upload
	$picture_name = $_FILES['picture']['name'];
	$picture_tmp_name = $_FILES['picture']['tmp_name'];
	$picture_error = $_FILES['picture']['error'];
	
	if ($picture_error === UPLOAD_ERR_OK) {
		// Move uploaded file to desired directory
		move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
		$image_path = 'uploads/' . $picture_name;
	} else {
		// Handle upload error
		$image_path = null;
	}

	// Insert product into database
	$createProduct = $PDO_connection->prepare("INSERT INTO products (name, price, description, image_path) VALUES (:name, :price, :description, :image_path)");
	$createProduct->bindParam(':name', $productname);
	$createProduct->bindParam(':price', $price);
	$createProduct->bindParam(':description', $description);
	$createProduct->bindParam(':image_path', $image_path);
	$createProduct->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//var_dump($_POST);
$productname = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];

$createProduct = $PDO_connection->query("INSERT INTO products (name, price, description) VALUES ('$productname', '$price', '$description')");

}