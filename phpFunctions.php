<?php

function printTable($showCols, $selectData){

echo "<table>";

// PRINT THE COLUMN NAMES

echo "<tr>";
while($col_names = $showCols->fetch_array()){
	echo "<th>" . $col_names[0] . "</th>";
}

echo "</tr>";

//PRINT THE DATA
	while($array = $selectData->fetch_array()){
		echo "<tr>";
		for($i = 0; $i < $selectData->num_rows -1; $i++){
			echo "<td>";
			echo $array[$i];
			echo "</td>";
		}
		echo "</tr>";
	}

echo "</table>";
}
?>
