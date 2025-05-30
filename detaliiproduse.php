<?php
$titlu_pagina = "Detalii produs";
include("index_top.php");
?>

<?php


// preluare id produs
if (isset($_GET["id"]) == false)
{
	print "Nu ati ales niciun produs! <br />";
	include("index_bottom.php");
	die();
}



$id_produs_primit = intval($_GET["id"]);

// conectare la baza de date
include('conexiune.php');
$sir="SELECT * FROM produse INNER JOIN producatori ON producatori.id_producator=produse.id_producator 
		INNER JOIN categorii on produse.id_categorie = categorii.id_categorie
	WHERE id_produs=" . $id_produs_primit . " LIMIT 0,1";
print $sir;
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	$rand = mysqli_fetch_array($tabel);
	$id_produs = intval($rand["id_produs"]);
	$denumire_produs = ucfirst(trim($rand["denumire"]));
	$descriere=ucfirst(trim($rand["descriere"]));
	$stoc_actual=ucfirst(trim($rand["stoc_actual"]));
	$pret_unitar=ucfirst(trim($rand["pret_unitar"]));
	$denumire_producator=ucfirst(trim($rand["denumire_producator"]));
	
	$adresa_imagine = "imagini/" . $id_produs . ".jpg";
	
	
	print '<h2 align=center>' . $denumire_produs .  '</h2>';
	
	print "<div align='center'>";
	print "<a href='" . $adresa_imagine . "' target='_blank'>";
	print "<img src='" . $adresa_imagine . "' alt='" . $denumire_produs . "'>";
	print "</a></p>";
	
	print '<h2 align=center>' . $descriere . '</h2>';
	print '<h2 align=center>' . $stoc_actual. ' bucati </h2>';
	print '<h2 align=center>' . $pret_unitar . ' pret unitar </h2>';
	print '<h2 align=center>' . $denumire_producator. ' producator </h2>';
	
	
	if (isset($_SESSION["id"]) == false)
	{
		print "Nu sunteti autentificat";
	}
	else
	{
		// forma adaugare produs in cos
	    ?>
		  <form action="adaugare_produse_cos_cumparaturi.php" method="post">
		  <input type="hidden" name="idprod" value="<?php print $id_produs; ?>" />
		  <input type="hidden" name="pret" value="<?php print $pret_unitar; ?>" />
		  Cantitate comandata: 
		  <input type ="number" name="cantitate" value=1 />       		
           <input type="submit" value="Adaugare in cos" />
		  </form>
		 
		<?php
	}
}
?>


<?php
include("index_bottom.php");
?>
