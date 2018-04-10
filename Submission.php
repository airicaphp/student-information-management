<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Submission</title>
<link href="./css/Submission.css" rel="stylesheet" type="text/css" />
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
<h2>Submission Area</h2>
<p>This website is for studetns submiiting personal information. </p>
<p>You can write your information below.</p>
</div>

<?php 
 $mysqli=new mysqli("localhost","root","","username");
 
 if(isset($_POST['Submit']))
 {
     
	 $lastname=$_POST['Lastname'];
	 $firstname=$_POST['Firstname'];
	 $email=$_POST['email'];
	 $gender=$_POST['Gender'];
	 $campus=$_POST['Campus'];
	 
     $query="INSERT INTO student (Lastname,Firstname,email,Gender,Campus) 
	 VALUES ('$lastname','$firstname','$email','$gender','$campus')";
     $result=$mysqli->query($query);	
	 
  $tablequery="SELECT * FROM student";
  $result=$mysqli->query($tablequery);
 
  echo "<table border=1 id=table2>";
  echo"<tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>email</th><th>Gender</th><th>Campus</th></tr>";
  
  while($row=$result->fetch_array(MYSQLI_ASSOC))
    {
	$id=$row['ID'];
	$lastname=$row['Lastname'];
	$firstname=$row['Firstname'];
	$email=$row['email'];
	$gender=$row['Gender'];
	$campus=$row['Campus'];
	echo"<tr>";
	echo"<td>$id</td>";
	echo"<td>$lastname</td>";
	echo"<td>$firstname</td>";
	echo"<td>$email</td>";
	echo"<td>$gender</td>";
	echo"<td>$campus</td>";
	echo"</tr>";
    }  
  echo"</table>"; 
$mysqli->close();
} 
?>
<br /><br />
<div id="content">
<form action="" method="post">
LastName: <input type="text" name="Lastname"><br><br>
FirstName: <input type="text" name="Firstname"><br><br>
Email: <input type="text" name="email"><br><br>
Gender: Male<input type="radio" name="Gender" value="Male">Female<input type="radio" name="Gender" value="Female"><br><br>
Campus: 
<select name= "Campus">
<option value="Hobart" />Hobart
<option value="Launceston" />Launceston
<option value="Sydney" />Sydney
<option value="Shanghai" />Shanghai
<option value="Fuzhou" />Fuzhou
<option value="Beijing" />Beijing
</select><br><br>

<script>
function display()
{
alert("Your information have been successfully registered.")
}
 </script>
<input type="submit" onClick="display()" value="Submit" name="Submit" />
<input type="reset" value="Reset" >
</form>

</body>
</html>
