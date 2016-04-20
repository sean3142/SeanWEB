<?php
//include 'dbConnect.php';
//include 'phpFunctions.php';
?>

<?php// printTable($cols, $data); ?>
<script src='chart/Chart.min.js'></script>
<table height="100%">
	<tr>
		<td><h3>Disk Usage - sda1</h3><td>
		<td>content</td>
	</tr>
	<tr>
	<td>


        <!-- pie chart canvas element -->
        <canvas id="countries" width="200" height="200"></canvas>

        <script>

            // pie chart data
            var pieData = [
                {
			label: "Available",
			value: <?php system('bash /var/www/html/script.bash /dev/sda1 --available');?>,
                   color:"#878BB6"
                },
                {
			label: "Used",
			value: <?php system('bash /var/www/html/script.bash /dev/sda1 --used');?>,
                    color : "#FFEA88"
                }
            ];

            var pieOptions = {
                 segmentShowStroke : false,
                 animateScale : true,
		animationSteps : 30,
		animateRotate : true,
		animationEasing : "easOutBounce"
            }
            // get pie chart canvas
            var countries= document.getElementById("countries").getContext("2d");
            // draw pie chart
            new Chart(countries).Pie(pieData, pieOptions);
</script>
	</td>
	<td>
	</td>
</tr>

</table>
