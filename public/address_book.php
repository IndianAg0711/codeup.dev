<?php
//var_dump($_POST);
//var_dump($_GET);
//var_dump($_FILES);

// Including Class from another file
include('address_data_store.php');

$csv = new AddressDataStore();

$address_book = $csv->read_address_book();

// Checking for uploaded files
if (count($_FILES) > 0 && $_FILES['uploaded_file']['error'] == 0) {
	if ($_FILES['uploaded_file']['type'] == 'text/csv') {

		// Upload file
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$uploaded_filename = basename($_FILES['uploaded_file']['name']);
		$saved_filename = $upload_dir . $uploaded_filename;
		move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $saved_filename);

		// Open uploaded file
		$upload = new AddressDataStore($saved_filename);
		$imported_address_book = $upload->read_address_book();

		// Overwrite existing list checkbox option
		if (isset($_POST['overwrite']) && $_POST['overwrite'] == 1) {
				$address_book = $imported_address_book;
				$csv->write_address_book($address_book);
		} else {

				// Append list and Save
				$address_book = array_merge($address_book, $imported_address_book);
				$csv->write_address_book($address_book);
		}

	}	else {
			echo "<p>Error: Uploaded files must be .csv!</p>";
	}	
}

// Validating all required fields have inputs
if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
	$new_address = array($_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['phone']);
	array_push($address_book, $new_address);
	$csv->write_address_book($address_book);
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
   	$csv->write_address_book($address_book);
	header("Location: address_book.php");
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
	<form method="POST" enctype="multipart/form-data" action="">
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
		<p>
				<label for="uploaded_file">File to Add:</label>
				<input id="uploaded_file" name="uploaded_file" type="file">
				<label for="overwrite">Overwrite existing list?</label>
				<input type="checkbox" id="overwrite" name="overwrite" value=1>
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