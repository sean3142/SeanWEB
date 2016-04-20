<html><head>
<title>Climate</title>
<?php require_once "library.php"; ?>
</head>
<body>
<?php
	$dbc = new db_conn();
	$devices = new devs($dbc);
	echo '<form action="climate.php" method="get">';
		dropdown($devices->dev_id);
	echo '</form>';
?>
<table>
<tr>
<?php
	if($_GET && $_GET['selDevice'] == "28-0414705dcaff"){
		$samples = new trend($_GET['selDevice'], $dbc);
		if(isset($samples)){
			foreach ( $samples->values as $i=>$value ){
				echo "<tr><td>" . $i . "</td><td>" . $value . "</td></tr>";
			}   
		}
		}else{
			echo '<p class="warning"> Something went wrong </p>';
	}

/*
	foreach ( $devices->dev_id as $d ){
		echo "<td><a>" . $d . "</a></td>";
	}   
*/
?>
</tr>
</table>

<table>
<tr>
<?php
?>
</tr>
</table>
</body>
</html>
