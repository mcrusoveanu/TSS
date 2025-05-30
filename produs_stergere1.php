<?php
$titlu_pagina = "Stergere produs";
include("index_top.php");
?>


<?php

//verifica daca exista un idp
if (isset($_GET["idp"]) == false)
{
	print "Eroare! Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}

//verifica idp este mai mic ca zero, in baza de date sunt numai valori pozitive
$id_produs = intval($_GET["idp"]);
if ($id_produs <= 0)
{
	print "Eroare! Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}


include("conexiune.php");
$sir = "SELECT denumire FROM produse WHERE id_produs=" . $id_produs . " LIMIT 0,1";
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
	$denumire = trim($rand["denumire"]);	
}
?>


<form name="frm_stergere_produs" method="post" action="produs_stergere2.php" enctype="multipart/form-data">
<?php // ascundere produs?>
	<input type="hidden" id="idp" name="idp" value="<?php print $id_produs; ?>" /><br>
	
	<label for="Denumire">Sunteti sigur ca doriti sa stergeti din baza produsul <strong>
	<?php print $denumire; ?> </strong> ?<br>
    </label>
	
   <input type="submit" name="btn_submit" value="Stergere produs" />
</form>

<?php
include("index_bottom.php");
?>
