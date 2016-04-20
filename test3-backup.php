<html>
<head>
</head>
<?php	//Query the Database, populate $data array
$servername = "192.168.63.212"; $username = "php"; $password = "php";
$conn = new mysqli($servername, $username, $password);
if($conn-> connect_error) {die("Connection to Pi SQL Server Failed");}


$query = "(SELECT sample_date,temperature FROM temps.tempdata) ORDER BY sample_date ASC;";
$result = $conn->query($query);

$query="SELECT STD(temperature) FROM temps.tempdata;";
$st_deviation=$conn->query($query);

$data = array();

while($row = $result->fetch_assoc()){
	$rawdata[$row["sample_date"]] = $row["temperature"];
}

$temperature = array();
$label = array();
foreach( $rawdata as $key=>$value){
	$temperature[] = $value;
	$sample_date[] = $key;
}

$conn->close();
?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart', 'gauge']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);


      function drawChart() {
/*
	var data = new google.visualization.arrayToDataTable( [ ['Sample Date', 'Temperature'],
		<?php
			foreach($rawdata as $date=>$temp){
				echo "['$date', $temp],";
			}?>
			],false);
*/
/* 	      var options = {'title':'Cupboard Temperature',
                       'width':1200,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
*/
        var gauge_data = new google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Temperature', <?php echo end($rawdata); ?> ]
        ]);

        var gauge_options = {
          width: 400, height: 120, redFrom: 30, redTo: 34,
          yellowFrom:26, yellowTo: 30, greenFrom:21, greenTo:26,
	    minorTicks: 2, min: 10, max: 34
        };

        var gaugechart = new google.visualization.Gauge(document.getElementById('gauge_div'));

        gaugechart.draw(gauge_data, gauge_options);

};
    </script>

<body>
<table style="text-align:center">
<th>Cupboard Temperature (last 24-Hours)</th>

<tr><td>
<?php echo end($rawdata); echo $st_deviation; ?>
</td></tr>

<tr><td>
    <div id="chart_div" style="width: 600px; height: 160px;"></div>
</td></tr>

<tr><td>
    <div id="gauge_div" style="width: 600px; height: 160px;"></div>
</td></tr>

</table>

</body>
</html>
