<html>
<body>

<?php

$servername = "192.168.63.212";
$username = "php";
$password = "php";

$conn = new mysqli($servername, $username, $password);

if($conn-> connect_error) {
        die("Connection to Pi SQL Server Failed");
}

$query = "SELECT sample_date,temperature
		FROM temps.tempdata WHERE TIME(sample_date) LIKE '__:00:__' ORDER BY sample_date ASC;";

$result = $conn->query($query);


$data = array();

while($row = $result->fetch_assoc()){
//       echo "Time: ".$row["sample_date"]." - Temperature: ".$row["temperature"]."C";
  //      echo "<br>";

	$data[$row["sample_date"]] = $row["temperature"];
}


$conn->close();
?>

<br>
<script src="chart/Chart.min.js"></script>
<script>
var data = {
    labels: <?php
	echo "[";
		$i = 0;
		foreach($data as $dates=>$temps){
			if($i % 1 == 0){
				echo "\" $dates \" ,";
			}else{
				echo "\" \",";
			}
		$i++;
		}
		echo "]";
?>
,

    datasets: [
        {
            label: "Dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: <?php
		//Parse the PHP Array into Javascript
		echo "[";
		foreach($data as $temps){
			echo $temps;
			echo ",";
		}
		echo "]";?>
        }
    ]
};

value = "test";
var options = {

    scaleShowGridLines : true,
    scaleGridLineColor : "rgba(0,0,0,.05)",
    scaleGridLineWidth : 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: false,
    bezierCurve : true,
    bezierCurveTension : 0.4,
    pointDot : true,
    pointDotRadius : 2,
    pointDotStrokeWidth : 1,
    pointHitDetectionRadius : 20,
    datasetStroke : true,
    datasetStrokeWidth : 2,
    datasetFill : true,
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
};

</script>

<br>
<table align="center">
<th>Cupboard Temperature</th>
<tr><td>

<canvas align="center" id="countries" width="1200" height="400"></canvas>
<script>
var ctx = document.getElementById("countries").getContext("2d");
var myLineChart = new Chart(ctx).Line(data, options);
</script>

</td><tr>

<tr><td style="text-align:center">
<br>
Current Temperature:<?php echo end($data); ?>&degC
</td></tr>
</table>

</body>
</html>
