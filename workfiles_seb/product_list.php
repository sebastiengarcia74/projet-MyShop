<?php
include_once("connect_db.php");
session_start();
?>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>
<?php
        function index_display_products($pdo){
            if ($_GET['offset']) {  //c'est defini dans create_page.php
                $display_products = $pdo->query("SELECT * FROM products LIMIT 7 OFFSET $_GET[offset]");  //prend les 7 premiers produits avec un offset definni
                $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);  // met les resultat ds un tableau 

//var_dump($resdisplay_products);

                foreach($resdisplay_products as $row) {  //itere le tableau
                    $id=$row['id'];
                   // $table=$row['table']; // la suite reprend l'html de l'integration en remplacant img src, name, description et price par les valeurs de l'item ds tablaeu
                    ?>      
                        <div class="item"> 
                            <a href="" class="item_picture"><img src="<?php echo $row['image_path'];?>" alt="<?php echo $row['name'];?>"></a>
                            <div class="item_description">
                                <div class="item_left_description">
                                    <div class="item_name"><?php echo $row['name'];?></div>
                                    <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                    <div class="ranking">
                                        <img src="img_source/img_website/Star - On.png" alt="">
                                        <img src="img_source/img_website/Star - On.png" alt="">
                                        <img src="img_source/img_website/Star - On.png" alt="">
                                        <img src="img_source/img_website/Star.png" alt="">
                                        <img src="img_source/img_website/Star.png" alt="">
                                    </div>
                                </div>
                                <div class="item_right_description">
                                    <div class="price"><?php echo $row['price'] . " €";?></div>
                                    <a href="" aria-label="add to shopping cart"><div class="item_cart_plus"></div></a>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            } else {
                $query = $_GET["query"] === NULL ? "" : $_GET["query"]; // ternary : if $_get query est null, la valeur de $query est empty string, sinon c'est $_get["query"] 
                                                                        //$_get ["query"] est ce qui se trouve après le ? dans l'url
            $display_products = $pdo->query("SELECT * FROM products WHERE name LIKE '%$query%' LIMIT 7");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
              //  $table=$row['table'];
                ?>
                    <div class="item">
                        <a href="" class="item_picture"><img src="<?php echo $row['image_path'];?>" alt="<?php echo $row['name'];?>"></a>
                        <div class="item_description">
                            <div class="item_left_description">
                                <div class="item_name"><?php echo $row['name'];?></div>
                                <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                <div class="ranking">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star.png" alt="">
                                    <img src="img_source/img_website/Star.png" alt="">
                                </div>
                            </div>
                            <div class="item_right_description">
                                <div class="price"><?php echo $row['price'] . " €";?></div>
                                <a href="" aria-label="add to shopping cart"><div class="item_cart_plus"></div></a>
                            </div>
                        </div>
                    </div>
                <?php
            }
            }
            
        }
?>
<footer>
    <?php
        // create_product_page($pdo);
    ?>
</footer>