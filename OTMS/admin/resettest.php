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
        <li><a href="viewquestion.php">View Questions</a></li>
    <li class="active"> <a href="resettest.php">Reset Test</a></li>
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
$id = $_SESSION['adid'];

$db_handle=mysql_connect("127.0.0.1","root","");
$db_found=mysql_select_db("otms",$db_handle);
if(isset($_POST['reset']))
{
	$sid=$_POST['id'];
	$cid=$_POST['cid'];
	$sql="update enrolled set `Attempt`='Available' where `S_id`='$sid' and `C_id`='$cid' and `Attempt` != 'Not Availaible';";
  //echo $sql;
	$result = mysql_query($sql) or die ("Query Failed:".mysql_error());   
	
	if($result==TRUE)
     {
	  print "Test reset Succesfully";
	 }
mysql_close($db_handle);
}
?>
<div class="container">
<div class="col-lg-3">
<FORM NAME ="form1" METHOD ="POST" ACTION ="">
Choose Student Id and Course ID to reset test:
Student ID:<INPUT TYPE = 'TEXT' Name ='id' value="" class="form-control" placeholder="Student id" required><br>
Course ID:<INPUT TYPE = 'TEXT' Name ='cid' value=""  class="form-control" placeholder="Course Id" required><br>
<br>

<INPUT TYPE = "Submit" Name = "reset"  VALUE = "RESET" class="btn">
</div>
</div>
</FORM>
</body>
</html>
