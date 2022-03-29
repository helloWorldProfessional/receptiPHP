<?php include ('server.php');

if(isset($_GET['edit'])){
$id=$_GET['edit'];
$edit_state=true;
$rec=mysqli_query($db, "select * from data where id=$id");
$record=mysqli_fetch_array($rec);

$image = $record['image'];
$name = $record['name'];
$type = $record['type'];
$preparation =$record['preparation'];
$id=$record['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mamina kuhinja</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<body>

<h1 align="center">MAMINA KUHINJA</h1>

<table>
    <thead>
        <tr>
            <th>Slika</th>
            <th>Naziv</th>
            <th>Vrsta</th>
            <th>Priprema</th>
            <th colspan="3"></th>
        </tr>
    </thead>
	<tbody>
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><img src="<?php echo $row['image'];?>" alt="" height="auto" width="200"></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['preparation']; ?></td>
			<td>
				<a class="edit_btn" href="index.php?edit=<?php echo $row['id'];?>">Uredi</a>
			</td>
			<td>
				<a class="del_btn" href="server.php?del=<?php echo $row['id'];?>">Obriši</a>
			</td>
		</tr>
	<?php } ?>
    </tbody>
</table>

<?php if(isset($_SESSION['msg'])):?>
<div class="msg">
<?php 
	echo $_SESSION['msg'];
	unset ($_SESSION['msg']);
?>
</div>
<?php endif ?>


    <form method="post" action="server.php">
	<h2 align="center">PODACI</h2>
	<input type="hidden" name="id" value="<?php echo $id;?>">
		<div class="input-group">
            <label>Slika</label>
			<img id="output_image" alt="" height="auto" width="93%"/>
			<input type="file" name="image" accept="image/*" onchange="preview_image(event)">
			
		</div>
        <div class="input-group">
			<label>Naziv</label>
			<input type="text" name="name" value="<?php echo $name;?>">
		</div>
		<div class="input-group">
			<label>Vrsta</label>
			<input type="text" name="type" value="<?php echo $type;?>">
		</div>
        <div class="input-group">
			<label>Priprema</label>
			<textarea name="preparation" id="prep" cols="30" rows="10" class="preparation">
			<?php echo $preparation;?>
            </textarea>
		</div>
		<div class="input-group">
			<?php if ($edit_state==false):?>
				<button class="btn" type="submit" name="save" >Unesi</button>
			<?php else :?>
				<button class="btn" type="submit" name="update" >Ažuriraj</button>
			<?php endif ?>
			
		</div>
	</form>
    
</body>

</html>