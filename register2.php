<?php
$titlu_pagina = "Register2";
include("index_top.php");
?>


<?php
if (isset($_POST["username"]) == false)
{
	print "Nu ati introdus un nume de utilzator! <br />";
	include("index_bottom.php");
	die();
}

// preluare si prelucrare date
$username = trim($_POST["username"]);
$parola = trim($_POST["parola"]);
$nume = ucwords(trim($_POST["nume"]));
$prenume = ucwords(trim($_POST["prenume"]));
$data_nastere = trim($_POST["data_nastere"]);
$adresa = trim($_POST["adresa"]);
$x = intval(trim($_POST["x"]));
$raspuns = intval(trim($_POST["raspuns"]));

$id_oras = intval($_POST["cbo_oras"]);
$nume_oras = "";
if ($id_oras == 0)
{
	$nume_oras = ucwords(trim($_POST["txt_oras"]));
}

$telefon = trim($_POST["telefon"]);
$email = strtolower(trim($_POST["email"]));


// validare date
$ok = 1;
if (strlen($username) <= 9)
{
	$ok = 0;
	print "Nu ati introdus un nume de utilizator suficient de lung! <br />";
}
if (is_text_valid($username) == false)
{
	$ok = 0;
	print "Nu ati introdus un nume de utilizator corect! <br />";
}
if (htmlspecialchars($username) == false or htmlentities($username) == false)
{
	$ok = 0;
	print "Nu ati introdus un nume de utilizator corect! <br />";
}

if (htmlspecialchars($parola) == false or htmlentities($parola) == false)
{
	$ok = 0;
	print "Nu ati introdus o parola corecta! <br />";
}


if (strlen($parola) <= 6)
{
	$ok = 0;
	print "Nu ati introdus o parola suficient de lunga! <br />";
}
if (strlen($nume) <= 2)
{
	$ok = 0;
	print "Nu ati introdus un nume suficient de lung! <br />";
}
if (strlen($prenume) <= 2)
{
	$ok = 0;
	print "Nu ati introdus prenume suficient de lung! <br />";
}
if (strlen($adresa) <= 6)
{
	$ok = 0;
	print "Nu ati introdus o adresa suficient de lunga! <br />";
}
if ($id_oras == 0)
{
	$ok = 0;
	print "Nu ati ales orasul! <br />";
}
if (strlen($telefon) <= 9)
{
	$ok = 0;
	print "Nu ati introdus o numar de telefon suficient de lung! <br />";
}
if (is_email_valid($email) == false)
{
	$ok = 0;
	print "Nu ati introdus o adresa de email suficient de lunga! <br />";
}
if ($raspuns != $vr[$x])
{
	$ok = 0;
	print "Nu ati introdus o valoare corecta matematica! <br />";
}

if ($ok == 0)
{
	include("index_bottom.php");
	die();
}

$parola = md5($parola);


// verificare daca mai exista deja un utilizator cu acest username sau acest email
include("conexiune.php");
$sir="SELECT id_utilizator FROM utilizatori WHERE username='" . $username . "' OR email='" . $email . "' LIMIT 0,1";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel);

if($nr>0)
{
	print "Eroare! Exista deja un utilizator cu acest username sau cu aceasta adresa de email! <br />";
	include("index_bottom.php");
	die(); 
}


$sir_inserare = "INSERT INTO `utilizatori` (`id_utilizator`, `tip_utilizator`, `username`, `parola`, `nume`, `prenume`, `data_nastere`, `adresa`, `id_oras`, `telefon`, `email`) 
	VALUES (NULL, '0', '" . $username . "', '" . $parola . "', '" . $nume . "', '" . $prenume . "', '" . $data_nastere . "', '" . $adresa . "', '" . $id_oras . "', '" . $telefon . "', '" . $email . "')";
$cmd_inserare = mysqli_query($conectare, $sir_inserare);
print "<br>";
print $sir_inserare;
print "<br>";

if ($cmd_inserare == false)
{
	print "Eroare la salvarea datelor in baza! <br />";
	print mysqli_error();
}
else
{
	print "Felicitari! Contul dvs de utilizator a fost create! <br />";
}

?>


<?php
include("index_bottom.php");
?>
