<?php 
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_GET['modelid']))
{
	$modelid=$_GET['Modelid'];

	echo $modelid;

	$del=mysqli_query($conn,"delete from models where modelid='$modelid'");

	if($del){

		header('location:models.php');
	}
	

}

 ?>