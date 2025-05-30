<?php
$titlu_pagina = "Producatori";
include("index_top.php");
?>

<?php
// preluare id_categ daca s-a ales asa ceva


include('conexiune.php');
$sir="SELECT * FROM producatori denumire_producator ORDER BY id_oras";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysqli_fetch_array($tabel);
		$id_producator = $rand["id_producator"];
		$denumire_producator = $rand["denumire_producator"];
		
		print '<a href="afisareproduse.php?idp=' . $id_producator . '">' . $denumire_producator . '</a>';
		if (isset($_SESSION["tip_utilizator"]) == true)
		if (intval($_SESSION["tip_utilizator"]) == 1)
		{
			print " <a href='producator_modificare1.php?idp=" . $id_producator . "'>Modificare</a> - <a href='producator_stergere1.php?idp=" . $id_producator . "'>Stergere</a>";
		}
		print '<br />';
	}
}
?>

<?php
include("index_bottom.php");
?>
