<!DOCTYPE html>
<html lang="en"> 
<head>
<?PHP

session_start();
if (!(isset($_SESSION['adid']) && $_SESSION['adid'] != ''))
  {
   header ("Location: Index.php");
    }
else
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
<title>Change password</title>
<?PHP

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (isset($_POST['Update1'])) 
{ 
$pword=$_POST['opassword'];
$npword=$_POST['npassword'];
$cpword=$_POST['cpassword'];
if ($npword!=$cpword)
print  "new password and confirm password are different";
else
{
    //==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "root";
	$pass_word = "";
	$database = "otms";
	$server = "127.0.0.1";

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db("otms", $db_handle);

	if ($db_found)
	{    
		
	    $SQL = "UPDATE admin_depaartment SET A_pass='$npword' WHERE A_pass='$pword' AND A_id='$id' ;";
		$result = mysql_query($SQL);
         if($result==TRUE)
        print "Password Sucesfully Changed";
	        else 
           print "Incorrect password given"."<BR>";
      }
mysql_close($db_handle);
}
}
}

?>
</head>
<body>
  <div class="container">
<div class="col-xs-3">
<FORM NAME ="form1" METHOD ="POST" ACTION ="">
Old password:    <INPUT TYPE = 'PASSWORD' Name ='opassword' maxlength="16" class="form-control" placeholder ="Old Password" required ><br>
new password:     <INPUT TYPE = 'PASSWORD' Name ='npassword' maxlength="16" class="form-control" placeholder ="New Password" required><br>
confirm password: <INPUT TYPE = 'PASSWORD' Name ='cpassword' maxlength="16" class="form-control" placeholder ="Confirm Password" required><br>
<INPUT TYPE = "Submit" Name = "Update1" class="btn" VALUE = "CHANGE">
</FORM>
</div>
</div>
</body>
</html>