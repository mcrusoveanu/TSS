<?php
$titlu_pagina = "Afisare produse";
include("index_top.php");
?>

<?php
// preluare id_categ daca s-a ales asa ceva
$id_categ = 0;
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
if (isset($_POST["speechToText"]) == true)
{
	$speechToText = $_POST["speechToText"];
	print "Text cautat: <strong>" . $speechToText . "</strong><br />";
	$sir .= " WHERE denumire LIKE '%" . $speechToText . "%'";
}
$sir .= " ORDER BY denumire LIMIT 0,10";

print $sir . "<br/>";

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
