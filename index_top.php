<?php session_start(); ?>
<?php
$titlu_pagina = "Forma inregistrare utilizator";
include("indexfc.php");

?>

<!DOCTYPE html PUBLIC>
<html>
<head>
<title><?php print $titlu_pagina; ?></title>
<link rel="stylesheet" type="text/css" href="stil.css">
<link rel="stylesheet" type="text/css" href="stil_butoane.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="animated_favicon1.gif">
</head>


<body>
<?php
include("data_curenta.php");
?>

<table width="1000" height="200" align="center" bgcolor="#990000" background="img/antet.png">
<tr>
<td valign="bottom">
<h1 align="center"><?php print $titlu_pagina; ?></h1>
</td>
</tr>
</table>

<table width="1000" align="center" border="10" cellspacing="0" cellpadding="2">
  <tr>
    <td width="200" valign="top" align="center">
	  <br />
	  <h2>Sumar</h2> <br />
	  <a href="afisareproduse.php" class='buttons'> Produse </a> <br />
	  <br />
	  <a href="afisarecategorii.php" class='buttons'> Categorii </a> <br />
	  <br />
	  <a href="afisareproducatori.php" class='buttons'>Producatori </a> <br />
	  <br />
	  
	  <form action="afisareproduse.php" method="post" name="frm_cautare">
    <!-- Input area -->
    <label for="Speech Recognition">Speech Recognition</label><br />
    <input type="text" id="speechToText" name="speechToText" placeholder="Speak Something" onClick="record()" class='txt'>
    <!-- Output area -->
    <div id="output"></div>

    <!-- Below is the script for voice recognition and conversion to text-->
    <script>
        var recognition = new webkitSpeechRecognition();
        var voiceInput = ""; // Variable to store voice input

        recognition.lang = "ro-RO";

        recognition.onresult = function(event) {
            var transcript = event.results[0][0].transcript;
            document.getElementById('speechToText').value = transcript;

            // Update the variable with the latest voice input
            voiceInput = transcript;

            // Print the voice input in the 'output' div
            document.getElementById('output').innerHTML = "Voice Input: " + voiceInput;
        }

        function record() {
            recognition.start();
        }
    </script>
    <!-- end of script -->

<input type="submit" name="btn_submit" value="Cautare" class='buttons' />
</form>
     
	</td>
	 
    <td width="600" valign="top">
