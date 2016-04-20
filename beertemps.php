<html><head>
<title>Beer</title>

<?php	//Query the Database, populate $data array
$servername = "192.168.63.212"; $username = "sean"; $password = "engIntranet:234";
$conn = new mysqli($servername, $username, $password,"tempdb");
if($conn->connect_error) {die("Connection to Pi SQL Server Failed Error: $conn->connect_error");}

$query = "SELECT
	sample_year,
	sample_month,
	sample_day,
	sample_hour,
	sample_min,
	TC_1
	FROM tempdb.tempdata
	ORDER BY sample_year DESC,
	sample_month DESC,
	sample_day DESC,
	sample_hour DESC,
	sample_min DESC
	LIMIT 1008;
	";

if(!$result = $conn->query($query)) {die("Query to Database failed with error: $conn->error");}

$table = array();
while($row = $result->fetch_assoc()){
	$table[] = $row;
}

$conn->close();
?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      google.load('visualization', '1.0', {'packages':['corechart', 'gauge', 'controls']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {

	var data = new google.visualization.arrayToDataTable( [ ['Sample Date', 'Ambient', 'Set Point'],
		<?php
	foreach( $table as $rowi=>$row){
		echo "[new Date(" . $row['sample_year'] . "," .
			$row['sample_month'] . "-1 ," .
			$row['sample_day'] . "," .
			$row['sample_hour'] . "," .
			$row['sample_min'] .
			")," . $row['TC_1'] . ", 20.0" . "],";
		}?>], false);

	// Dashboard
	var dash = new google.visualization.Dashboard(document.getElementById('dash_div'));

	var options = {	'title':'Temperatures',
                       'width':800,
                       'height':400
		};

        var dateRangeSlider = new google.visualization.ControlWrapper({
			'controlType': 'DateRangeFilter',
			'containerId': 'slider_div',
				'options': {
					'filterColumnLabel': 'Sample Date',
					'ui': {	'chartType' : 'LineChart',
						'step': 'hour',
						'format': 'format:{pattern: "dd mm hh:MM"}'
					}
				}
			});

        var chart = new google.visualization.ChartWrapper({
		'chartType': 'LineChart',
		'containerId': 'chart_div',
		'options': {
			'title':'Beer Temperature',
                       'width':1200,
                       'height':600
		}	});

	dash.bind(dateRangeSlider,chart)
	dash.draw(data);

	// Guage
        var gauge_data = new google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['TC_1', <?php echo $table[0]['TC_1']; ?> ]
        ]);

        var gauge_options = {
          width: 400, height: 120, redFrom: 28, redTo: 32,
          yellowFrom:24, yellowTo: 28, greenFrom:18, greenTo:24,
	    minorTicks: 2, min: 10, max: 32
        };

        var gaugechart = new google.visualization.Gauge(document.getElementById('gauge_div'));
        gaugechart.draw(gauge_data, gauge_options);

};



    </script>
</head>

<body>
<script>
var d = new Date(2015, 7, 2, 22, 10, 9, 2);
document.getElementById("demo").innerHTML = "wanker";
</script>
<p id="demo">hello</p>

<table align="center">
<tr>
<td>
	<div id="gauge_div"></div>
</td>
<td>
    <div id="dash_div">

	<div id="chart_div"></div>
	<div id="slider_div"></div>

	</div>

</td></tr>

</table>
</body>
</html>
