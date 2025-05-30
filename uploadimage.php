<?php
	  // Copiere imagine de pe hard in folderul site-ului
	  $adresa_imagine = "imagini/" . $id_produs . ".jpg";
	  print  $adresa_imagine;
	  
	  $result = NULL;
	  $result = move_uploaded_file($_FILES["txt_imagine"]["tmp_name"], $adresa_imagine);
	  $result = $result ? "true" : "false";
	  echo "<br />Imagine copiata: $result <br />";
	  // echo "Fisier copiat: $result <br />";
	  if ($result == "true")
		{
		  print "<hr color='#000000'>";
		  print "Adresa imagine: " . $adresa_imagine . "<br />";
		  
		  // redimensionare imagine la 800 pe latime, daca e mai mare de atat
		  list($latime_originala, $inaltime_originala, $image_type) = getimagesize($adresa_imagine);
		  $img = @imagecreatefromjpeg($adresa_imagine);
		  $latime_thumb = $latime_originala;
		  $inaltime_thumb = $inaltime_originala;
		  if ($latime_originala > 800)
			{
			  $aspect_ratio = 1;
			  if ($latime_originala > 0)
				$aspect_ratio = (float) $inaltime_originala / $latime_originala;
			  $latime_thumb = "800";
			  $inaltime_thumb = round($latime_thumb * $aspect_ratio);
			  
			  print "procent: " . $aspect_ratio . "<br />";
			  print "inaltime_thumb=" . $inaltime_thumb . "<br />";
			  print "latime_thumb=" . $latime_thumb . "<br />";
			  
			  $newImg = imagecreatetruecolor($latime_thumb, $inaltime_thumb);
			  imagecopyresampled($newImg, $img, 0, 0, 0, 0, $latime_thumb, $inaltime_thumb, $latime_originala, $inaltime_originala);
			  $redim = imagejpeg($newImg, $adresa_imagine);  // genereaza fisierul si il redenumeste (al doilea parametru e numele nou)
			  if ($redim)
			    print "Imaginea a fost redimensionata cu succes! <br />";
			  else
			    print "Eroare la redimensionarea imaginii! <br />";
			}
		  
		  print "inaltime_originala=" . $inaltime_originala . "<br />";
		  print "latime_originala=" . $latime_originala . "<br />";
		  
		  print "<a href='" . $adresa_imagine . "' target='_blank' title='" . $titlu_pagina . "'>";
		  print "<img src='" . $adresa_imagine . "' width='" . $latime_thumb . "' height='" . $inaltime_thumb . "'><br />";
		}
?>
