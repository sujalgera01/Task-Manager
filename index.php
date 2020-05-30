<?php
$servername = "localhost";
$username = "root";
$password = "Sujal1003";
$dbName = "tasks";

$error = '';
$conn = new mysqli($servername,$username,$password,$dbName);

if($conn->connect_error){
	die("Connection Failed".$conn->connect_error);
}

if(isset($_POST['submit'])){
	if(empty($_POST['task'])){
		$error = "Please fill in the task";
	}else{
		$task = $_POST['task'];
		$sql = "INSERT INTO todo (task) VALUES ('$task')";
		mysqli_query($conn,$sql);
		header('location: index.php');
	}
}
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($conn, "DELETE FROM todo WHERE id=".$id);
	header('location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</head>
<body>
	<h1><ion-icon id="icon" name="book-outline"></ion-icon>Task Manager</h1>
	<p>A Simple Web-App that helps you to manage your daily Tasks. <br> It makes the life easier and comfortable.</p>

		<form method="post">
			<?php if (isset($errors)) { ?>
					<p><?php echo $errors; ?></p>
					<?php } 
				?>
			<input type="text" name="task" class="text" placeholder="Write....">
			<br>
			<button type="submit" name="submit" class="btn">Add Task</button>
		</form>

		<table>
			<thead>

				<tbody>

					<?php
						$tasks = mysqli_query($conn, "SELECT * FROM todo");

		$i = 1; 
		while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; }
					?>

				</tbody>
			</thead>
		</table>
</body>
</html>