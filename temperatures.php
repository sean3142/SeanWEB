<script src="chart/Chart.js"></script>

<?php

$servername = "192.168.63.212";
$username = "php";
$password = "php";

$conn = new mysqli($servername, $username, $password);

if($conn-> connect_error) {
	die("Connection to Pi SQL Server FAiled");
}


echo "Connection to Pi SQL Server Succeeded";

$query = "SELECT sample_date,temperature FROM temps.tempdata";

$result = $conn->query($query);

while($row = $result->fetch_assoc()){
	echo "Time: ".$row["sample_date"]." - Temperature: ".$row["temperature"]."C";
	echo "<br>";
}
$conn->close();
?>

<script>
var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};
var myLineChart = new Chart(ctx).Line(data, options);
</script>
