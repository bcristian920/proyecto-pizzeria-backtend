<?php
 session_start();
 $_SESSION['logueado'];
 if ($_SESSION['logueado']) {

include_once("config_products.php");
include_once("db.class.php");

$link=new Db();

$idDel=$_GET["q"];


$sql="delete from products where id_product=".$idDel;

$stmt=$link->prepare($sql);
$stmt->execute();
header('location:welcome.php');

}
?>