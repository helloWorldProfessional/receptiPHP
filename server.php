<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'recipes');

	// initialize variables
	$image = "";
	$name = "";
	$type = "";
	$preparation = "";
	$id=0;
	$edit_state = false;

	if (isset($_POST['save'])) {
		$image = $_POST['image'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$preparation = $_POST['preparation'];

		$query="INSERT INTO data (image, name, type, preparation) VALUES ('$image','$name','$type','$preparation')";
		mysqli_query($db, $query ); 
		$_SESSION['msg'] = "Podaci su uspješno sačuvani!"; 
		header('location: index.php');
	}
	
	//delete data
	if(isset($_GET['del'])){
		$id=$_GET['del'];		
		//if you want to delete selected uncomment next line
		mysqli_query($db, "delete from data where id='$id'");
		//$_SESSION['msg'] = "delete je iskomentarisan u kodu i zato ne radi!"; 
		//$_SESSION['msg'] = "Podaci su uspješno obrisani!"; 
		
		header('location: index.php');
	}
	
	
	//retrieve data from database
	$results=mysqli_query($db, "Select * from data");
	
	//update data
	if(isset($_POST['update'])){
		$image = $_POST['image'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$preparation = $_POST['preparation'];
		$id=$_POST['id'];
		
		mysqli_query($db, "update data set image='$image', name='$name', type='$type', preparation='$preparation' where id='$id'");
		$_SESSION['msg'] = "Podaci su uspješno ažurirani!"; 
		header('location: index.php');
	}
	
?>