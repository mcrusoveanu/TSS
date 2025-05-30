<?php
for ($i=0; $i<=5; $i++)
	$vf[$i] = "vf" . $i . ".jpg";
$vr = array("0", "7", "2", "4", "20", "6");

function is_email_valid($email)
{
	if (preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email))
		return TRUE;
	else
		return FALSE;
}


function is_text_valid($text)
{
	// daca textul primit contine vreo combinatie de caractere din vectorul black_words, returneaza false
	$black_words = array("<", "&lt;");
	$ok = 1;
	// caut daca in $value[j] exista vreun cuvant din vectoul $black_words
	// fiecare element din vectorul $black_words este trecut prin $word si analizat
	foreach ($black_words as $word)
		{
			$pozitie = -1;
			$pozitie = strpos(strtoupper($text), strtoupper($word));
			if ($pozitie > -1)
				$ok = 0;
		}
	return $ok;
}


function is_sir_sql_valid($text)
{
	// daca e sir gol, returneaza false
	if ($text == "")
		return FALSE;

	// daca textul primit contine vreo combinatie de caractere sin vectorul black_words, returneaza false
	$black_words = array("union", "href", "www", "http", "concat", "ifnu", "0x5E252421", "vibe","exec", "system", "shell_exec", "passthru");
	$ok = 1;
	// caut daca in $value[j] exista vreun cuvant din vectoul $black_words
	// fiecare element din vectorul $black_words este trecut prin $word si analizat
	foreach ($black_words as $word)
		{
			$pozitie = -1;
			$pozitie = strpos(strtoupper($text), strtoupper($word));
			if ($pozitie > -1)
				$ok = 0;
		}
	return $ok;
}


function out_car_ro($text)
{
  $text = str_replace("&#259;", "a", $text); // ã
  $text = str_replace("&#351;", "s", $text); // sh
  $text = str_replace("&#355;", "t", $text); // tz
  $text = str_replace("&#350;", "S", $text); // SH
  return $text;  
}


function formatare_text($text)
{
  $text = trim($text);
  // inlocuieste "ceva" cu "altceva" pentru a arata mai bine
  for ($i=1; $i<=5; $i++)
    {
	  $text = trim($text);
	  //inlocuire doua spatii cu unul singur
	  $text = str_replace("  ", " ", $text);
	  // introducere spatiu inainte/dupa paranteze rotunde
	  $text = str_replace("( ", "(", $text);
	  $text = str_replace(" )", ")", $text);
	  $text = str_replace("(", " (", $text);
	  $text = str_replace(")", ") ", $text);
	  // introducere spatiu dupa , si alte caractere
	  $text = str_replace(",", ", ", $text);
//	  $text = str_replace(":", ": ", $text);
	  $text = str_replace("!", "! ", $text);
//	  $text = str_replace("?", "? ", $text);
	  //eliminare spatiu inainte de , ; si altele
//	  $text = str_replace(" ;", ";", $text);
	  $text = str_replace(" ,", ",", $text);
	  $text = str_replace(" .", ".", $text);
//	  $text = str_replace(" :", ":", $text);
	  $text = str_replace(" !", "!", $text);
	  $text = str_replace(" ?", "?", $text);
	  $text = str_replace("http: ", "http:", $text);
	  //inlocuire doua spatii cu unul singur
	  $text = str_replace("  ", " ", $text);
	}
  return $text;
}


function formatare_telefon($telefon_primit)
{
  // Elimina toate caracterele nenumerice
  $telefon_formatat = "";
  for ($i = 0; $i <= strlen($telefon_primit)-1; $i++)
    if ("0" <= $telefon_primit[$i] && $telefon_primit[$i] <= "9")
      $telefon_formatat .= $telefon_primit[$i];  // print $$telefon_primit[$i] . " pe pozitia " . $i . "<br />";
  return $telefon_formatat;
}


function print_chenar($tip_mesaj, $text)
{
  $adresa_imagine="";
  switch($tip_mesaj)
	{
	  case "interzis": $adresa_imagine = "img/icon_interzis.gif"; break;
	  case "nusuntdate": $adresa_imagine = "img/icon_nusuntdate.gif"; break;
	  case "succes": $adresa_imagine = "img/icon_succes.gif"; break;
	  case "eroare": $adresa_imagine = "img/icon_eroare.gif"; break;
	}
  if ( !file_exists($adresa_imagine) )
	  $adresa_imagine = "img/icon_hotel.gif";
  
  print "<div align='center'>";
  print "<table border='0' cellspacing='0' cellpadding='2'>";
  print "  <tr>";
  print "    <td align='left'>";
  print "<img src='" . $adresa_imagine . "' alt='" . ucfirst($tip_mesaj) . "'> ";
  print "    </td>";
  print "    <td align='left'>";
  print "<strong>";
  print $text;
  print "</strong>";
  print "    </td>";
  print "  </tr>";
  print "</table>";
  print "</div>";
}


  $luna_litere = array("", "ianuarie", "februarie", "martie", "aprilie", "mai", "iunie", "iulie", "august", "septembrie", "octombrie", "noiembrie", "decembrie");

  $black_emails = array("beststudy@yahoo.com", "englezamoderna@yahoo.com", "englishhelfenoana@yahoo.com", "foreignlanguage@yahoo.com", "francezamoderna@yahoo.com", "oanab.8211@yahoo.com", "roxanaibanciu@yahoo.com", "rocsioana@yahoo.com", "roxybanciu@yahoo.com", "rusacontemporana@yahoo.com", "rusiapentruvoi@yahoo.com", "russian2all@yahoo.com", "ybanciu@yahoo.com", "yoanabanciu@yahoo.com", "engleza2u@yahoo.com", "roxanaioanabanciu@gmail.com", 
  "cmervin60@yahoo.com", "diploma2you@yahoo.com", "for.student@yahoo.com", "ionel_mail@yahoo.com", "ionel8mail@yahoo.com", "lic_enta@yahoo.com", "licenta4you@yahoo.com", "lucrari4you@yahoo.com", "tomadanut88@yahoo.com", "mariusmanta97@yahoo.com", "absolvent2009@yahoo.com", "raz_van_7@yahoo.com", "licenteoriginale@yahoo.com", 
  "promo_vat@yahoo.com");
  $black_tels = array("0722249028","0749594439", "0754494515","0762378792","0765843567","0765134426","0765134426","0756432178","0765231452","0742315674", "0766442146", "0754321786", "0765894326", "0765674521", "0766843517", "0765897321");
  $black_ips = array("213.93.138.115", "86.121.252.222", "95.76.211.143");
?>
