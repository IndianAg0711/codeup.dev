<?php
var_dump($_POST);

$address_book = array();

function save_csv($array) {
	$handle = fopen("address_book_data.csv", 'w');
	foreach ($array as $fields) {
		fputcsv($handle, $fields);
	}
	fclose($handle);
}

if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
	$new_address = array($_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['phone']);
	array_push($address_book, $new_address);
	save_csv($address_book);
} else {
	echo "ERROR. Please fill out all of the required fields before submitting.";
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
</head>

<body>
	<h1>Address Book:</h1>
	<table>
		<tr>
			<th>Name:</th><th>Address:</th><th>City:</th><th>State:</th><th>Zip:</th><th>Phone Number:</th>
		</tr>
		<? foreach ($address_book as $address) : ?>
			<tr>
				<? foreach ($address as $datum) : ?>
					<td> <?= htmlspecialchars(strip_tags($datum)); ?> </td>
				<? endforeach; ?>
			</tr>
		<? endforeach ?>
	</table>
	
	<h1>Add yourself to the list?</h1>
	<form method="POST" action="">
		<p>
			<label for="name">Full Name:</label>
			<input id="name" name="name" type="text">
		</p>
		<p>
			<label for="address">Address:</label>
			<input id="address" name="address" type="text">
		</p>
		<p>
			<label for="city">City:</label>
			<input id="city" name="city" type="text">
		</p>
		<p>
			<label for="state">State:</label>
			<input id="state" name="state" type="text">
		</p>
		<p>
			<label for="zip">Zip Code:</label>
			<input id="zip" name="zip" type="text">
		</p>
		<p>
			<label for="phone">Phone #:</label>
			<input id="phone" name="phone" type="text">
		</p>
		<p>
			<button type="submit">Add</button>
		</p>
	</form>
</body>