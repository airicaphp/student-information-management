<html>
<body>

<center>
<h2>Delete Information</h2>
</center>
<?php

$mysqli=new mysqli("localhost","root","","username");
        if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
session_start();
if(isset($_POST['id'])){
   $_SESSION['id']=$_POST['id'];
   $id=$_SESSION['id'];
}
if(!isset($_SESSION['session_user'])){
	$_SESSION['session_user']="";
}
$username=$_SESSION['session_user'];


	if(isset($_POST['delete']))
	{
		$id=$_POST['id'];
		$deletequery="DELETE from student WHERE ID LIKE '$id'";
		$result=$mysqli->query($deletequery);
		$tablequery="select * from student";
		$result=$mysqli->query($tablequery);
		
		header('location: ./Enrollment.php');
	}

?>

<form method="post" action="">
ID:<input type="text" name="id" value="<?php $delete1=$_SESSION['id'];echo"$delete1";?>" disabled="disabled"/></br>
<input type="submit" name="delete" value="delete" />
<input type="submit" name="reset" value="reset" onClick="window.location.reload()"/></br>
</form>

</body>
</html>