<!DOCTYPE html>
<html lang="en"> 
<head>

<?PHP
session_start();
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) {
	header ("Location: Index.php");
}
else 
$id = $_SESSION['id'];
?>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Testopia</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="employee1.php">Profile</a>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add Questions <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="quesforma.php">Manually</a></li>
            <li><a href="quesformb.php">Using CSV file</a></li>
         </ul>
        </li>
        <li><a href="viewques.php">View Questions</a></li>
		<li><a href="regstud.php">Registered Students</a></li>
    <li><a href="stats.php">Statistics</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $id;  ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="changeemployeepassword.php">Change Password</a></li>
			<li><a href="logout.php">Logout</a></li>
         </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<script src="../js/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<title>FACULTY</title>
</head>
<body>

 
<?php
$db_handle=mysql_connect("127.0.0.1","root","");
$db_found=mysql_select_db("otms",$db_handle);
$sql="SELECT * FROM course_incharge WHERE E_id='$id'";
$result = mysql_query($sql) or die ("Query Failed:".mysql_error());  
echo "<div class='container'>";  
echo "Welcome Sir/madam,<br>Following is the list of courses that you are taking this semester";
if($result==TRUE)
     {
	 echo '<table class="table table-striped">';
	 echo "<thead><th>Course ID</th>.<th>Course Name</th></thead><tbody>";
     while($db_feild=mysql_fetch_assoc($result))
	 {
	 	 echo "<tr><td>".$db_feild['C_id']."</td>";
		 $sql="SELECT * FROM  `course` WHERE  `C_id` LIKE  '".$db_feild['C_id']."';";
     //print $sql;
		 $result1 = mysql_query($sql) or die ("Query Failed:".mysql_error()); 
		 $db_field1=mysql_fetch_assoc($result1)	;
     //print $db_field1['C_name']."<br>";
		 echo "<td>".$db_field1['C_name']."</td></tr>";
	 }
	 echo "</tbody></table>";
	 }
else 
	 print "Some error occured during SELECT"."<BR>";
mysql_close($db_handle);
echo "</div>";
?>
	</body>
	</html>
