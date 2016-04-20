<html>
<head>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      google.load('visualization', '1.0', {'packages':['corechart','controls']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {

	var data = new google.visualization.arrayToDataTable( [ ['Available', Math.ceil(<?php system('bash /var/www/homepage/script.bash /dev/sdb1 --available');?>/1048576)],
		['Used', Math.ceil(<?php system('bash /var/www/homepage/script.bash /dev/sdb1 --used');?>/1048576)]
		], true);


	var options = {	'title':'WD Green',
                       'width':800,
                       'height':400,
			hAxis:{'format': '# GB'},
			'is3D':true
		};

        var chart = new google.visualization.PieChart(document.getElementById('pie_div'));
        chart.draw(data, options);

};
    </script>
</head>

<body>
<table align="center">
<tr>
<td>
	<div id="gauge_div"></div>
</td>
<td>

	<div id="pie_div"></div>

</td></tr>

</table>

</body>
</html>
