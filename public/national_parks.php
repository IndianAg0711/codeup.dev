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
}	elseif (isset($_GET['name_d'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY name DESC');
	// header("Location: national_parks.php");
}	elseif (isset($_GET['location_d'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY location DESC');
	// header("Location: national_parks.php");
}	elseif (isset($_GET['date_established_d'])) {
	$database = $mysqli->query('SELECT * FROM national_parks ORDER BY date_established DESC');
	// header("Location: national_parks.php");
}	else {
	$database = $mysqli->query('SELECT * FROM national_parks');
}

?>
<html>
<head>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-latest.js"></script> 
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
	<title></title>
</head>
<body>
<h1 class="text-center">National Parks</h1>
<table class='table table-striped table-bordered tablesorter' id="myTable">
	<thead>
		<tr>
			<th>Name: <br><a href='?name'><span class="glyphicon glyphicon-sort-by-alphabet"></span></a>&nbsp;<a href='?name_d'><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a></th>
			<th>Location: <br><a href='?location'><span class="glyphicon glyphicon-sort-by-alphabet"></span></a>&nbsp;<a href='?location_d'><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a></th>
			<th>Description:</th>
			<th>Date Established: <br><a href='?date_established'><span class="glyphicon glyphicon-sort-by-alphabet"></span></a>&nbsp;<a href='?date_established_d'><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a></th>
			<th>Area (acres):</th>
		</tr>
	</thead>
	<tbody>
	<? while ($row = $database->fetch_assoc()) : ?>
		<tr>
			 <td> <?=$row['name'];?> </td>
			 <td> <?=$row['location'];?> </td>
			 <td> <?=$row['description'];?> </td>
			 <td> <?=$row['date_established'];?> </td>
			 <td> <?=$row['area_in_acres'];?> </td>
			
		</tr>
	<? endwhile; ?>
	</tbody>
</table>
<script type='text/javascript'>
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
);
</script>
		
</body>
</html>