<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>Registered Courses</title>
  <?PHP
session_start();
if (!(isset($_SESSION['stid']) && $_SESSION['stid'] != ''))
  {
   header ("Location: student1.php");
    }
else
$id = $_SESSION['stid'];
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
        <li ><a href="student1.php">Profile</a>
		<li><a href="viewresult.php">View Results</a></li>
		<li  class="active"><a href="regcourse.php">Tests</a></li>
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
<title>Registered Courses</title>
<body>
<?PHP

$db_handle=mysql_connect("127.0.0.1","root","");
$db_found=mysql_select_db("otms",$db_handle);
$sql="SELECT * FROM enrolled WHERE S_id='$id'";
$result = mysql_query($sql) or die ("Query Failed:".mysql_error());    
if($result==TRUE)
     {
      echo "<div class='container'>";
   echo '<table class="table table-striped">';
   echo "<thead><th>Course</th>.<th>Attempt</th></thead><tbody>";
     while($db_feild=mysql_fetch_assoc($result))
   {  
     echo "<tr><td><a href=\"examination.php?test=".$db_feild['C_id']."\">".$db_feild['C_id']."</a></td><td>".$db_feild['Attempt']."</td></tr>";
    }
    echo '</div>';
   echo "</tbody></table>";
   }
else 
   print "Some error occured during SELECT"."<BR>";
mysql_close($db_handle);
?>
</body>
</html>