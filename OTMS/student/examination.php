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
		}
		?>
		<title>Examination</title>
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
		<script src="../countdown_v4.3/countdown.js" type="text/javascript"></script>

</head>
<body>
<?php
$var = $_GET['test'];
print $var;
$user_name = "root";
$pass_word = "";
$database = "otms";
$server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db("otms", $db_handle);
 if ($db_found)
	{    
		$SQL1= "Select No_ques from course_incharge where C_id='$var' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
		$result1 = mysql_query($SQL1);
        /*if($result1==TRUE)
		print "done result1";
		else
		print "result1 error";*/
		
		$db_feild=mysql_fetch_assoc($result1);
		$noofques= $db_feild['No_ques'];
		
		$SQL2="select count(*) from question where C_id='$var' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
		$result2 = mysql_query($SQL2);
		/*
        if($result2==TRUE)
		print "done result2";
		else
		print "result2 error";*/
		
		$db_feild=mysql_fetch_assoc($result2);
		$totalnum= $db_feild['count(*)'];
		$num= $totalnum - $noofques;
		
		$SQL3= "Select setted from course_incharge where C_id='$var' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
		$result3 = mysql_query($SQL3);
		$db_feild=mysql_fetch_assoc($result3);
		$str= $db_feild['setted'];
		//echo "*".$str."*";
		$a=strcmp($str,'Complete');

		
		$SQL3= "Select Attempt from enrolled where C_id='$var' AND S_id ='$id' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
		$result4 = mysql_query($SQL3);
		$db_feild=mysql_fetch_assoc($result4);
		$str= $db_feild['Attempt'];
		$b=is_numeric($str);
	
		if(/*$num >$noofques ||*/ $a != 0 )
		{
		    print "Test Not Yet UP !";
		}
		else if ($b != false )
		{
			print "Already given" ;
			$SQL3=" select Attempt from enrolled where C_id='$var'AND S_id= '$id' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
			$result3 = mysql_query($SQL3);
			$db_feild=mysql_fetch_assoc($result3);
			$per= $db_feild['Attempt'];
			print "Obatained Percentage is ".$per; 
		}
		else
		{
		
		
		$input=array();
		$rand_keys =array();
		$SQL3=" select Q_id from question where C_id='$var' AND E_id= (Select E_id from enrolled where S_id= '$id' and C_id='$var');";
		//print $SQL3;
		$result3 = mysql_query($SQL3);
			if ($result3 == TRUE )
			{
		    print "All possible questions";
			}
		
		
			while($db_feild=mysql_fetch_assoc($result3))
			{	//print $db_feild['Q_id'];
				//echo "</br>";
			    $input[]= $db_feild['Q_id'];
				//print $input[$i];
			}
		
		$count = $noofques;
		?>
		<script type="application/javascript">
function doneHandler(result)
{
	//alert("hi");
	document.form.submit();
}

var myCountdown2 = new Countdown({
									time: <?php echo $count*60 ?>,
									width:150, 
									height:80, 
									rangeHi:"minute",
									onComplete : doneHandler	// <- no comma on last item!
									});

</script>
		<?php
		//print_r ($input);
		//echo $count;
		$rand_keys = array_rand($input, $count);
		$_SESSION['selectques']=$rand_keys;
		$_SESSION['var']=$var;
		$_SESSION['count']=$count;
		echo '<br>';
		echo "<FORM NAME =\"form\" METHOD =\"POST\" ACTION =\"result.php\">";
			for($i=0;$i<$count;$i++)
			{
				$j=97;
				$x=$input[$rand_keys[$i]];
				$SQL4=" select * from question where Q_id='$x';";
				$result4 = mysql_query($SQL4);
				echo $i+1;
				echo ')';
				$db_feild=mysql_fetch_assoc($result4);
				echo $db_feild['Question'];
				echo '<br>';
				
				$SQL5=" select * from options where Q_no='$x';";
				
				$result5= mysql_query($SQL5);
				while($db_feild1=mysql_fetch_assoc($result5))
				{	
					$op=$db_feild1['Options'];
					echo '<br>';
					echo chr($j);
					echo ')';
					$r=$rand_keys[$i];
					echo "<input type=\"radio\" name='$r' value='$op' >";
					echo $op;
					echo '<br>';
					$j++;
				}
			echo '---------------------------------------------------------------------------------------------------------------------------------------<br>';
			}
		echo "<INPUT TYPE = \"Submit\" Name = \"answer\"  VALUE = \"Submit Your answers\" class=\"btn\">"; 
		echo "</form>";
		echo "</body>";
		}
	}
	
	mysql_close($db_handle);

?>
</body>
</html>