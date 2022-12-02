
<?php
session_start();
	if (isset($_POST['con'])) {
		echo "<br/>Setting session variables!<br/>";
		// collect value of input field
		$name = $_POST['Username'];
		$pas = $_POST['Password'];


		if (empty($name)) echo "name is empty!<br/>";
		if (empty($pas)) echo "password is empty!<br/>";

		if (!(empty($name) || empty($pas))) {
			// Set session variables
			$_SESSION["name"] = $name;
			$_SESSION["pas"] = $pas;
		} else {
			session_unset();
			session_destroy();
			echo "<br/>Cannot setup the session variables! Redirecting back in 5 seconds<br/>";
			die('<meta http-equiv="refresh" content="5; url=index.php" />');
		}
	}
	echo $_SESSION["name"];
	echo $_SESSION["pas"] ;
?>

<!DOCTYPE html>
<html>
  <body>
  	<table cellSpacing=0 cellPadding=5 width="100%" border=0>
  	<tr>
  		<td vAlign=top width=170><img height=91 alt=UCY src="download.png" width=94>
  			<h5>
  				<a href="http://www.ucy.ac.cy/">University of Cyprus</a><BR/>
  				<a href="http://www.cs.ucy.ac.cy/">Dept. of Computer Science</a>
  			</h5>
  		</td>
  		<td vAlign=center align=middle><h2>Welcome to the EPL342 project test page</h2></td>
  	</tr>
      </table>
  	<hr>

	  <a href="q1_InsertUser.php">Query 1 (Insert User)</a><br>
  	<a href="q1_ViewUsers.php">Query 1 (View Users)</a><br>
		<a href="q2_InsertType.php">Query 2 (Insert Type)</a><br>
		<a href="q2_ViewTypes.php">Query 2 (View Types)</a><br>
  	<a href="q4.php">Query 4 </a><br>
  	<a href="q5.php">Query 5 </a><br>
  	<a href="q6.php">Query 6 </a><br>
  	<a href="q7.php">Query 7 </a><br>
  	<a href="q8.php">Query 8 </a><br>
  	<a href="q9.php">Query 9 </a><br>
  	<a href="q10.php">Query 10 </a><br>
  	<a href="q11.php">Query 11 </a><br>
  	<a href="q12.php">Query 12 </a><br><br>
  	<a>Query 13 </a>
	  <form action="q13.php" method="post">
  		</a>(Finding common object types)<br>
  		Parameter: <input type="text" name="fingerprint_q13" placeholder = "FINGERPRINT">
  		<input type="submit" name="Query 13">
  	</form><br>
  	<a>Query 14</a>
	  <form action="q14.php" method="post">
  		</a> (Finding the k object types with the fewest participants)<br>
  		Parameter: <input type="number" name="k_q14" placeholder = "NUMBER K">
  		<input type="submit" name="Query 14">
  	</form><br>
  	<a href="q15.php">Query 15 </a><br><br>
  	<a>Query 16 </a>
	  <form action="q16.php" method="post">
  		</a>(Find multiple objects within a bounding box)<br>
  		Parameter: <input type="text" name="type_q16" placeholder = "TYPE">
		Parameter: <input type="number" name="x1_q16" placeholder = "X1">
		Parameter: <input type="number" name="x2_q16" placeholder = "X2">
		Parameter: <input type="number" name="y1_q16" placeholder = "Y1">
		Parameter: <input type="number" name="y2_q16" placeholder = "Y2">
  		<input type="submit" name="Query 16">
  	</form><br>
  	<a href="q17.php">Query 17 </a><br><br>
  	<a>Query 18 </a>
	  <form action="q18.php" method="post">
  		</a>(Find nearest (Nearest Neighbor - NN) POI ( Point Of Interest))<br>
		Parameter: <input type="number" name="x_q18" placeholder = "X">
		Parameter: <input type="number" name="y_q18" placeholder = "Y">
		Parameter: <input type="number" name="floor_number_q18" placeholder = "Floor Number">
  		<input type="submit" name="Query 18">
		  </form><br><br>
  	<a>Query 19 </a><br>
	  <form action="q19.php" method="post">
  		</a>(Find k nearest (k Nearest Neighbor - kNN) POIs ( Points of Interest ))<br>
		Parameter: <input type="number" name="k_q19" placeholder = "NUMBER K">
		Parameter: <input type="number" name="x_q19" placeholder = "X">
		Parameter: <input type="number" name="y_q19" placeholder = "Y">
		Parameter: <input type="number" name="floor_number_q19" placeholder = "Floor Number">
  		<input type="submit" name="Query 19">
		  </form><br><br>
  	<a>Query 20 </a><br>
	  <form action="q20.php" method="post">
  		</a>(Find all k nearest (All k Nearest Neighbor - AkNN) POIs of one floor)<br>
		Parameter: <input type="number" name="k_q20" placeholder = "NUMBER K">
		Parameter: <input type="number" name="floor_number_q20" placeholder = "Floor Number">
  		<input type="submit" name="Query 20">
		  </form><br>
  	<a href="q21.php">Query 21 </a><br>


  	<hr>
  	<?php
  		if(isset($_POST['disconnect'])) {
  			echo "Clossing session and redirecting to start page";
  			session_unset();
  			session_destroy();
  			die('<meta http-equiv="refresh" content="2; url=index.php" />');
  		}
  	?>

  	<form method="post">
  		<input type="submit" name="disconnect" value="Disconnect"/>
  	</form>

  </body>
  </html>
