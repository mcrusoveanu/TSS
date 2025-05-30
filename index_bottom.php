	</td>
    <td width="200" valign="top" align="center">
	  <?php
	    if (isset($_SESSION["id"]) == true)
		{
		  print $_SESSION["prenume"] . " " . $_SESSION["nume"] . "<br />";
		  print "<br/>";
		  print "<a href='cos_cumparaturi.php' class='buttons'>Cos cumparaturi</a>";
		  print "<br/>";
		  print "<br/>";
		  print "<a href='logout.php' class='buttons'>Logout</a>";
		  print "<br/>";
		
			if (intval($_SESSION["tip_utilizator"]) == 1)
			{
			 
			  print"<br/>";
			  print "<strong>Meniu Administrator</strong>";
			  print "<br>";
			  print "<br>";
			  print "<a href='produse_adaugare1.php' class='buttons'>Adauga produs</a>";
			  print "<br>";
			  print "<br/>";
			  print "<a href='producator_adaugare1.php' class='buttons'>Adauga producator</a>";
			  print "<br/>";
			  print "<br/>";
			  print "<a href='categorie_adaugare1.php' class='buttons'>Adauga categorie</a>";
			  print"<br/>";
			}
		}
		else
		{
	  ?>
		<form action="login2.php" name="forma_logare" method="post">
			<table>
			<tr>
			    <td>
				 Username
			    </td>
			    <td>
				  <input type="text" name="username"  placeholder="username" />
			   </td>
			</tr>
			<tr>
				<td>
				Parola
			   </td>
			    <td>
				<input type="password" name="parola" placeholder="parola" />
			   </td>
			</tr>
			<tr>
				<td>
				Login
			   </td>
			    <td>
				<input type="submit" name="submit" value="Login" />
			   </td>
			</tr>
			</table>
		</form>
		
		<a href="register1.php" class='buttons'>Creare cont</a><br />
		<a href="resetareparola.php" class='buttons'>Resetare parola</a><br />
		
		<?php
		  }  // de la else
		?>
		
	</td>
  </tr>
  
  <table align="center" width="1000" border="0" background="img/bottom.png">
  <tr>
    <td>
	  <div align="center">
	  <br>
	    <br>
	  
	    <h5>&copy; Magazin "La olteni" 2024 - <?php print $data_curenta; ?></h5>	  </div>
	</td>
  </tr>
</table>
 
</table>

</body>
</html>
