
<?php
$titlu_pagina = "Deconectare produs";
include("index_top.php");
?>

<?php

$verificare = session_destroy();

if($verificare)
{
	print 'Logout cu succes';
}

?>

<?php
include("index_bottom.php");
?>
