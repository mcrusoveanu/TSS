<?php
$titlu_pagina = "Rezultat Stergere Categorie";
include("index_top.php");
?>

<?php
include("conexiune.php");
$id_categorie= intval($_POST["idc"]);
	

$sir = "Delete FROM categorii WHERE id_categorie=" . $id_categorie . " LIMIT 1";
// print $sir;
$stergere = mysqli_query($conectare, $sir);
if($stergere == false)
{
	print "Eroare la stergere categorie! <br />";
	include("index_bottom.php");
	die();
}
else
{
    print "<br />";
	print "Categoria a fost stersa din baza de date!";
}
?>

<?php
include("index_bottom.php");
?>
