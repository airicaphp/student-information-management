<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="./css/Enrollment.css" rel="stylesheet" type="text/css" />
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
<h2>User Infomration Management</h2>
<p>This website is for teacher, tutor and students entering the database. </p>
<p>After logging in, users can managae the detailed infomation.</p>
<p>Users of different access levels can manage different details.</p>
</div>

<?php
  $mysqli=new mysqli("localhost","root","","username");
  
if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

session_start();

if(!isset($_SESSION['session_user']))
{
   $_SESSION['session_user']="";
}

if(isset($_GET['access']))
{
   $_SESSION['session_user']=$_GET['access'];
}
if(!isset($_SESSION['access'])){
	$_SESSION['access']="";
}

//save username in the session 
$session_id=$_SESSION['access'];

if(!isset($_SESSION['error']))
{
   $_SESSION['error']="";
}
$errormessage="";

if(isset($_POST['id'])){
   $_SESSION['id']=$_POST['id'];
   $id=$_SESSION['id'];
}



if(isset($_POST['signin'])){
	 $username=$_POST['username'];
     $password=$_POST['password'];
	 $query = "SELECT * FROM student WHERE username='$username'"; 
     $result = $mysqli->query($query);
     $row=$result->fetch_array(MYSQLI_ASSOC);

     if($row['username']!=$username || $username==""){
     $errormessage="Invalid_username/password";
     $_SESSION['error']=$errormessage;
     }
	 
     else{
        if($row['password']==$password){
           $session_user=$row['username'];
           $_SESSION['session_user']=$session_user;
           $session_access=$row['access'];
	       $_SESSION['access']=$session_access;
	       }
	    else{
           $errormessage="Invalid_username/password";
           $_SESSION['error']=$errormessage;
	       }
		 }
}
if($_SESSION['session_user']!=""){
?>

<a id="logout" href="signout.php">Logout/Back to enrollment page →</a></br></br> 

<?php 
}	


if($_SESSION['session_user']==""){
      if( $_SESSION['error']!=""){
      echo "$errormessage";
	  }
?>	

<form method="post" action="">
<div id="content">
<strong>Log In</strong></br></br>
Username:<input type="text" name="username"/></br></br>
Password:<input type="text" name="password"/></br></br>
<input id="btn1" type="submit" name="signin" value="Submit"/>
</form></br>
<form method="post" action="signup.php">
<div id="sign">
Not regtstered?<br/><a href="signup.php"> Sign up now →</a></br>
</div>
</div>
</form>



<?PHP	  
    }
	else{
	    if($_SESSION['access']=="1"||$_SESSION['access']=="2"){ 
	    $query="SELECT * FROM student";
	    }
	    else{
	    $username=$_SESSION['session_user'];
	    $query="SELECT * FROM student WHERE username='$username'";
	    }
        $result=$mysqli->query($query);
		
		while($row= $result->fetch_array(MYSQLI_ASSOC)){
   	    $id=$row['ID'];
		$user=$row['username'];
	    $Firstname=$row['Firstname'];
   	    $Lastname=$row['Lastname'];
   	    $email=$row['email'];
   	    $Gender=$row['Gender'];
   	    $Campus=$row['Campus'];
	    $comments=$row['comments'];	
	    $access=$row['access'];


?>
<table id="table2">
  <tr>
  <td id="td3" colspan="4">User Detailed Information</td></tr>
  <tr>
    <td class="title">ID</td>
    <td><?php echo $id;?></td>
    <td class="title">Username</td>
    <td><?php echo $user;?></td>
  </tr>
  <tr>
    <td class="title">Access</td>
    <td><?php echo $access;?></td>
    <td class="title">Lastname</td>
    <td><?php echo $Lastname;?></td>
  </tr>
  <tr>
    <td class="title">Firstname</td>
    <td><?php echo $Firstname;?></td>
    <td class="title">email</td>
    <td><?php echo $email;?></td>
  </tr>
  <tr>
    <td class="title">Gender</td>
    <td><?php echo $Gender;?></td>
    <td class="title">Campus</td>
    <td><?php echo $Campus;?></td>
  </tr>
  <tr>
    <td class="title">Comments</td>
    <td colspan="3"><?php echo $comments;?></td>
  </tr>
  <tr>
    <?php
	if($_SESSION['access']=="1"||$_SESSION['access']=="3")
	{?>
    <td id="function" colspan="4"><form action="edit.php" name="edit" method="POST">
      <input type="hidden" name="id"  value="<?php echo $id;?>" />
      <input class="btn2" type="submit" name="edit" value="edit" />
    </form>
	   <form  action="delete.php" name="delete" method="POST">
          <input type="hidden" name="id"  value="<?php echo $id;?>" />
          <input class="btn2" type="submit" name="delete" value="Delete" />
        </form>
		</td>
    <?php
  }else{
	  ?>
    <td id="function" colspan="4"><?php if($access=="2"){?>
        <form  action="edit.php" name="edit" method="POST">
          <input type="hidden" name="id"  value="<?php echo $id;?>" />
          <input class="btn2" type="submit" name="edit" value="Edit" />
        </form>
		<form  action="delete.php" name="delete" method="POST">
          <input type="hidden" name="id"  value="<?php echo $id;?>" />
          <input class="btn2" type="submit" name="delete" value="Delete" />
        </form>
      <?php }?>
	     
    </td>
  </tr>
</table>
<?php
       }
	                                 }
  }
  ?>
  <script>
  $(document).ready(function(){$('input[type=text]:first').focus();});
  </script>
</body>
</html>
