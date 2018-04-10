<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="./css/Edit.css" rel="stylesheet" type="text/css" />
<title>Edit Information</title>
</head>

<body>
<table id="table1">
<tr>
<td id="td1"><img src="./image/utas.jpg" alt="Utas"/></td>
<td id="td2"><img src="./image/utas2.jpg" alt="Utas"/></td>
</tr>
</table>
 
<div id="templatemo_menu">     
<ul>
<li><a href="./Homepage.html" >Homepage </a></li>
<li><a href="./Learning material.html">Learning Materials</a></li>
<li><a href="./Discussion.html">Discussion</a></li>
<li><a href="./Submission.php">Submission</a></li>
<li><a href="./Contact Us.html">Contact Us</a></li>
<li><a href="./Enrollment.php">Enrollment</a></li>
</ul>
<br><br> 	
</div>

<div id="content_section">
<h2>Students'Information Edit</h2>
<p>Please EDIT infomration about the details.</p>
<p>CLICK the 'Submit' button to confirm edit and go back to enrollment page.</p>
</div>


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
if(!isset($_SESSION['access'])){
	$_SESSION['access']="";
}

    $id=$_SESSION['id'];
	$query="SELECT * FROM student WHERE ID='$id'";
    $result=$mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	$username=$row['username'];
	$access=$row['access'];
	$lastname=$row['Lastname'];
	$firstname=$row['Firstname'];
	$email=$row['email'];
	$gender=$row['Gender'];
    $campus=$row['Campus'];
	$comments=$row['comments'];

	
    if(isset($_POST['submit'])){
		$username=$_POST['username'];
	    $access=$_POST['access'];
	    $lastname=$_POST['lastname'];
        $firstname=$_POST['firstname'];
	    $email=$_POST['email'];
	    $gender=$_POST['radio'];
        $campus=$_POST['select'];
        $comments=$_POST['comments'];
		
		if($_SESSION['access']=="1"){
		$updatequery="UPDATE student SET username='$username',access='$access',Lastname='$lastname', Firstname='$firstname',email='$email', Gender='$gender',Campus='$campus'  , comments='$comments' WHERE ID='$id'";
        }
	    if($_SESSION['access']=="2"||$_SESSION['access']=="3"){
		$updatequery="UPDATE student SET username='$username',Lastname='$lastname',Firstname='$firstname',email='$email', Gender='$gender',Campus='$campus',comments='$comments' WHERE ID='$id'";
		}
        $result1=$mysqli->query($updatequery);
        header('location: ./Enrollment.php');

}
 
?>
        
<div id="content">
	<form action="" method="post">
	
	<table id="form">
        <tr>
			<td class="label">* Username</td>
			<td><input type="text" name="username" value="<?php echo $username;?>"></td> 
		</tr>
		
		<tr>
			<td class="label">* Access</td>
			<?php if($_SESSION['access']=="1"){?>
			<td><input type="text" name="access" value="<?php echo $access;?>"></td> 
			<?php }?>
			<?php if($_SESSION['access']=="2"||$_SESSION['access']=="3"){?>
			<td><input type="text" name="access" value="<?php echo $access;?>" disabled="disabled" /></td> 
			<?php }?>
		</tr>
		
		<tr>
			<td class="label">* Lastname</td>
			<td><input type="text" name="lastname" value="<?php echo $lastname;?>"></td> 
		</tr>
		
	    <tr>
			<td class="label">* Firstname</td>
			<td><input type="text" name="firstname" value="<?php echo $firstname;?>"></td> 
		</tr>
	
		<tr>
			<td class="label">* Email</td>
      		<td><input type="text" name="email" value="<?php echo $email;?>"></td>
   		</tr>
   		
   		<tr>
   			<td class="label">* Gender</td>
      		<td> male<input   type="radio" name="radio" value="male" checked="<?php if($Gender=="male"){echo "true";}?>" />
		         female<input   type="radio" name="radio" value="female" checked="<?php if($Gender=="female"){echo "true";}?>"/><br/>
		</td>
   		</tr>
   		
		<tr>
   			<td class="label">* Campus</td>
      		<td><select name="select" >
                <option selected="selected"><?php echo $campus;?></option>
		        <option >Hobart</option>
                <option >Launceston</option>
                <option >Sydney</option>
                <option >Shanghai</option>
		        <option >Fuzhou</option>
		        <option >Beijing</option>
                </select>
			</td>
   		</tr>
		
   		<tr>
	   		<td class="label">* Comments</td>
    	  	<td><textarea name="comments" cols="50" rows="10" ><?php echo $comments;?></textarea></td>
   		</tr>
    	
    	<tr>
        	<td colspan="2" id="submit"><input id="btn1"type="submit" name="submit" value="Submit"></td>
    	</tr>
	</table>
	</form>

</div>

  <script>
  $(document).ready(function(){$('input[type=text]:first').focus();});
  </script>

</body>
</html>
