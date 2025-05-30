<?php
$titlu_pagina = "Modificare produs - Rezultat";
include("index_top.php");
?>


<?php
print "id din sesiune =" . $_SESSION["id"] . "<br />";
if (isset($_SESSION["id"])==false)
{
	print "Eroare, nu sunteti autentificat! <br/>";
	include ("index_bottom.php");
	die();
}

if (isset($_POST["Denumire"])==false )
{
	print"Eroare, nu sunteti autentificat!<br/>";
	include("index_bottom.php");
	die();
}

// preluare date din produse_modificare1.php
$id_produs= intval($_POST["idp"]);
$denumire = ucfirst(trim($_POST["Denumire"]));
$descriere = ucfirst(trim($_POST["Descriere"]));
$unitate_de_masura= strtolower(trim($_POST["Unitate_de_masura"]));
$stoc_initial=intval(trim($_POST["stoc_initial"]));
$pret_unitar=floatval(trim($_POST["Pret_unitar"]));
$id_producator = intval(trim($_POST["cbo_producator"]));
$id_categorie = intval(trim($_POST["cbo_categ"]));


// validare date preluate
$ok = 1;
if (strlen($denumire) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o denumire corecta pentru produs! <br />";
}

if (strlen($descriere) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o descriere corecta pentru produs! <br />";
}

if (strlen($unitate_de_masura) <= 1)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o unitatea de masura corecta pentru produs! <br />";
}

if (intval($stoc_initial) < 0)
{
	$ok = 0;
	print "Eroare! Nu ati introdus un stoc initial pentru produs! <br />";
}

if (floatval($pret_unitar) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati introdus un pret unitar pentru produs! <br />";
}

if (intval($id_categorie) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati ales nicio categorie pentru produs! <br />";
}

if (intval($id_producator) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati ales niciun producator pentru produs! <br />";
}

if ($ok == 0)
{
	include("index_bottom.php");
	die();
}

// salvare date produs in baza de date
include("conexiune.php");
$sir_modificare = "UPDATE produse SET 
	denumire='$denumire', 
	descriere='$descriere',
	unitate_de_masura='$unitate_de_masura',
	stoc_initial='$stoc_initial',
	pret_unitar='$pret_unitar',
	id_categorie='$id_categorie',
	id_producator='$id_producator'
	WHERE id_produs=" . $id_produs;
	
$modificare = mysqli_query($conectare, $sir_modificare);
if($modificare==false)
{
	print 'Eroare la modificare produsului in baza de date!';
}
else
{
	print "Produsul a fost modificat! <br />";
	
	include("uploadimage.php");
}

mysqli_close($conectare);

?>



<?php
include("index_bottom.php");
?>
