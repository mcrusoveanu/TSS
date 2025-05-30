<?php
$titlu_pagina = "Rezultat stergere produs";
include("index_top.php");
?>




<?php
include("conexiune.php");
$id_produs= intval($_POST["idp"]);
	

$sir = "Delete FROM produse WHERE id_produs=" . $id_produs . " LIMIT 1";
// print $sir;
$stergere = mysqli_query($conectare, $sir);
if($stergere == false)
{
	print "Eroare la stergere produs! <br />";
	include("index_bottom.php");
	die();
}
else
{
    print "<br />";
	print "Produsul a fost sters din baza de date!";
}
?>

<?php
include("index_bottom.php");
?>
