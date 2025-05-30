<?php
$titlu_pagina = "Modificare Producator - Rezultat";
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

if (isset($_POST["idp"])==false )
{
	print"Eroare, nu ati ales niciun producator!<br/>";
	include("index_bottom.php");
	die();
}

// preluare date din produse_modificare1.php
$id_producator= intval($_POST["idp"]);
$denumire_producator = ucfirst(trim($_POST["denumire_producator"]));
$ordine_afisare=intval(trim($_POST["ordine_afisare"]));



// validare date preluate
$ok = 1;
if (strlen($denumire_producator) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o denumire corecta pentru producator! <br />";
}


if (intval($ordine_afisare) < 0)
{
	$ok = 0;
	print "Eroare! Nu ati introdus pozitia de afisare pentru producator! <br />";
}

if ($ok == 0)
{
	include("index_bottom.php");
	die();
}

// salvare date produs in baza de date
include("conexiune.php");
$sir_modificare = "UPDATE producatori SET 
	denumire_producator='$denumire_producator', 
	ordine_afisare='$ordine_afisare'
	WHERE id_producator=" . $id_producator;
print 	$sir_modificare;
$modificare = mysqli_query($conectare, $sir_modificare);
if($modificare==false)
{
	print 'Eroare la modificare producatori in baza de date!';
}
else
{
	print "Producatorul a fost modificat! <br />";
}

mysqli_close($conectare);

?>



<?php
include("index_bottom.php");
?>
