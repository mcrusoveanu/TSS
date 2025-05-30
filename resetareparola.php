<?php
include("index_top.php");
?>

<form name="forma_inregistrare" action="resetareparola2.php" method="post">
<table>


<tr>
<td>Email
</td>
<td>
<input name="email" type="text" />
</td>
</tr>

<tr>
<td>Parola Utilizator
</td>
<td>
<input name="parola" type="text" />
</td>
</tr>


<tr>
<td>Parola Noua Utilizator
</td>
<td>
<input name="parolanoua" type="text" />
</td>
</tr>

<tr>
<td>Confirmare Parola Noua Utilizator
</td>
<td>
<input name="parolanoua2" type="text" />
</td>
</tr>

<tr>
<td>
Resetare Parola
</td>
<td>
<input type="submit" name="Resetare" value="Resetare" />
</td>
</tr>



</table>

</form>


<?php
include("index_bottom.php");
?>
