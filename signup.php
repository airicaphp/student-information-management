<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="./css/signup.css" rel="stylesheet" type="text/css" />
<title>Enrollment Management</title>
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
<h2>Students Sign Up</h2>
<p>Please TYPE your username and password.</p>
<p>CLICK the 'Sign Up' button to submit your information, or go back to the enrollment page.</p>
</div>

<?php
session_start();
$_SESSION['username']="";
$_SESSION['error']="";
$_SESSION['session_user']="";
$session_user=$_SESSION['session_user'];
	 
$mysqli=new mysqli("localhost","root","","username");
        if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
if(isset($_POST['SignUp'])){
			 
$username=$_POST['username'];
$password=$_POST['password'];
$retypepassword=$_POST['RetypePassword'];
$query = "SELECT * FROM student WHERE username='$username'";
$result = $mysqli->query($query);
while($row=$result->fetch_array(MYSQLI_ASSOC))
			 {
			     if($row['username']==$username)
				 $_SESSION['username']=$username;
			 }
if($username=="")
    {
    	$_SESSION['error']=" Please type your name"."<br/>";
		$error=$_SESSION['error'];
    }
if($password=="")
    {
    	$_SESSION['error']=" Please type your password"."<br/>";
		$error=$_SESSION['error'];
    }
if($password!=$retypepassword)
            {
			$_SESSION['error']="Password is not same as the Retype Password.";
			$error=$_SESSION['error'];
            }else if($_SESSION['username']==""&&$error==""){
		    $query1="INSERT INTO student (username,password,access) VALUE  ('$username','$password','3')";
            $result1 = $mysqli->query($query1);
      	   	 
		    header('Location: ./Enrollment.php?access='.$username);
	
     	    } 
}
?>

<form method="post" action="">
<table id="table2">
<td><img id="img3" src="image/register.png" /></td>
<td>
<div id="content">
</br>Username:<input name="username" type="text">
<?php if($_SESSION['username']!=""){echo "Username already exists.";}?></br></br>
Password:<input name="password" type="password"></br></br>
Retype Password:<input name="RetypePassword" type="password">
<?php if($_SESSION['error']!=""){echo "$error";}?></br></br>
<input id="btn1" name="SignUp" type="submit" value="Sign Up"></br></br>
<a href="enrollment.php">Back to enrollment page →</a> 
</div>
</td>
</table>
</form>
  <script>
  $(document).ready(function(){$('input[type=text]:first').focus();});
  </script>

</body>
</html>
