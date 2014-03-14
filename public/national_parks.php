<?php

// Get new instance of MySQLi object
$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

// Get new instance of MySQL_result according to $_GET request
if (isset($_GET['name'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY name ASC');
	// header("Location: national_parks.php");
}	elseif (isset($_GET['location'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY location ASC');
	// header("Location: national_parks.php");
}	elseif (isset($_GET['date_established'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY date_established ASC');
	// header("Location: national_parks.php");
}	else {
	$database = $mysqli->query('SELECT * FROM national_parks');
}

// Use print_r() to show rows using MYSQLI_ASSOC
// while ($row = $database->fetch_assoc()) {
//     print_r($row);
// }

?>
<html>
<head>
	<title></title>
</head>
<body>
<h1>National Parks</h1>
<p>Change order by: &nbsp;
<a href='?name'>Name</a>&nbsp;<a href='?location'>Location</a>&nbsp;<a href='?date_established'>Date Established</a>
</p>
<table>
	<tr>
		<th></th><th>Name:</th><th>Location:</th><th>Description:</th><th>Date Established</th><th>Area in Acres</th>
	</tr>
	<? while ($row = $database->fetch_assoc()) : ?>
	<tr>
		<? foreach ($row as $datum) : ?>
		<td>
			<?= $datum; ?>
		</td>
		<? endforeach; ?>
	</tr>
	<? endwhile; ?>
</table>
		
</body>
</html>