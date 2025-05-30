<?php
$titlu_pagina = "Rezultat stergere producator";
include("index_top.php");
?>




<?php
include("conexiune.php");
$id_producator= intval($_POST["idp"]);
	

$sir = "Delete FROM producatori WHERE id_producator=" . $id_producator . " LIMIT 1";
// print $sir;
$stergere = mysqli_query($conectare, $sir);
if($stergere == false)
{
	print "Eroare la stergere producator! <br />";
	include("index_bottom.php");
	die();
}
else
{
    print "<br />";
	print "Producatorul a fost sters din baza de date!";
}
?>

<?php
include("index_bottom.php");
?>
