<?php
$titlu_pagina = "Adaugare produuse  cos cumparaturi";
include("index_top.php");
?>

<?php
if (isset($_SESSION["id"]) == false)
{
	print "Eroare! Nu sunteti autentificat! <br />";
	include("index_bottom.php");
	die();
}

print isset($_POST["idprod"]) . "<br />";

if (isset($_POST["idprod"]) <= 0)
{
	print "Eroare produs! <br />";
	include("index_bottom.php");
	die();
}

// preluare si validare date
$ok = 1;
$idprod = 0;
$pret = 0;
$cantitate=0;
$iduser=0;

$idprod = intval($_POST["idprod"]);
$pret = intval($_POST["pret"]);
$cantitate=intval($_POST["cantitate"]);
$iduser=intval($_SESSION["id"]);

if ($idprod <= 0)
{
	$ok = 0;
	print "Eroare la produs! <br />";
}
if ($pret <= 0)
{
	$ok = 0;
	print "Eroare la pret! <br />";
}
if ($cantitate <= 0)
{
	$ok = 0;
	print "Eroare la cantitate! <br />";
}
if ($iduser <= 0)
{
	$ok = 0;
	print "Eroare la utilizatori! <br />";
}

if ($ok == 0)  // daca s-a gasit cel putin o eroare, se opreste codul
{
	include("index_bottom.php");
	die();
}


// baza de date
include("data_curenta.php");
include('conexiune.php');

// verificare daca produsul exista in stoc
$sir= "SELECT stoc_actual FROM produse WHERE id_produs = " . $idprod . " LIMIT 0,1"; 
print $sir . "<br />";
$cerere = mysqli_query($conectare, $sir);
$numar=mysqli_num_rows($cerere); 
if($numar==0)
{
	print 'Eroare executare cerere! <br />';
	mysqli_close($conectare);
	include("index_bottom.php");
	die();
}
$rand = mysqli_fetch_array($cerere);
$stoc_actual = intval($rand["stoc_actual"]);
$stoc_actual= $stoc_actual - $cantitate;
if($stoc_actual<0)
{
	print 'Produsele comandate sunt mai multe decat cele din stoc! <br />';
	mysqli_close($conectare);
	include("index_bottom.php");
	die();
}

// verificare daca utilizatorul are deja o comanda facuta astazi
$sir_verificare = "SELECT id_comanda, valoare_comanda FROM comenzi WHERE id_utilizator=" . $iduser . " AND data_comanda='" . $data_curenta . "' LIMIT 0,1";
print $sir_verificare . "<br />";
$tabel = mysqli_query($conectare, $sir_verificare);
$numar_randuri = mysqli_num_rows($tabel);

if ($numar_randuri == 0)
{
	$sir_inserare_comenzi = "INSERT INTO comenzi (id_utilizator, data_comanda, data_ora_comanda, ip_comanda) 
		VALUES ($iduser, NOW(), NOW(), '" . $_SERVER['REMOTE_ADDR'] . "')";
	$inserare_comanda = mysqli_query($conectare, $sir_inserare_comenzi);
	$id_comanda = mysqli_insert_id($conectare);
	$valoare_comanda = 0;
}
else
{
	$rand = mysqli_fetch_array($tabel);
	$id_comanda = intval($rand["id_comanda"]);
	$valoare_comanda = floatval($rand["valoare_comanda"]);
}

// am id_comanda a utilizatorului pentru comanda facuta AZI
$sir_intro_produs_in_detalii_comanda = "INSERT INTO comenzi_detalii (id_comanda, id_produs, cantitate_vanduta, pret_vanzare) 
	VALUES ($id_comanda, $idprod, $cantitate, $pret)";
$inserare_detalii_comanda = mysqli_query($conectare, $sir_intro_produs_in_detalii_comanda);
if ($inserare_detalii_comanda == false)
{
	print "Eroare la introducerea in cosul de cumparaturi! <br />";
}
else
{
	print "Produsul a fost adaugat in cosul de cumparaturi! <br />";
	
	// Actualizare valoare totala a facturii
	$valoare_comanda = $valoare_comanda + $cantitate * $pret;
	$sir_actualizare = "UPDATE comenzi SET valoare_comanda=" . $valoare_comanda . " WHERE id_comanda=" . $id_comanda . " LIMIT 1";
	$actualizare_valoare_comanda = mysqli_query($conectare, $sir_actualizare);
	
	if ($actualizare_valoare_comanda == false)
	{
		print "Eroare la actualizare valoare comanda! <br />";
	}
	else
	{
		$sir_update = "UPDATE produse SET stoc_actual=" . $stoc_actual . " WHERE id_produs=" . $idprod . " LIMIT 1";
		$update = mysqli_query($conectare, $sir_update);
		print $sir_update;
		if($update==false)
		{
			print 'Eroare la modificare stoc produs adaugare in cos!';
			print $sir_update;
		}
		else
			print "Stocul actual a fost modificat in baza de date pt produsul cu id-ul dupa adaugare in cos " . $idprod . "<br />";
	}
}

?>

<?php
include("index_bottom.php");
?>
