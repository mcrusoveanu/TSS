<?php
$titlu_pagina = "Stergere Categorie";
include("index_top.php");
?>

<?php

//verifica daca exista un idp
if (isset($_GET["idc"]) == false)
{
	print "Eroare! Nu ati ales nicio categorie! <br />";
	include("index_bottom.php");
	die();
}

//verifica idp este mai mic ca zero, in baza de date sunt numai valori pozitive
$id_categorie = intval($_GET["idc"]);
if ($id_categorie <= 0)
{
	print "Eroare! Nu ati ales nicio categorie! <br />";
	include("index_bottom.php");
	die();
}


include("conexiune.php");
$sir = "SELECT nume_categorie FROM categorii WHERE id_categorie=" . $id_categorie . " LIMIT 0,1";
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
}
?>


<form name="frm_stergere_categorie" method="post" action="stergere_categorie2.php" enctype="multipart/form-data">
<?php // ascundere produs?>
	<input type="hidden" id="idc" name="idc" value="<?php print $id_categorie; ?>" /><br>
	
	<label for="Denumire">Sunteti sigur ca doriti sa stergeti din baza categoria <strong>
	<?php print $nume_categorie; ?> </strong> ?<br>
    </label>
	
   <input type="submit" name="btn_submit" value="Stergere categoria" />
</form>

<?php
include("index_bottom.php");
?>
