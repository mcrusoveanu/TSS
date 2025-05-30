<?php
$titlu_pagina = "Afisare comanda";
include("index_top.php");
?>

<?php


// preluare id produs
if (isset($_GET["id"]) == false)
{
	print "Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}

// preluare id_categ daca s-a ales asa ceva
$id_comanda = 0;
if (isset($_GET["idc"]) == true)
	$id_categ = intval($_GET["idc"]);

// preluare id_categ daca s-a ales asa ceva
$id_producator = 0;
if (isset($_GET["idp"]) == true)
	$id_producator = intval($_GET["idp"]);

include('conexiune.php');
$sir="SELECT * FROM produse ";
if ($id_categ > 0)
	$sir .= " WHERE id_categorie=" . $id_categ;
if ($id_producator > 0)
	$sir .= " WHERE id_producator=" . $id_producator;
$sir .= " ORDER BY denumire";
print $sir;
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
				print " <a href='produs_modificare1.php?idp=" . $id_produs . "'>Modificare</a> - <a href='produs_stergere1.php?idp=" . $id_produs . "'>Stergere</a>";
			}
		print '<br />';
	}
}

?>


<?php
include("index_bottom.php");
?>