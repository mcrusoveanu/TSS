<?php
$titlu_pagina = "Forma inregistrare utilizator";
include("index_top.php");

?>

<form name="forma_inregistrare" action="register2.php" method="post">
<table>
<tr>
<td>Nume Utilizator 
</td>
<td>
<input name="username" type="text" class="txt"/>
</td>
</tr>

<tr>
<td>Parola Utilizator
</td>
<td>
<input name="parola" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Nume
</td>
<td>
<input name="nume" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Prenume
</td>
<td>
<input name="prenume" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Data Nastere
</td>
<td>
<input name="data_nastere" type="date" class="txt" />
</td>
</tr>

<tr>
<td>Adresa
</td>
<td>
<input name="adresa" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Oras
</td>
<td>
<select name="cbo_oras" class="txt">
<option value="0">[ Alegeti orasul ]</option>
<?php
include('conexiune.php');
$sir="select * from orase order by nume_oras";
$tabel= mysqli_query($conectare, $sir);
$nr=mysqli_num_rows($tabel); 
if($nr>0)
{
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysqli_fetch_array($tabel);
		$id_oras = $rand["id_oras"];
		$nume_oras = $rand["nume_oras"];
		print "<option value='" . $id_oras . "'>" . $nume_oras . "</option>";
	}
}
?>
</select>
</td>	
</tr>

<tr>
<td>Telefon
</td>
<td>
<input name="telefon" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Email
</td>
<td>
<input name="email" type="text" class="txt" />
</td>
</tr>

<tr>
<td>Raspuns
</td>
<td valign="top">
<?php
$x = rand(0,5);
print "<input type='hidden' name='x' value='" . $x . "' />";
print "<img src='img/" . $vf[$x] . "' alt='raspuns' width='40' class='txt' /> ";
?>
<input name="raspuns" type="text" size="13" class="txt" />
</td>
</tr>

<tr>
<td colspan="2">
<input name="submit" type="submit" value="Creare cont" class="buttons" />
<td>
</tr>
</table>

</form>


<?php
include("index_bottom.php");
?>
