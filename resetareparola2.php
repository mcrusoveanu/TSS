

<?php
include("index_top.php");
?>




<?php

$ok = 1;
$mail="";
$parola="";
if(isset($_POST["email"])==false)
{
	print("nu ati introdus adresa de email, eroare ");
	$ok = 0;
}
if(isset($_POST["parola"])==false)
{   
    print("nu ati introdus adresa de email, eroare ");
	$ok= 0;
	
}
if($ok==0)
{
	include("index_bottom.php");
	die();
}

$parola = md5($parola);


include('conexiune.php');
$sir="select * from utilizatori where email = '$email' and parola='$parola' limit 0,1";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr==0)
{
	print("Eroare! Nu ati introdus date corecte! ");
	include("index_bottom.php"); 
	die();
}

$rand = mysqli_fetch_array($tabel);
$_SESSION["email"]=strtolower($rand["email"]);
$id_utilizator = intval($rand["id_utilizator"]);

print "Autentificare cu succes!";
?>



<?php
include("index_bottom.php");
?>