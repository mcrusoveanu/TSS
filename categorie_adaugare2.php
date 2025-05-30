<?php
$titlu_pagina = "Rezultat adaugare categorie";
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
if (isset($_POST["nume_categorie"]) == false)
{
	print "Eroare! <br />";
	include("index_bottom.php");
	die();
}


// preluare date din produse_adaugare1.php din forma pe care le introduce utilizatorul
$nume_categorie = ucfirst(trim($_POST["nume_categorie"]));
$ordine_afisare=floatval(trim($_POST["ordine_afisare"]));



// validare date preluate
$ok = 1;
if (strlen($nume_categorie) <= 2)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o denumire corecta pentru produs! <br />";
}

if (intval($ordine_afisare) <= 0)
{
	$ok = 0;
	print "Eroare! Nu ati ales nici o ordine de afisare pentru categorie! <br />";
}



if ($ok == 0)
{
	include("index_bottom.php");
	die();
}


// verificare daca produsul adaugat exista deja in baza de date
include('conexiune.php');
$sir = "SELECT nume_categorie FROM categorii WHERE nume_categorie='" . $nume_categorie . "' LIMIT 0,1";

$tabel = mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	print 'Eroare! Produsul exista deja in baza de date!';
	mysqli_close($conectare);
	include("index_bottom.php");
	die();
}


// salvare date produs in baza de date
$sir_adaugare = "INSERT INTO categorii (nume_categorie, ordine_afisare)
	VALUES ('$nume_categorie', '$ordine_afisare')";
$inserare = mysqli_query($conectare, $sir_adaugare);
if($inserare==false)
{
	print 'Eroare la adaugarea categoriei in baza de date!';
	print $sir_adaugare;
}
else
{
	$id_categorie = mysqli_insert_id($conectare);
	print "Categoria a fost adaugata in baza de date cu id-ul " . $id_categorie . "<br />";
	
}

mysqli_close($conectare);

?>


<?php
include("index_bottom.php");
?>
