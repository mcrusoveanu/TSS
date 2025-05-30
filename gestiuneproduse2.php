<?php
$titlu_pagina = "Gestiune Produse2";
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
if (isset($_POST["cbo_produs"]) == false)
{
	print "Eroare! <br />";
	include("index_bottom.php");
	die();
}


// preluare date din produse_adaugare1.php din forma pe care le introduce utilizatorul
$id_produs = intval(trim($_POST["cbo_produs"]));
$cantitate= intval(trim($_POST["cantitate_stoc_adugata"]));


// validare date preluate
$ok = 1;
if ($id_produs<= 0)
{
	$ok = 0;
	print "Eroare! Nu ati selectat un id de produs<br />";
}

if (intval($cantitate) < 0)
{
	$ok = 0;
	print "Eroare! Nu ati introdus o contitate! <br />";
}

if ($ok == 0)
{
	include("index_bottom.php");
	die();
}


// verificare daca produsul adaugat exista deja in baza de date
include('conexiune.php');
/*
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
*/

$sir= "select stoc_actual from produse where id_produs = $id_produs"; 
print $sir . "<br />";
$cerere= mysqli_query($conectare, $sir);
$numar=mysqli_num_rows($cerere); 
if($numar==0)
{
	print 'Eroare cerere!';
	mysqli_close($conectare);
	include("index_bottom.php");
	die();
}
$rand = mysqli_fetch_array($cerere);
$stoc_actual = intval($rand["stoc_actual"]);
$stoc_actual= $stoc_actual + $cantitate;


// salvare date produs in baza de date
$sir_adaugare = "INSERT INTO intrari_gestiune (id_produs, cantitate, data_si_ora)
	VALUES ('$id_produs', '$cantitate',NOW())";
$inserare = mysqli_query($conectare, $sir_adaugare);
if($inserare==false)
{
	print 'Eroare la adaugarea produsului in baza de date!';
}
else
{
	$sir_update = "UPDATE produse SET stoc_actual=" . $stoc_actual . " where id_produs=" . $id_produs . " limit 1";
    $update = mysqli_query($conectare, $sir_update);
	if($update==false)
	{
		print 'Eroare la modificare stoc produs actual!';
	}
	else
		print "Stocul actual a fost modificat in baza de date pt produsul cu id-ul " . $id_produs . "<br />";
	
}
mysqli_close($conectare);
?>

<?php
include("index_bottom.php");
?>
