<?php
	session_start();
	// Get the DB connection info from the session
	if(isset($_SESSION["serverName"]) && isset($_SESSION["connectionOptions"])) {
		$serverName = $_SESSION["serverName"];
		$connectionOptions = $_SESSION["connectionOptions"];
	} else {
		// Session is not correctly set! Redirecting to start page
		session_unset();
		session_destroy();
		echo "Session is not correctly set! Clossing session and redirecting to start page in 3 seconds<br/>";
		die('<meta http-equiv="refresh" content="3; url=index.php" />');
		//header('Location: index.php');
		//die();
	}
?>


<html>
<head>
	<style>
		table th{background:grey}
		table tr:nth-child(odd){background:LightYellow}
		table tr:nth-child(even){background:LightGray}
	</style>
</head>
<body>
	<table cellSpacing=0 cellPadding=5 width="100%" border=0>
	<tr>
		<td vAlign=top width=170><img height=91 alt=UCY src="images/ucy.jpg" width=94>
			<h5>
				<a href="http://www.ucy.ac.cy/">University of Cyprus</a><BR/>
				<a href="http://www.cs.ucy.ac.cy/">Dept. of Computer Science</a>
			</h5>
		</td>
		<td vAlign=center align=middle><h2>Welcome to the EPL342 project test page</h2></td>
	</tr>
    </table>
	<hr>
  <h2>View Types</h2>

	<?php
	echo "Connecting to SQL server (" . $serverName . ")<br/>";
	echo "Database: " . $connectionOptions[Database] . ", SQL User: " . $connectionOptions[Uid] . "<br/>";
	//echo "Pass: " . $connectionOptions[PWD] . "<br/>";

	//Establishes the connection
	$conn = sqlsrv_connect($serverName, $connectionOptions);

	//Read Query

	$tsql=   "{ Call Q2ViewTypes()  }";



	echo "Executing query: " . $tsql . ") without any parameter<br/>";
	$getResults= sqlsrv_query($conn, $tsql);
	echo "Results:<br/>";
	if ($getResults == FALSE)
		die(FormatErrors(sqlsrv_errors()));

	PrintResultSet($getResults);

	/* Free query  resources. */
	sqlsrv_free_stmt($getResults);

	/* Free connection resources. */
	sqlsrv_close( $conn);

	/*
	function PrintResultSet ($resultSet) {
		while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
			$newRow = true;
			foreach($row as $col){
				if ($newRow) {
					$newRow = false;
					echo (is_null($col) ? "Null" : $col);
				} else {
					echo (", ".(is_null($col) ? "Null" : $col));
				}
			}
			echo("<br/>");
		}
		echo ("<table><tr><td>---</td></tr></table>");
	}
	*/

	function PrintResultSet ($resultSet) {
		echo ("<table><tr >");

		foreach( sqlsrv_field_metadata($resultSet) as $fieldMetadata ) {
			echo ("<th>");
			echo $fieldMetadata["Name"];
			echo ("</th>");
		}

		echo("<th>Edit</th>");
		echo("<th>Delete</th>");
		echo ("</tr>");


		while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
			echo ("<tr>");

			foreach($row as $col){

				echo ("<td>");
				echo (is_null($col) ? "Null" : $col);
				echo ("</td>");
			}
			//esu ta evales
   	$Title = $row['Title'];
		$Model= $row['Model_Of_Origin'];
		$User  = $row['User_entry'];
		$ID   = $row['TypeID'];

           	echo("<td><a href='q2_EditType.php?GetT=$Title&GetM=$Model&GetU=$User&GetID=$ID'>Edit</a></td>");//esu to evales
						echo("<td><a href='q2_DeleteType.php?&GetID=$ID'>Delete</a></td>");//esu to evales

		}
		echo ("</table>");
	}

	function FormatErrors( $errors ){
		/* Display errors. */
		echo "Error information: ";

		foreach ( $errors as $error )
		{
			echo "SQLSTATE: ".$error['SQLSTATE']."";
			echo "Code: ".$error['code']."";
			echo "Message: ".$error['message']."";
		}
	}

	?>
	<hr>
	<?php
		if(isset($_POST['disconnect'])) {
			echo "Clossing session and redirecting to start page";
			session_unset();
			session_destroy();
			die('<meta http-equiv="refresh" content="1; url=index.php" />');
		}
	?>

	<form method="post">
		<input type="submit" name="disconnect" value="Disconnect"/>
		<input type="submit" value="Menu" formaction="connect.php">
	</form>

</body>
</html>
