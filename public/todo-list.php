<?php
// var_dump($_POST);
// var_dump($_GET);
// var_dump($_FILES);

function save_file($array) {
	$file = "list.txt";
	$handle = fopen($file, 'w');
	$item_string = implode("\n", $array);
	fwrite($handle, $item_string);
	fclose($handle);
}

function read_file($filename) {
	$handle = fopen($filename, 'r');
	$string = fread($handle, filesize($filename));
	fclose($handle);
	return explode("\n", $string);
}

$list = read_file("list.txt");

if (count($_FILES) > 0 && $_FILES['uploaded_file']['error'] == 0) {
	if ($_FILES['uploaded_file']['type'] == 'text/plain') {

		// Upload file
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$uploaded_filename = basename($_FILES['uploaded_file']['name']);
		$saved_filename = $upload_dir . $uploaded_filename;
		move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $saved_filename);

		// Open uploaded file
		$imported_list = read_file($saved_filename);

		// Overwrite existing list checkbox option
		if (isset($_POST['overwrite']) && $_POST['overwrite'] == 1) {
				$list = $imported_list;
				save_file($list);
		} else {

				// Append list and Save
				$list = array_merge($list, $imported_list);
				save_file($list);
		}

	}	else {
			echo "<p>Error: Uploaded files must be plain text!</p>";
	}	
}	

// Adding a new item
if ((isset($_POST['new_item'])) && ($_POST['new_item'] != '')) {
	array_push($list, $_POST['new_item']);

	// Save file
	save_file($list);

}

// Removing an item
if (isset($_GET['remove'])) {
   	$item_to_remove = $_GET['remove'];
   	unset($list[$item_to_remove]);
   
   	// Save file
   	save_file($list);
	header("Location: todo-list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>
	<h1>TODO List</h1>
		<ul>
			<? foreach ($list as $key => $item): ?>
				<li><?= htmlspecialchars(strip_tags($item)); ?>	<a href='?remove=$key'>Remove</a></li>
			<? endforeach; ?>
		</ul>

	<h1>Add a new item to the list?</h1>
		<form method="POST" enctype="multipart/form-data" action="">
			<p>
				<label for="new_item">New Item:</label>
				<input id="new_item" name="new_item" type="text">
			</p>

			<p>
				<label for="uploaded_file">File to Add:</label>
				<input id="uploaded_file" name="uploaded_file" type="file">
				<label for="overwrite">Overwrite existing list?</label>
				<input type="checkbox" id="overwrite" name="overwrite" value=1>
			</p>

			<p>
				<button type="submit">Add</button>
			</p>
		</form>

</body>
</html>
		