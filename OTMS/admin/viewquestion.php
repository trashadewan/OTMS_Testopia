<!DOCTYPE html>
<html lang="en"> 
<head>
<?PHP
session_start();
$id = $_SESSION['adid'];
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
        <li ><a href="admin1.php">Profile</a>
        <li class="active"><a href="viewquestion.php">View Questions</a></li>
    <li><a href="resettest.php">Reset Test</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $id;  ?>  <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="changeadminpassword.php">Change Password</a></li>
      <li><a href="logout.php">Logout</a></li>
         </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<script src="../js/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<title>Resetting Student's Test</title>
<body>
<?PHP
if (!(isset($_SESSION['adid']) && $_SESSION['adid'] != ''))
	{
	 header ("Location: Index.php");
    }
else
{
$id = $_SESSION['adid'];


$db_handle=mysql_connect("127.0.0.1","root","");
$db_found=mysql_select_db("otms",$db_handle);
if ($db_found)
	{  

		print "<FORM NAME =\"form1\" METHOD =\"POST\" ACTION =\"queslist.php\">";
    echo "<div class='container'>";
    echo "<div class='col-lg-3'>";
    echo "Choose Course code  and faculty ID to view Questions:";
    echo "<BR>Course ID:<BR>";
		$SQL2="SELECT Distinct(C_id) from course_incharge;";
		//print $SQL2;
		$result2 = mysql_query($SQL2) or die ("Query Failed:".mysql_error());
		if($result2==TRUE)
        print "";
	    else 
        print "error in selection"."<BR>";
      
		print "<select name = \"cid\" class='form-control'>";
		while($db_feild=mysql_fetch_assoc($result2))
		{	
			$c=$db_feild['C_id'];
			echo "<option value='$c'>".$c."</option>";
		}
		print "</select> ";
		
		echo "<br>Faculty ID:";
		$SQL2="SELECT Distinct(E_id) from course_incharge;";
		//print $SQL2;
		$result2 = mysql_query($SQL2) or die ("Query Failed:".mysql_error());
		/*if($result2==TRUE)
        print "selected ";
	    else 
        print "error in selection"."<BR>";*/
      
		print "<select name = \"eid\" class='form-control'>";
		while($db_feild=mysql_fetch_assoc($result2))
		{	
			$e=$db_feild['E_id'];
			echo "<option value='$e'>".$e."</option>";
		}
		print "</select>" ;
		print "<br><P align = center><INPUT TYPE = \"Submit\" Name = \"display\"  VALUE = \"VIEW\" class=\"btn\"></P></FORM>";
	  echo "</div> </div>";
  }
mysql_close($db_handle);
}
?>
</body>
</html>
