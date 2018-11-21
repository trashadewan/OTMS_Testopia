<!DOCTYPE html>
<html lang="en"> 
<head>
	<style type="text/css">
		.form-signin input[type="TEXT"] 
		{
			height: 14px;
			font-size: 10px;
			line-height: 14px;
		}
	</style>
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
		<li  class="active" class="dropdown">
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
<?PHP
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) 
{
	header ("Location: Index.php");
}
else 
{
	if (isset($_POST['save'])) 
	{
		$id = $_SESSION['id'];
		$var = $_GET['course'];
		#print $var;
		if(!isset($var))
		{
		header ("Location:quesforma.php");
		}

		$user_name = "root";
		$pass_word = "";
		$database = "otms";
		$server = "127.0.0.1";
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db("otms", $db_handle);
		if ($db_found)
		{    
			$ques=$_POST['ques'];
			$ans=$_POST['ans'];
			
			$SQL1 = "INSERT into question values ('','$var' ,'$id','$ques' ,'$ans');";
			$result1 = mysql_query($SQL1);
			if($result1==TRUE)
			print "done inserttinon of question and answer";
			else 
			print "error in inserttinon of question and answe "."<BR>";
		
			$SQL2="SELECT * from question where question='$ques';";
			print $SQL2;
			$result2 = mysql_query($SQL2) or die ("Query Failed:".mysql_error());
			if($result2==TRUE)
			print "done q-id selection";
			else 
			print "error in q_id selection"."<BR>";
		
			$db_feild=mysql_fetch_assoc($result2);
			$q_id= $db_feild['Q_id'];
			
			$op1=$_POST['op1'];
			$op2=$_POST['op2'];
			$op3=$_POST['op3'];
			$op4=$_POST['op4'];
			
			$SQL3="Insert into options values ($q_id , '$op1');";
			$result3 = mysql_query($SQL3);
			
			$SQL4="Insert into options values ($q_id , '$op2');";
			$result4 = mysql_query($SQL4);
			
			$SQL5="Insert into options values ($q_id , '$op3');";
			$result5 = mysql_query($SQL5);
			
			$SQL6="Insert into options values ($q_id , '$op4');";
			$result6 = mysql_query($SQL6);
			
			if(($result3 && $result4 && $result5 && $result6 && $result1 && $result2)==TRUE)
			print "Question Succesfully Added";
			else 
			print "Unable to Add . please try Again"."<BR>";
			
			mysql_close($db_handle);
		}
	}
	else if (isset($_POST['back'])) 
	{
		header ("Location: quesforma.php");
	}
	else if (isset($_POST['saveno']))
	{

		$id = $_SESSION['id'];
		$var = $_GET['course'];
		$no = $_POST['no'];

		$user_name = "root";
		$pass_word = "";
		$database = "otms";
		$server = "127.0.0.1";
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db("otms", $db_handle);

		if ($db_found)
		{ 
			$SQL = "UPDATE course_incharge SET No_ques='$no' WHERE C_id='$var' AND E_id='$id' ;";
			$result = mysql_query($SQL);
			if($result==TRUE)
			print "Sucesfully Updated";
			else 
			print "Unable to update"."<BR>";
			mysql_close($db_handle);
		}
	}
	else if (isset($_POST['done']))
	{
		$id = $_SESSION['id'];
		$var = $_GET['course'];

		$user_name = "root";
		$pass_word = "";
		$database = "otms";
		$server = "127.0.0.1";
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db("otms", $db_handle);

		if ($db_found)
			{ 
			$SQL = "UPDATE course_incharge SET setted='Complete' WHERE C_id='$var' AND E_id='$id' ;";
			$result = mysql_query($SQL);
			
			$SQL = "UPDATE enrolled SET Attempt='Availaible' WHERE C_id='$var' AND E_id='$id' ;";
			$result1 = mysql_query($SQL);
			
			if($result1 ==TRUE)
			print "Sucesfully Updated";
			else 
			print "Unable to update"."<BR>";
			mysql_close($db_handle);
			}
	}
}	

?>

<body>
No. Of questions to be given to a student to be evaluated ?

<FORM NAME ="form2" METHOD ="POST" ACTION ="">
<div class="col-lg-2">
<INPUT TYPE = 'TEXT' Name ='no' value="" maxlength="757" class="form-control"><br>

<INPUT TYPE = "Submit" Name = " saveno"  VALUE = "CHANGE" class="btn"><br>
</div>
</form>
<br>
<br><br><br><br><br>
<FORM NAME ="form1" METHOD ="POST" ACTION ="">
	<div class="container">
		Question:    <INPUT TYPE = 'TEXT' Name ='ques' value="" maxlength="10000" size= '75' class="form-control" placeholder="Question"><br>
		
		<div class="container">
			<div class="form-inline">
				
					<INPUT TYPE = 'TEXT' Name ='op1' value="" maxlength="757" size= '25' class="form-control" placeholder="Option1">
				
			
					<INPUT TYPE = 'TEXT' Name ='op2' value="" maxlength="757" size= '25' class="form-control" placeholder="Option2">
				
			</div>	
			<br>
			<div class="form-inline">
				<INPUT TYPE = 'TEXT' Name ='op3' value="" maxlength="757" size= '25' class="form-control" placeholder="Option 3">
				<INPUT TYPE = 'TEXT' Name ='op4' value="" maxlength="757" size= '25' class="form-control" placeholder="Option 4">
			</div>
			</div>
			<br>
			<INPUT TYPE = 'TEXT' Name ='ans' value="" maxlength="757" size= '25' class="form-control" placeholder="Answer">
				<br> 
			<INPUT TYPE = "Submit" Name = "save"  VALUE = "SAVE AND CONTINUE"  class="btn">
			<INPUT TYPE = "Submit" Name = "back"  VALUE = "BACK"  class="btn">
			<INPUT TYPE = "Submit" Name = "done"  VALUE = "COMPLETE" class="btn">
		
	</div>

</FORM>

</body>
</html>