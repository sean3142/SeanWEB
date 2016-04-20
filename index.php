<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<title>Sean Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script>

function changeContent(srcSelect){
	var x = document.getElementById("centreContent");
	switch(srcSelect){
		case 0:
			x.src="http://192.168.63.159:9091";
			break;
		case 1:
			x.src="drive.php";  //DOUBLE GET REQUEST!!!
			break;
		case 2:
			x.src="https://www.google.com/calendar/embed?src=sean.smith3142%40gmail.com&ctz=Europe/London";
			break;
		case 3:
			x.src="beertemps.php";
			break;
		default:
			x.src="404.php";
		}
}
</script>

<table class="center" width="100%" height="100%">

<tr>
	<th colspan="3" align="center">
		<iframe src="http://duckduckgo.com/search.html?prefill=Find that shit&focus=yes" style="overflow:hidden;margin:0;padding:0;width:408px;height:40px;" frameborder="0"></iframe>
	</th>
</tr>

<tr>

	<!-- BUTTON SIDEBAR -->
	<td rowspan="2" class="vertical-align">
		<p><button type="button" onclick="changeContent(0)">Transmission</button></p>
		<p><button type="button" onclick="changeContent(1)">Drive Status</button></p>
		<p><button type="button" onclick="changeContent(2)">Calendar</button></p>
		<p><button type="button" onclick="changeContent(3)">Temperatures</button></p>
	</td>
	<!-- END BUTTON SIDEBAR -->

<td>Link Placeholder</td>

	<!-- BOOKMARKS SIDEBAR -->

	<td rowspan="2" class="vertical-align">

	<?php require 'links/links.html' ?>

	<!-- ******************* -->
	</td>
</tr>

<tr>
	<td>
		<iframe id="centreContent" frameborder="0" scrolling="yes"></iframe>
	</td>
</tr>
<table>
</body>
</html>
