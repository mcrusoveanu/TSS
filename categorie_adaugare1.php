<?php
$titlu_pagina = "Forma adaugare categorie";
include("index_top.php");
?>

<?php
if (isset($_SESSION["id"]) == false)
{
	print "Eroare! Nu sunteti autentificat! <br />";
	include("index_bottom.php");
	die();
}
?>

<form name="frm_adaugare_categorie" method="post" action="categorie_adaugare2.php" enctype="multipart/form-data">
	<label for="Denumire">Denumire:</label><br>
	<input type="text" id="nume_categorie" name="nume_categorie"><br>
		
	<label for="ordine_afisare">Ordine afisare:</label><br>
	<input type="number" id="ordine_afisare" name="ordine_afisare"><br>
     <br>

   <input type="submit" name="btn_submit" value="Adaugare categorie" />
</form>


<?php
include("index_bottom.php");
?>
