<?PHP
session_start();
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
        <li><a href="viewques.php">View Questions</a></li>
		<li class="active"><a href="regstud.php">Registered Students</a></li>
		<li><a href="stats.php">Statistics</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $id;  ?>  <b class="caret"></b></a>
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
</head>
	<title>FACULTY</title>
	</head><body>
<?php
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) {
	header ("Location: Index.php");
}
else 
{
	$id = $_SESSION['id'];
	$db_handle=mysql_connect("127.0.0.1","root","");
	$db_found=mysql_select_db("otms",$db_handle);
	$sql="SELECT * FROM course_incharge WHERE E_id='$id'";
	$result = mysql_query($sql) or die ("Query Failed:".mysql_error());  
	echo "<div class='container'>";  
	echo '<div class="col-lg-4">';
	echo "Choose The Course code to view Registered Students:";
	echo '<FORM NAME ="form1" METHOD ="POST" ACTION ="">';
	echo "<select name='sel' class=\"form-control\">";
	if($result==TRUE)
		 {
			while($db_feild=mysql_fetch_assoc($result))
			{
				?>
				
				<option value="<?PHP echo $db_feild['C_id'] ?>" ><?PHP echo $db_feild['C_id'] ?> </option>
			
				<?PHP 
			}
		 }
	else 
		 print "Some error occured during SELECT"."<BR>";
		echo "</select>";
	echo "<br><input type=\"submit\" name=\"submit\" Value =\"Show \" class=\"btn\">";
	echo "</div>";
	echo "</div>";
	echo "<br>";
	

	if (isset($_POST['submit'])) 
	{
		
		$cor=$_POST['sel'];
		$sql="select setted from course_incharge WHERE E_id='$id' and C_id='$cor';";
		$result = mysql_query($sql) or die ("Query Failed:".mysql_error());
		
		while($db_feild=mysql_fetch_assoc($result)) 
		$check=$db_feild['setted'];
		echo "<div class='container'>"; 
		echo '<table class="table table-striped">';
		if($check=='Complete')
		{
			$sql="select * from enrolled WHERE E_id='$id' and C_id='$cor';";
			$result = mysql_query($sql) or die ("Query Failed:".mysql_error());
			$i=0;
			?>
			<thead><tr><th>S.No</th><th>Reg no</th><th>Student</th><th>Marks</th></tr></thead><tbody>
			<?PHP
			while($db_feild=mysql_fetch_assoc($result)) 
			{
				$s=$db_feild['S_id'];
				$sql="select * from student WHERE S_id='$s';";
			
				$result1 = mysql_query($sql) or die ("Query Failed:".mysql_error());
					while ($db=mysql_fetch_assoc($result1)) 
					{
							$su=$db['F_name'];
					}	
				$a=$db_feild['Attempt'];
				if ($a=='Available') 
				{
					$a='Not Attempted';
				}
				$i++;
				?>
				<tr> <td> <?PHP echo $i; ?> </td> <td> <?PHP echo $s; ?> </td><td> <?PHP echo $su; ?> </td> <td> <?PHP echo $a; ?> </td> </tr>
				<?PHP
			}
				
		
			?>
			</tbody></table>
			<?PHP
		}
		else  
		{
			$sql="select * from enrolled WHERE E_id='$id' and C_id='$cor';";
			$result = mysql_query($sql) or die ("Query Failed:".mysql_error());
			$i=0;
			?>
			<tr><th>S.No</th><th>Reg no</th><th>Student</th></tr>
			<?PHP
			while($db_feild=mysql_fetch_assoc($result)) 
			{
				$s=$db_feild['S_id'];
				$sql="select * from student WHERE S_id='$s';";
				
				$result1 = mysql_query($sql) or die ("Query Failed:".mysql_error());
					while ($db=mysql_fetch_assoc($result1)) 
					{
							$su=$db['F_name'];
					}	
				$a=$db_feild['Attempt'];
				if ($a=='Available') 
				{
					$a='Not Attempted';
				}
				$i++;
				?>
				<tr> <td> <?PHP echo $i; ?> </td> <td> <?PHP echo $s; ?> </td><td> <?PHP echo $su; ?> </td> </tr>
				<?PHP
			}
				
		
			?>
			</table>
			<?PHP	
		}	

		echo '</div>';


	}
mysql_close($db_handle);
}
?>

</form>
</body>
</html>
	