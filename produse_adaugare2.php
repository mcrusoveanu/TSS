<?php
$titlu_pagina = "Rezultat adaugare produs";
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
if (isset($_POST["Denumire"]) == false)
{
	print "Eroare! <br />";
	include("index_bottom.php");
	die();
}


// preluare date din produse_adaugare1.php din forma pe care le introduce utilizatorul
$denumire = ucfirst(trim($_POST["Denumire"]));
$descriere = ucfirst(trim($_POST["Descriere"]));
$unitatea_de_masura= strtolower(trim($_POST["Unitate_de_masura"]));
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

if (strlen($unitatea_de_masura) <= 1)
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


// verificare daca produsul adaugat exista deja in baza de date
include('conexiune.php');
$sir = "SELECT id_produs FROM produse WHERE denumire='" . $denumire . "' LIMIT 0,1";
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
$sir_adaugare = "INSERT INTO produse (denumire, descriere, unitate_de_masura,stoc_initial,stoc_actual,pret_unitar,id_categorie,id_producator)
			VALUES ('$denumire', '$descriere', '$unitatea_de_masura', $stoc_initial, $stoc_initial, $pret_unitar, $id_categorie, $id_producator)";
print $sir_adaugare . "<br />";
$inserare = mysqli_query($conectare, $sir_adaugare);
if($inserare==false)
{
	print 'Eroare la adaugarea produsului in baza de date!';
}
else
{
	$id_produs = mysqli_insert_id($conectare);
	print "Produsul a fost adaugat in baza de date cu id-ul " . $id_produs . "<br />";
	
	include("uploadimage.php");
}

mysqli_close($conectare);

?>


<?php
include("index_bottom.php");
?>

