<?php
$titlu_pagina = "Stergere producator";
include("index_top.php");
?>


<?php

//verifica daca exista un idp
if (isset($_GET["idp"]) == false)
{
	print "Eroare! Nu ati ales niciun producator! <br />";
	include("index_bottom.php");
	die();
}

//verifica idp este mai mic ca zero, in baza de date sunt numai valori pozitive
$id_producator = intval($_GET["idp"]);
if ($id_producator <= 0)
{
	print "Eroare! Nu ati ales niciun producator! <br />";
	include("index_bottom.php");
	die();
}


include("conexiune.php");
$sir = "SELECT denumire_producator FROM producatori WHERE id_producator=" . $id_producator . " LIMIT 0,1";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr<=0)
{
	print "Eroare! Nu exista date despre acest produs! <br />";
	include("index_bottom.php");
	die();
}
else
{
	$rand = mysqli_fetch_array($tabel);
	$denumire = trim($rand["denumire_producator"]);	
}
?>


<form name="frm_stergere_producator" method="post" action="producator_stergere2.php" enctype="multipart/form-data">
<?php // ascundere produs?>
	<input type="hidden" id="idp" name="idp" value="<?php print $id_producator; ?>" /><br>
	
	<label for="Denumire">Sunteti sigur ca doriti sa stergeti din baza producatorul <strong>
	<?php print $denumire; ?> </strong> ?<br>
    </label>
	
   <input type="submit" name="btn_submit" value="Stergere producator" />
</form>

<?php
include("index_bottom.php");
?>
