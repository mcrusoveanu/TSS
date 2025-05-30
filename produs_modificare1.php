<?php
$titlu_pagina = "Modificare produs";
include("index_top.php");
?>


<?php
if (isset($_GET["idp"]) == false)
{
	print "Eroare! Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}

$id_produs = intval($_GET["idp"]);
if ($id_produs <= 0)
{
	print "Eroare! Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}

// preia din baza datele produsului ales
include("conexiune.php");
$sir = "SELECT * FROM produse WHERE id_produs=" . $id_produs . " LIMIT 0,1";

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
	$descriere = trim($rand["descriere"]);
	$unitate_de_masura = trim($rand["unitate_de_masura"]);
	$stoc_initial = intval($rand["stoc_initial"]);
	$stoc_actual = intval($rand["stoc_actual"]);
	$pret_unitar = floatval($rand["pret_unitar"]);
	$id_categorie = intval($rand["id_categorie"]);
	$id_producator = intval($rand["id_producator"]);
}
?>


<form name="frm_modificare_produs" method="post" action="produs_modificare2.php" enctype="multipart/form-data">
	<input type="hidden" id="idp" name="idp" value="<?php print $id_produs; ?>" /><br>
	
	<label for="Denumire">Denumire:</label><br>
	<input type="text" id="Denumire" name="Denumire" value="<?php print $denumire; ?>" /><br>
	
	<label for="Denumire">Descriere:</label><br>
	<input type="text" id="Descriere" name="Descriere" value="<?php print $descriere; ?>" /><br>
	
	<label for="Unitate_de_masura">Unitate de masura:</label><br>
	<input type="text" id="Unitate_de_masura" name="Unitate_de_masura" value="<?php print $unitate_de_masura; ?>"> <br>
	
	<label for="stoc_initial">Stoc initial:</label><br>
	<input type="number" id="stoc_initial" name="stoc_initial" value="<?php print $stoc_initial; ?>"> <br>
	
	<label for="Pret_unitar">*Pret unitar:</label><br>
	<input type="number" id="Pret_unitar" name="Pret_unitar"value="<?php print $pret_unitar; ?>"><br>
   

   <label for="cbo_categ">Categorie:</label><br>
   <?php
   $sir_categ = "SELECT * FROM categorii ORDER BY nume_categorie";
   $tabel_categ = mysqli_query($conectare, $sir_categ);
   $numar_categ = mysqli_num_rows($tabel_categ);
   
   print '<select name="cbo_categ">';
   print '<option value="0">Alegeti categoria!</option>';
   for ($i=1; $i<=$numar_categ; $i++)
   {
   		$rand_categ = mysqli_fetch_array($tabel_categ);
		$id_categorie_tabela = intval(trim($rand_categ["id_categorie"]));
		$nume_categorie = ucfirst(trim($rand_categ["nume_categorie"]));
		
		if ($id_categorie == $id_categorie_tabela)
	   		print '<option value="' . $id_categorie . '" SELECTED>' . $nume_categorie . '</option>';
		else
	   		print '<option value="' . $id_categorie . '">' . $nume_categorie . '</option>';
   }
   print '</select> <br />';
   ?>
    
	
   <label for="cbo_producator">Producator:</label><br>
   <?php
   $sir_prod = "SELECT * FROM producatori ORDER BY denumire_producator";
   $tabel_prod = mysqli_query($conectare, $sir_prod);
   $numar_prod = mysqli_num_rows($tabel_prod);
 
   print '<select name="cbo_producator">';
   print '<option value="0">Alegeti producatorul!</option>';
   for ($i=1; $i<=$numar_prod; $i++)
   {
   		$rand_prod = mysqli_fetch_array($tabel_prod);
		$id_producator_tabela = intval(trim($rand_prod["id_producator"]));
		$denumire_producator = ucfirst(trim($rand_prod["denumire_producator"]));
		
		if ($id_producator == $id_producator_tabela)
	   		print '<option value="' . $id_producator  . '" SELECTED>' . $denumire_producator  . '</option>';
		else
   		    print '<option value="' . $id_producator . '">' . $denumire_producator . '</option>';
   }
   print '</select> <br />';
   ?>
   
   
   <label for="ImagineProdus">Imagine produs:</label><br>
   <input type="file" id="txt_imagine" name="txt_imagine" /> <br />
   <input type="submit" name="btn_submit" value="Modificare produs" />
</form>

<?php
include("index_bottom.php");
?>
