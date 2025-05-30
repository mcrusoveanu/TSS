<?php
$conectare=mysqli_connect("localhost","root","","magazin");
if($conectare==false)
{
echo "conectarea nu a reusit";
include("index_bottom.php");
die();
}
?>