<?php
$titlu_pagina = "Forma adaugare produs";
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

<form name="frm_adaugare_produs" method="post" action="produse_adaugare2.php" enctype="multipart/form-data">
	<label for="Denumire">*Denumire:</label><br>
	<input type="text" id="Denumire" name="Denumire"><br>
	
	<label for="Denumire">Descriere:</label><br>
	<input type="text" id="Descriere" name="Descriere"><br>
	
	<label for="Unitate_de_masura">Unitate de masura:</label><br>
	<input type="text" id="Unitate_de_masura" name="Unitate_de_masura"> <br>
	
	<label for="stoc_initial">Stoc initial:</label><br>
	<input type="number" id="stoc_initial" name="stoc_initial"> <br>
	
	<label for="Pret_unitar">*Pret unitar:</label><br>
	<input type="number" id="Pret_unitar" name="Pret_unitar"><br>
   

   <label for="cbo_categ">Categorie:</label><br>
   <?php
   include('conexiune.php');
   $sir_categ = "SELECT * FROM categorii ORDER BY nume_categorie";
   $tabel_categ = mysqli_query($conectare, $sir_categ);
   $numar_categ = mysqli_num_rows($tabel_categ);
   
   print '<select name="cbo_categ">';
   print '<option value="0">Alegeti categoria!</option>';
   for ($i=1; $i<=$numar_categ; $i++)
   {
   		$rand_categ = mysqli_fetch_array($tabel_categ);
		$id_categorie = intval(trim($rand_categ["id_categorie"]));
		$nume_categorie = ucfirst(trim($rand_categ["nume_categorie"]));
		
   		print '<option value="' . $id_categorie . '">' . $nume_categorie . '</option>';
   }
   print '</select> <br />';
   ?>
    
	
   <label for="cbo_producator">Producator:</label><br>
   <?php
   include('conexiune.php');
   $sir_prod = "SELECT * FROM producatori ORDER BY denumire_producator";
   $tabel_prod = mysqli_query($conectare, $sir_prod);
   $numar_prod = mysqli_num_rows($tabel_prod);
 
   print '<select name="cbo_producator">';
   print '<option value="0">Alegeti producatorul!</option>';
   for ($i=1; $i<=$numar_prod; $i++)
   {
   		$rand_prod = mysqli_fetch_array($tabel_prod);
		$id_producator = intval(trim($rand_prod["id_producator"]));
		$denumire_producator = ucfirst(trim($rand_prod["denumire_producator"]));
		
   		print '<option value="' . $id_producator . '">' . $denumire_producator . '</option>';
   }
   print '</select> <br />';
   ?>
   
   
   <label for="ImagineProdus">Imagine produs:</label><br>
   <input type="file" id="txt_imagine" name="txt_imagine" /> <br />
   <input type="submit" name="btn_submit" value="Adaugare produs" />
</form>

<?php
include("index_bottom.php");
?>
