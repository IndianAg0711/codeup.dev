<?php
//var_dump($_POST);
//var_dump($_GET);

// Save as .csv function
function save_csv($array) {
	$handle = fopen("address_book_data.csv", 'w');
	foreach ($array as $fields) {
		fputcsv($handle, $fields);
	}
	fclose($handle);
}

// Open address book
function open_csv($filename) {
	$address_book = [];
	$handle = fopen($filename, 'r');
	while (($data = fgetcsv($handle)) !== false) {
		$address_book[] = $data;
	}
	fclose($handle);
	return $address_book;
}

$address_book = open_csv('address_book_data.csv');

// Validating all required fields have inputs
if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
	$new_address = array($_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['phone']);
	array_push($address_book, $new_address);
	save_csv($address_book);
}
// Fresh page loads won't display error
else if (empty($_POST)) {
} 
// Show error when all required fields aren't populated
else {
	$error = true;
}

// Removing an item
if (isset($_GET['remove'])) {
   	$item_to_remove = $_GET['remove'];
   	unset($address_book[$item_to_remove]);
   
   	// Save file
   	save_csv($address_book);
	//header("Location: address_book.php");
}

print_r($address_book);
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
		<? foreach ($address_book as $key => $address) : ?>
			<tr>
				<? foreach ($address as $datum) : ?>
					<td> <?= htmlspecialchars(strip_tags($datum)); ?> </td>
				<? endforeach; ?>
				<td><a href='?remove=<?=$key;?>'>Delete</a></td>
			</tr>
		<? endforeach ?>
	</table>
	
	<h1>Add yourself to the list?</h1>
	<form method="POST" action="">
		<p>
			<label for="name">Full Name:</label>
			<input id="name" name="name" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['name'])) : ''; ?>"> *
		</p>
		<p>
			<label for="address">Address:</label>
			<input id="address" name="address" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['address'])) : ''; ?>"> *
		</p>
		<p>
			<label for="city">City:</label>
			<input id="city" name="city" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['city'])) : ''; ?>"> *
		</p>
		<p>
			<label for="state">State:</label>
			<input id="state" name="state" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['state'])) : ''; ?>"> *
		</p>
		<p>
			<label for="zip">Zip Code:</label>
			<input id="zip" name="zip" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['zip'])) : ''; ?>"> *
		</p>
		<p>
			<label for="phone">Phone #:</label>
			<input id="phone" name="phone" type="text" value= "<?= isset($error) ? htmlspecialchars(strip_tags($_POST['phone'])) : ''; ?>">
		</p>
		<p>
			* <em>Required field</em>
		</p>
		<?php
		if (isset($error)) {
			echo "<p>ERROR. Please fill out all of the required fields before submitting.</p>";
		}
		?>
		<p>
			<button type="submit">Add</button>
		</p>
	</form>
</body>