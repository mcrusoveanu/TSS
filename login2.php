<?php

$titlu_pagina = "Rezultat autentificare";
include("index_top.php");
?>

<?php
$ok = 1;
$username="";
$parola="";
if(isset($_POST["username"])==false)
{
	$ok = 0;
}

if(isset($_POST["parola"])==false)
{
	$ok= 0;
}

$username = trim($_POST["username"]);
$parola = trim($_POST["parola"]);

if (is_text_valid($username) == false)
{
	$ok = 0;
	print "Nu ati introdus un nume de utilizator corect1! <br />";
}

if (htmlspecialchars($username) == false or htmlentities($username)==false)
{
	$ok = 0;
	print "Nu ati introdus un nume de utilizator corect-htmlspecialchars! <br />";
}


if (is_text_valid($parola) == false)
{
	$ok = 0;
	print "Nu ati introdus o parola buna! <br />";
}



if($ok==0)
{
	print("Nu ati introdus date corecte ");
	include("index_bottom.php");
	die();
}

$parola = md5($parola);

include("conexiune.php");
$sir="select * from utilizatori where username='$username' and parola='$parola' limit 0,1";
if (is_sir_sql_valid($sir) == false)
{
	$ok = 0;
	print "Nu ati introdus un sir valid! <br />";
}


$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel);

if($nr==0)
{
	print("Eroare! Nu ati introdus date corecte! ");
	include("index_bottom.php");
	die();
}

$rand = mysqli_fetch_array($tabel);
$_SESSION["id"]=intval($rand["id_utilizator"]);
$_SESSION["tip_utilizator"]=intval($rand["tip_utilizator"]);
$_SESSION["username"]=intval($rand["username"]);
$_SESSION["nume"]=ucwords($rand["nume"]);
$_SESSION["prenume"]=ucwords($rand["prenume"]);


 

print "Autentificare cu succes!";
?>

<?php
include("index_bottom.php");
?>
