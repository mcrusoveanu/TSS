<?php
$titlu_pagina = "Categorii";
include("index_top.php");
?>

<?php
include('conexiune.php');
$sir="SELECT * FROM categorii nume_categorie ORDER BY ordine_afisare";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysqli_fetch_array($tabel);
		$id_categ = $rand["id_categorie"];
		$nume_categorie = $rand["nume_categorie"];
		
		print '<a href="afisareproduse.php?idc=' . $id_categ . '">' . $nume_categorie . '</a>';
		if (isset($_SESSION["tip_utilizator"]) == true)
		if (intval($_SESSION["tip_utilizator"]) == 1)
		{
			print " <a href='categorie_modificare1.php?idc=" . $id_categ . "'>Modificare</a> - <a href='stergere_categorie1.php?idc=" . $id_categ . "'>Stergere</a>";
		}
		print '<br />';
	}
}
?>

<?php
include("index_bottom.php");
?>
