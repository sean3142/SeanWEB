<!DOCTYPE html>
<html><head>
<title>Climate</title>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.1.1/dygraph-combined.js"></script>
<?php require_once "libsql.php"; ?>
<?php require_once "libhtml.php"; ?>
</head>
<body>
<?php
	$dbc = new db_conn();  			// Open Database connection
	$devices = new devs($dbc);		// Query Device List
/*
	echo '<form action="climate.php" method="get">';
	$devicelist = new htmlSelect();
	$devicelist->name = "DeviceList";

	$devicelist->list = $devices->dev_id;
	$devicelist->build();
	echo $devicelist->string;
	
	echo '<form action="climate.php" method="get">';
	$devicelist2 = new htmlCheckbox();
	$devicelist2->name = "DeviceList2";

	$devicelist->list = $devices->dev_id;
	$devicelist->build();	:q
	
	$Duration = new htmlSelect();
	$Duration->list = array('one', 'two', 'three');
	$Duration->name = "duration";
	$Duration->build();
	echo $Duration->string;
*/
echo '<br/>';


//	$period = new htmlSelect();
//	$period->name = "period";
//	$period->list = range(1,31);
//	$period->build();
//	echo $period->string;
//	$per = $_GET['period'];
	
	$dev_selected = array();
	foreach($devices->dev_id as $d){
		if(isset($_GET[$d])){
			$dev_selected[]=$d;
		}
	}
	$samples = new trend($dev_selected, $dbc, 7);
	if(isset($samples->values)){
	}   
?>	

<table border="1">
<tr><td colspan="2"><h1>Temperature</h1></td></tr>
	<tr><td>
<?php
	$obj = new htmlCheckbox();
	$obj->list = $devices->dev_id;
	$obj->name = "DeviceList3";
	$obj->action = 'climate.php';
	$obj->build();
	echo $obj->string;
?>
</td>
<td><div id="graph" ></div></td></tr>
</table>
<script type="text/javascript">
	// TODO catch no data in $samples->values array
	g = new Dygraph(document.getElementById("graph"),<?php echo jsArray($samples->values); ?>,{showRoller: true, ylabel: 'Temperature (C)' });
</script>
</body>
</html>
