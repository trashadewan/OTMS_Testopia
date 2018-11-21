<!DOCTYPE html>
<html lang="en"> 
	<head>
		<?PHP
session_start();
if (!(isset($_SESSION['stid']) && $_SESSION['stid'] != '')) 
{
	header ("Location: Index.php");
}
else 
{
$id = $_SESSION['stid'];
?>
		<title>Results</title>
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
		        <li class="active"><a href="student1.php">Profile</a>
				<li><a href="viewresult.php">View Results</a></li>
				<li class="active"><a href="regcourse.php">Tests</a></li>
		          </ul>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		       <!-- <li><a href="#">Link</a></li>-->
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $id;  ?>  <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="changestudentpassword.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
		         </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
		</nav>
		<script src="../js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>


<?php
$selectques=array();
$answer=array();
$var=$_SESSION['var'];
$count=$_SESSION['count'];
$i=0;
foreach ($_SESSION['selectques'] as $key=>$value)
$selectques[$i++]=$value;

for($i=0;$i<$count;$i++)
{
$answer[$i]=$_POST[$selectques[$i]];
}
$marks=0;
$user_name = "root";
$pass_word = "";
$database = "otms";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db("otms", $db_handle);
 if ($db_found)
	{ 
		 for($i=0;$i<$count;$i++)
		{
			$SQL = "SELECT * from question where C_id='$var' AND Q_id= '$selectques[$i]' AND Answer='$answer[$i]' ;";
			//print $SQL."<br>";
	        $result = mysql_query($SQL);
			if ((mysql_num_rows($result))  == 1)
			$marks++;
		}
		$per=$marks*100/$count;
		$per=round($per,3);		
		$per1 = $per;
		$SQL="Select E_id from enrolled where S_id= '$id' and C_id='$var';";
		$result = mysql_query($SQL);
		$db_feild1=mysql_fetch_assoc($result);
		$abc= $db_feild1['E_id'];
		$SQL = "UPDATE enrolled SET Attempt=$per1 WHERE C_id='$var' AND S_id='$id' AND E_id= '$abc';";
		//print $SQL."<br>";
	    $result = mysql_query($SQL);
	}
	mysql_close($db_handle);
}
?>
Marks Obatained are <?php echo $marks ; ?> out of <?php echo $count ; ?>
</body>
</html>