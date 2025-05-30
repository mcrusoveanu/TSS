<?php
$titlu_pagina = "Modificare Categorie";
include("index_top.php");
?>


<?php
if (isset($_GET["idc"]) == false)
{
	print "Eroare! Nu ati ales nicio categorie ! <br />";
	include("index_bottom.php");
	die();
}

$id_categorie = intval($_GET["idc"]);
if ($id_categorie <= 0)
{
	print "Eroare! Nu ati ales nicio categorie! <br />";
	include("index_bottom.php");
	die();
}

// preia din baza datele produsului ales
include("conexiune.php");
$sir = "SELECT * FROM categorii WHERE id_categorie=" . $id_categorie . " LIMIT 0,1";

$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr<=0)
{
	print "Eroare! Nu exista date despre acesta categorie! <br />";
	include("index_bottom.php");
	die();
}
else
{
	$rand = mysqli_fetch_array($tabel);
	$nume_categorie = trim($rand["nume_categorie"]);
	$ordine_afisare = trim($rand["ordine_afisare"]);
	
}
?>

<form name="frm_modificare_categorie" method="post" action="categorie_modificare2.php" enctype="multipart/form-data">
	<input type="hidden" id="id_categorie" name="id_categorie" value="<?php print $id_categorie; ?>" /><br>
	
	<label for="Denumire">Denumire:</label><br>
	<input type="text" id="nume_categorie" name="nume_categorie" value="<?php print $nume_categorie; ?>" /><br>
	
	<label for="ordine_afisare">Ordine afisare:</label><br>
	<input type="number" id="ordine_afisare" name="ordine_afisare" value="<?php print $ordine_afisare; ?>"> <br>
	
   <label for="cbo_categ">Categorie:</label><br>
   <?php
   $sir_categ = "SELECT * FROM categorii ORDER BY nume_categorie";
   $tabel_categ = mysqli_query($conectare, $sir_categ);
   $numar_categ = mysqli_num_rows($tabel_categ);
 
   ?>
    

   <input type="submit" name="btn_submit" value="Modificare categorie" />
   
</form>



<?php
include("index_bottom.php");
?>
