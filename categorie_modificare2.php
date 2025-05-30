<?php
$titlu_pagina = "Modificare Categorie - Rezultat";
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

if (isset($_POST["nume_categorie"])==false )
{
	print"Eroare, nu sunteti autentificat!<br/>";
	include("index_bottom.php");
	die();
}

// preluare date din produse_modificare1.php
$id_categorie= intval($_POST["id_categorie"]);
$nume_categorie = ucfirst(trim($_POST["nume_categorie"]));
$ordine_afisare=intval(trim($_POST["ordine_afisare"]));



// validare date preluate
$ok = 1;
if (strlen($nume_categorie) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o denumire corecta pentru categorie! <br />";
}


if (intval($ordine_afisare) < 0)
{
	$ok = 0;
	print "Eroare! Nu ati introdus pozitia de afisare pentru categorie! <br />";
}

if ($ok == 0)
{
	include("index_bottom.php");
	die();
}

// salvare date produs in baza de date
include("conexiune.php");
$sir_modificare = "UPDATE categorii SET 
	nume_categorie='$nume_categorie', 
	ordine_afisare='$ordine_afisare'
	WHERE id_categorie=" . $id_categorie;
print 	$sir_modificare;
$modificare = mysqli_query($conectare, $sir_modificare);
if($modificare==false)
{
	print 'Eroare la modificare categorie in baza de date!';
}
else
{
	print "Categoria a fost modificata! <br />";
}

mysqli_close($conectare);

?>



<?php
include("index_bottom.php");
?>
