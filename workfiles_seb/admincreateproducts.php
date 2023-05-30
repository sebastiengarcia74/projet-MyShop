<?php

include_once ("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');

}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$productname = $_POST["name"];
	$price = $_POST["price"];
	$description = $_POST["description"];
	// $chk_product = $pdo->prepare("SELECT * FROM products WHERE name=?");
	// $chk_product->execute([$productname]);
	// var_dump ($productname);
	// var_dump ($price);
	// var_dump ($description);
	// Handle file upload
	$picture_name = $_FILES["picture"]["name"];
	$picture_tmp_name = $_FILES['picture']['tmp_name'];
	$picture_error = $_FILES['picture']['error'];
	
	// if (($_POST['name']) == NULL || ($_POST['price']) == NULL || ($_POST['description']) == NULL) {
	// 	echo "Something's missing, please check your informations - ";
	// }

	if ($picture_error === UPLOAD_ERR_OK) {
		 //Move uploaded file to desired directory
		move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
		$image_path = 'uploads/' . $picture_name;
  } else {
		// Handle upload error
		$image_path = null;
	}
  
  //var_dump($image_path);
	// Insert product into database
	$createProduct = $pdo->prepare("INSERT INTO products (name, price, description, image_path) VALUES (:name, :price, :description, :image_path)");
	var_dump($createProduct);
	$createProduct->bindParam(':name', $productname);
	$createProduct->bindParam(':price', $price);
	$createProduct->bindParam(':description', $description);
	$createProduct->bindParam(':image_path', $image_path);
	$createProduct->execute();
	// header('Location: admin_products.php');
	
}

	?>
<!DOCTYPE HTML>
<form action="admincreateproducts.php" method="post" enctype="multipart/form-data">

<h2>CREATE PRODUCTS</h2>

<!-- //  if (isset($_GET['error'])) { 
	// <p class="error"> echo $_GET['error'];</p>
-->
<label>Product Name</label>

<input type="text" name="name" placeholder="Product Name"><br>

<label>Product Price</label>

<input type="int" name="price" placeholder="Product Price"><br>

<label>Description</label>

<input type="text" name="description" placeholder="description"><br> 

<label for="picture">Upload a Picture:</label>

<input type="file" name="picture"><br> 

<button type="submit">ADD</button>


</form>


