<?php
$titlu_pagina = "Gestiune Produse1";
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


<form name="frm_adaugare_produs" method="post" action="gestiuneproduse2.php" enctype="multipart/form-data">
   <br>
   <label for="lbl_produs">Produs:</label><br>
   <?php
   include('conexiune.php');
   $sir_produs = "SELECT * FROM produse ORDER BY denumire";
   $tabel_produs = mysqli_query($conectare, $sir_produs);
   $numar_produs = mysqli_num_rows($tabel_produs);
 
   print '<select name="cbo_produs">';
   print '<option value="0">Alegeti produsul!</option>';
   for ($i=1; $i<=$numar_produs; $i++)
   {
   		$rand_produs = mysqli_fetch_array($tabel_produs);
		$id_produs = intval(trim($rand_produs["id_produs"]));
		$denumire_produs = ucfirst(trim($rand_produs["denumire"]));
   		print '<option value="' . $id_produs. '">' . $denumire_produs . '</option>';
   }
   print '</select> <br />';
   print ' <br />';
   ?>
   <label for="_cantitate_stoc_adugata">Cantitate:</label><br>
	<input type="number" id="cantitate_stoc_adugata" name="cantitate_stoc_adugata"> <br>
	  <br />
	<input type="submit" name="btn_submit" value="Adaugare in stoc" />
   
</form>


<?php
include("index_bottom.php");
?>
