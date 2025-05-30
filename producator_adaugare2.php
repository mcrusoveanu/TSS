<?php
$titlu_pagina = "Rezultat adaugare producator";
include("index_top.php");
?>

<?php
if (isset($_SESSION["id"]) == false)
{
	print "Eroare! Nu sunteti autentificat! <br />";
	include("index_bottom.php");
	die();
}
// previne modificare din bara de sus 
if (isset($_POST["denumire_producator"]) == false)
{
	print "Eroare! <br />";
	include("index_bottom.php");
	die();
}


// preluare date din produse_adaugare1.php din forma pe care le introduce utilizatorul
$denumire_producator = ucfirst(trim($_POST["denumire_producator"]));
$adresa = ucfirst(trim($_POST["adresa"]));
$id_oras = intval(trim($_POST["cbo_oras"]));
$ordine_afisare = intval(trim($_POST["ordine_afisare"]));


// validare date preluate
$ok = 1;
if (strlen($denumire_producator) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o denumire corecta pentru producator! <br />";
}

if (strlen($adresa) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o adresa corecta pentru producator! <br />";
}


if (intval($id_oras) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati ales un oras! <br />";
}

if (intval($ordine_afisare) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati ales nici o ordine de afisare pentru producator! <br />";
}


if ($ok == 0)
{
	include("index_bottom.php");
	die();
}


// verificare daca produsul adaugat exista deja in baza de date
include('conexiune.php');
$sir = "SELECT id_producator FROM producatori WHERE denumire_producator='" . $denumire_producator . "' LIMIT 0,1";
$tabel = mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	print 'Eroare! Producatorul exista deja in baza de date!';
	mysqli_close($conectare);
	include("index_bottom.php");
	die();
}


// salvare date produs in baza de date
$sir_adaugare = "INSERT INTO producatori (denumire_producator, adresa, id_oras,ordine_afisare)
	VALUES ('$denumire_producator', '$adresa', '$id_oras', $ordine_afisare)";
print $sir_adaugare . "<br />";
$inserare = mysqli_query($conectare, $sir_adaugare);
if($inserare==false)
{
	print 'Eroare la adaugarea producatorului in baza de date!';
}
else
{
	$id_producator = mysqli_insert_id($conectare);
	print "Producatorul a fost adaugat in baza de date cu id-ul " . $id_producator . "<br />";
	
}

mysqli_close($conectare);

?>


<?php
include("index_bottom.php");
?>

