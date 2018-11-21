<!DOCTYPE html>
<html lang="en"> 
<head>
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
<body>
    <form name="f1" method="post" enctype="multipart/form-data" role="form">
       Upload the CSV file for questions :<br>
	   	<div class="form-group">
    		<label for="exampleInputFile">File input</label>
    		<input type="file" id="exampleInputFile" name="file1">
    		<p class="help-block">Please upload file in CSV format</p>
  		</div>
	   <input type="submit" value="Upload" name="submit1" class="btn"/>  
    </form>
</body>
</html>	

<?PHP
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) 
{
	header ("Location: Index.php");
}
else 
{
	$id = $_SESSION['id'];
	$var = $_GET['course'];
	if(!isset($var))
	{
		header ("Location: quesformb.php");
	}
	if (isset($_POST['submit1'])) 
	{
		$id = $_SESSION['id'];
		if ($_FILES["file1"]["error"] > 0)
		  {
		  echo "Error: " . $_FILES["file1"]["error"] . "<br>";
		  }
		else
		  {
			if (1)
				{
					if (file_exists("\\OTMS\\upload\\" . $_FILES["file1"]["name"]))
					  {
					  echo $_FILES["file1"]["name"] . " already exists. ";
					  }
					else
					  {
						move_uploaded_file($_FILES["file1"]["tmp_name"],"C:\\Xampp\\htdocs\\OTMS\\upload\\" . $_FILES["file1"]["name"]);
						echo "The file " . $_FILES["file1"]["name"]. " is uploaded";
						$user_name = "root";
						$pass_word = "";
						$database = "OTMS";
						$server = "127.0.0.1";
						$db_handle = mysql_connect($server, $user_name, $pass_word);
						$db_found = mysql_select_db("OTMS", $db_handle);
						$A="C:\\Xampp\\htdocs\\OTMS\\upload\\".$_FILES["file1"]["name"];
							if ($db_found)
							{
								if($_POST['submit1'])
								{
									$emapData= array();
									$fo = fopen($A, "r"); // CSV fiile
									while (($emapData = fgetcsv($fo,"", ",")) !== FALSE)
									{
										$SQL1 = "INSERT into question values ('','$var' ,'$id','$emapData[0]' ,'$emapData[1]');";
										$result1 = mysql_query($SQL1);
										if($result1==TRUE)
										print "done inserttinon of question and answer";
										else 
										print "error in inserttinon of question and answe "."<BR>";
										
									   
									   
										$SQL2="SELECT * from question where question='$emapData[0]';";
										$result2 = mysql_query($SQL2) or die ("Query Failed:".mysql_error());
										if($result2==TRUE)
										print "done q-id selection";
										else 
										print "error in q_id selection"."<BR>";
										
										$db_feild=mysql_fetch_assoc($result2);
										$q_id= $db_feild['Q_id'];
										
										$op1=$emapData[2];
										$op2=$emapData[3];
										$op3=$emapData[4];
										$op4=$emapData[5];
										
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
										
									}
								}
							}
						}
				}
				else
				{	
					echo "Please input .csv file"."<br>"; 
				}
			}
	}	
}
?>




