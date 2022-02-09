<?php 
include('header.php');
include("db.php");
if(isset($_GET['modelid']))
{
	$modelid=$_GET['modelid'];

	if(isset($_POST['submit']))
	{
		$model=$_POST['model'];
		$ed=mysqli_query($conn,"update models set model='$model' where modelid='$modelid'");
		if($ed)
			{
		echo "<div style='background-color: purple; color:white;'>
		تم تعديل السجل
	 	</div>";
		 echo "<meta http-equiv='refresh' content='2, models.php'>";

		//header('location:models.php');
		}
	}

}

$sql=mysqli_query($conn,"select * from models where modelid='$modelid'");
$result=mysqli_fetch_array($sql);

 ?>

<fieldset>
	<legend>Models Edit Menu</legend>
<form method="post" action="">
	<label for="model">Model</label>
	<input type="text" name="model" value="<?php echo $result['model'] ?>">
	<input type="submit" name="submit" value="Update Data ">
</form>

</fieldset>
<?php 
include('footer.php'); 
?>
