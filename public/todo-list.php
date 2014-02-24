<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>
	<h1>TODO List</h1>
		<ul>

			<?php
			// var_dump($_POST);
			// var_dump($_GET);
 
			$file = "list.txt";
			$handle = fopen($file, 'r');
			$string = fread($handle, filesize($file));
			$list = explode("\n", $string);
			fclose($handle);

	   		if ((isset($_POST['new_item'])) && ($_POST['new_item'] != '')) {

	   				array_push($list, $_POST['new_item']);

	   				// Save file
	   				$file = "list.txt";
	            	$handle = fopen($file, 'w');
	            	$item_string = implode("\n", $list);
	                fwrite($handle, $item_string);
	                fclose($handle);
   			}

   			if (isset($_GET['remove'])) {
   					$item_to_remove = $_GET['remove'];
   					unset($list[$item_to_remove]);

   					$file = "list.txt";
	            	$handle = fopen($file, 'w');
	            	$item_string = implode("\n", $list);
	                fwrite($handle, $item_string);
	                fclose($handle);
	                header("Location: todo-list.php");
   			}

   			// Displaying list
			foreach ($list as $key => $item) {
				echo "<li>$item <a href='?remove=$key'>Remove</a></li>";
			} 

			?>
		</ul>

	<h1>Add a new item to the list?</h1>
		<form method="POST" action="">
			<p>
				<label for="new_item">New Item:</label>
				<input id="new_item" name="new_item" type="text">
				<button type="submit">Add</button>
			</p>
		</form>

</body>
</html>
		