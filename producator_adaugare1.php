<?php
$titlu_pagina = "Forma adaugare producator";
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

<form name="frm_adaugare_producator" method="post" action="producator_adaugare2.php" enctype="multipart/form-data">
	<label for="denumire_producator">*Denumire producator:</label><br>
	<input type="text" id="denumire_producator" name="denumire_producator"><br>
	
	<label for="adresa">Adresa:</label><br>
	<input type="text" id="adresa" name="adresa"><br>
		
 <label for="cbo_oras">Oras:</label><br>
   <?php
   include('conexiune.php');
   $sir_oras = "SELECT * FROM orase ORDER BY nume_oras";
   $tabel_oras = mysqli_query($conectare, $sir_oras);
   $numar_oras = mysqli_num_rows($tabel_oras);
   
   print '<select name="cbo_oras">';
   print '<option value="0">Alegeti Orasul!</option>';
   for ($i=1; $i<=$numar_oras; $i++)
   {
   		$rand_oras = mysqli_fetch_array($tabel_oras);
		$id_oras = intval(trim($rand_oras["id_oras"]));
		$nume_oras = ucfirst(trim($rand_oras["nume_oras"]));
		
   		print '<option value="' . $id_oras . '">' . $nume_oras . '</option>';
   }
   print '</select> <br />';
   ?>
	
	<label for="ordine_afisare">Ordine afisare:</label><br>
	<input type="number" id="ordine_afisare" name="ordine_afisare"> <br>
    <input type="submit" name="btn_submit" value="Adaugare producator" />
</form>

<?php
include("index_bottom.php");
?>
