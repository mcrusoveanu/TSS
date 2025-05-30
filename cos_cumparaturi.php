<?php
$titlu_pagina = "Magazin Mihai";
include("index_top.php");
?>


<?php
$id_user = intval($_SESSION["id"]);

if ($id_user <= 0)
{
	print "Nu sunteti autentificat! >br />";
	include("index_bottom.php");
	die();
}

include('conexiune.php');
$sir="SELECT * FROM comenzi_detalii 
	INNER JOIN produse ON comenzi_detalii.id_produs=produse.id_produs 
		INNER JOIN comenzi ON comenzi_detalii.id_comanda=comenzi.id_comanda 
			WHERE comenzi.id_utilizator=" . $id_user;
print $sir . "<br />";

$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysqli_fetch_array($tabel);
		$id_produs = $rand["id_produs"];
		$denumire_produs = $rand["denumire"];
		
		print '<a href="detaliiproduse.php?id=' . $id_produs . '">' . $denumire_produs . '</a>';
		if (isset($_SESSION["tip_utilizator"]) == true)
			if (intval($_SESSION["tip_utilizator"]) == 1)
			{
				print " - <a href='produs_modificare1.php?idp=" . $id_produs . "'>Modificare</a> - <a href='produs_stergere1.php?idp=" . $id_produs . "'>Stergere</a>";
			}
		print '<br />';
	}
}

?>


<?php
include("index_bottom.php");
?>
