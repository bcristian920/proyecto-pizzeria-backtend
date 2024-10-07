<?php
$product=$_POST['producto'];
$price=$_POST['precio'];
$category=$_POST['categoria'];
include_once("config_products.php");
include_once("db.class.php");
$link=new Db();
// La conexión
include_once('upload_image.php');
$path_img=$directorio.$nombre_img; // Ruta completa de la imagen levantada

include_once('upload.class.php');
$upload=new Upload();
$path_img=$upload->uploadImage();

$sql="insert into products (product_name,image,price,id_category) values
(:product,:path_img,:price,:category)";
$stmt = $link->prepare($sql);
$stmt->bindValue(':product', $product);
$stmt->bindValue(':price', $price);
$stmt->bindValue(':category', $category);
$stmt->bindValue(':path_img', $path_img); //No es necesario sanear
if ($stmt->execute()){
    ?>
    <script>
     alert("Producto Ingresado!"); 
     window.location="insert_products.php";
    </script>
    
    <?php
    }
    
?>