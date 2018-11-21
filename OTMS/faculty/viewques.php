
<!DOCTYPE html>
<html lang="en"> 
<head>

<?PHP
session_start();
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) 
{
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
        <li ><a href="employee1.php">Profile</a>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add Questions <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="quesforma.php">Manually</a></li>
            <li><a href="quesformb.php">Using CSV file</a></li>
           
         </ul>
        </li>
        <li class="active"><a href="viewques.php">View Questions</a></li>
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
	<FORM NAME ="form1" METHOD ="POST" ACTION ="">
	
<?php
	

	$db_handle=mysql_connect("127.0.0.1","root","");
	$db_found=mysql_select_db("otms",$db_handle);
	$sql="SELECT * FROM course_incharge WHERE E_id='$id'";
	$result = mysql_query($sql) or die ("Query Failed:".mysql_error());
	echo "<div class='container'>";
	echo "<div class='col-lg-4'>"; 
	echo "Choose The Course code to view Questions:";   
	echo "<select name='sel' class='form-control'>";
	if($result==TRUE)
		 {
			while($db_feild=mysql_fetch_assoc($result))
			{
				?>
				<option value="<?PHP echo $db_feild['C_id'] ?>"> 
				<?PHP echo $db_feild['C_id'] ?> 
				</option>
				<?PHP 
			}
		 }

	else 
		 print "Some error occured during SELECT"."<BR>";
	echo "</select>";
	echo "<br><input type=\"submit\" name=\"submit\" Value =\"Show \" class=\"btn\" ";
	echo "</div>";
	echo "</div>";
	echo "</br>";	

	if (isset($_POST['submit'])) 
	{
		$cid=$_POST['sel'];
		$SQL="select * from question where C_id='$cid' AND E_id ='$id';";
	 	$result2 = mysql_query($SQL) or die ("Query Failed:".mysql_error());
		//if($result2==TRUE)
        //print "selected ";
	    //else 
        //print "error in selection"."<BR>";
		$i=0;
		while($db_feild=mysql_fetch_assoc($result2))
		{	$i++;
			print "<BR><BR><BR><BR><BR>"."Q ".$i. "  ".$db_feild['Question'];
			echo "<BR> <BR>Answer    :" .$db_feild['Answer']."<BR>";
			$id=$db_feild['Q_id'];
			 $SQL="select * from options where q_no='$id';";
			  $result3 = mysql_query($SQL) or die ("Query Failed:".mysql_error());
			  if($result3==TRUE)
			  {
			  $j=97;
				while($db_feild1=mysql_fetch_assoc($result3))
				{
					$op=$db_feild1['Options'];
					echo '<br>';
					echo chr($j);
					echo ')';
					echo $op;
					echo '<br>';
					$j++;
				}
			  }
			  
echo '---------------------------------------------------------------------------------------------------------------------------------------<br>';
		}
	}	

		echo '</div>';


	
mysql_close($db_handle);

?>

</form>
</body>
</html>
	