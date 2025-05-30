<?php
$titlu_pagina = "Modificare producator";
include("index_top.php");
?>


<?php
if (isset($_GET["idp"]) == false)
{
	print "Eroare! Nu ati ales nici un producator ! <br />";
	include("index_bottom.php");
	die();
}

$id_producator = intval($_GET["idp"]);
if ($id_producator <= 0)
{
	print "Eroare! Nu ati ales nici un producator! <br />";
	include("index_bottom.php");
	die();
}

// preia din baza datele produsului ales
include("conexiune.php");
$sir = "SELECT * FROM producatori WHERE id_producator=" . $id_producator . " LIMIT 0,1";

$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr<=0)
{
	print "Eroare! Nu exista date despre acest producator! <br />";
	include("index_bottom.php");
	die();
}
else
{
	$rand = mysqli_fetch_array($tabel);
	$denumire_producator = trim($rand["denumire_producator"]);
	$ordine_afisare = trim($rand["ordine_afisare"]);
	
}
?>

<form name="frm_modificare_producator" method="post" action="producator_modificare2.php" enctype="multipart/form-data">
	<input type="hidden" id="idp" name="idp" value="<?php print $id_producator; ?>" /><br>
	
	<label for="Denumire">Denumire:</label><br>
	<input type="text" id="denumire_producator" name="denumire_producator" value="<?php print $denumire_producator; ?>" /><br>
	
	<label for="ordine_afisare">Ordine afisare:</label><br>
	<input type="number" id="ordine_afisare" name="ordine_afisare" value="<?php print $ordine_afisare; ?>"> <br>
	
   <label for="cbo_categ">Producator:</label><br>
   <?php
   $sir_categ = "SELECT * FROM producatori ORDER BY denumire_producator";
   $tabel_categ = mysqli_query($conectare, $sir_categ);
   $numar_categ = mysqli_num_rows($tabel_categ);
 
   ?>
    

   <input type="submit" name="btn_submit" value="Modificare producator" />
   
</form>



<?php
include("index_bottom.php");
?>
