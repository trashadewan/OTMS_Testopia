<html>
<head>
<title>Employee Login</title>
<meta name="viewport" content="width=device-width ,intial-scale=1 ">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/signin.css">

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
        <li ><a href="#">Profile</a>
        <li><a href="#">View Questions</a></li>
		<li><a href="#">Reset Test</a></li>
  </ul>
     </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<script src="../js/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<title>Admin Login</title>
<?PHP
session_start();
//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//{
if (isset($_POST['login'])) 
{ 
$pwd=$_POST['pass'];
$id=$_POST['id'];
print $pwd.$id;
    //==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "root";
	$pass_word = "";
	$database = "otms";
	$server = "127.0.0.1";
//
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db("otms", $db_handle);
    //print "hi";
	if ($db_found)
	{
		print "hi";
	    $SQL = "SELECT * FROM admin_department WHERE A_pass='$pwd' AND A_id='$id' ;";
		$result = mysql_query($SQL);
         if(mysql_num_rows($result)==1)
        {
          
			$_SESSION['adid']=$id;
			print "Sucessful";
			header ("Location: admin1.php");
		}
	        else 
           print "Incorrect password given"."<BR>";
      }
mysql_close($db_handle);
}
//}
?>

<link rel="stylesheet" type="text/css" href="../css/signin.css">
</head>
<body bgcolor="#ffffff">
<div class="container">
<FORM NAME ="form1" METHOD ="POST" ACTION ="" class="form-signin" role="form">
User ID:     <INPUT TYPE = 'TEXT' Name ='id' class="form-control" placeholder ="User ID" required maxlength="16"><br>
Password:<INPUT TYPE = 'PASSWORD' Name ='pass' class="form-control" placeholder ="Password" required maxlength="16"><br>
<INPUT TYPE = "Submit" Name = "login" class="btn" VALUE = "Login">
</FORM>

</div>
</body>
</html>
<!--
<div class="col-xs-3">
<FORM NAME ="form1" METHOD ="POST" ACTION ="">
Old password:    <INPUT TYPE = 'PASSWORD' Name ='opassword' maxlength="16" class="form-control" placeholder ="Old Password" required ><br>
new password:     <INPUT TYPE = 'PASSWORD' Name ='npassword' maxlength="16" class="form-control" placeholder ="New Password" required><br>
confirm password: <INPUT TYPE = 'PASSWORD' Name ='cpassword' maxlength="16" class="form-control" placeholder ="Confirm Password" required><br>
<INPUT TYPE = "Submit" Name = "Update1" class="btn" VALUE = "CHANGE">
</FORM>
</div>-->