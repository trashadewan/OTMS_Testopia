<!DOCTYPE html>
<html lang="en"> 
<head>
<?php

// Function to calculate square of value - mean
function sd_square($x, $mean) { return pow($x - $mean,2); }

// Function to calculate standard deviation (uses sd_square)    
function sd($array) {
    
// square root of sum of squares devided by N-1
return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
}

 ?>

<?PHP
session_start();
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) 
{
  header ("Location: Index.php");
}
else 
{
$id = $_SESSION['id'];
}
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
		<li><a href="regstud.php">Registered Students</a></li>
    <li class="active" ><a href="stats.php">Statistics</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $id;  ?> 
           <b class="caret"></b></a>
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
</head>
<body>
<?PHP

    $user_name = "root";
    $pass_word = "";
    $database = "otms";
    $server = "127.0.0.1";
    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db("otms", $db_handle);
    if ($db_found)
    {    
      $sql="SELECT * FROM course_incharge WHERE E_id='$id'";
      $result = mysql_query($sql) or die ("Query Failed:".mysql_error());    
      $flag=0;
      echo "<form name='f1' method='POST' action=''>";
      echo "<div class='container'>";
      echo '<div class="col-lg-4">';
      echo "Choose Course code to view Statistics of the class:";
      
      echo "<select name='subject' class=\"form-control\" >";
      if($result==TRUE)
      {
        while($db_feild=mysql_fetch_assoc($result))
          { 
            if ($flag==0)
            {
              $flag=1;
              echo "<option value=".$db_feild['C_id']." selected >". $db_feild['C_id']."</option>";
            }
            else
            { 
              echo "<option value=". $db_feild['C_id'].">". $db_feild['C_id'] ."</option>";
            }  
          }
      }
      else 
          print "Some error occured during SELECT"."<BR>";
      echo "</select>";
      echo "<br><input type=\"submit\" name=\"submit\" Value =\"Show \" class=\"btn\">";
      echo "</div>";
      echo "</div>";
      
      
      if(isset($_POST['submit']))
        {

            $var=$_POST['subject'];
            $regno=array();
            $mark=array();
            $user_name = "root";
            $pass_word = "";
            $database = "otms";
            $server = "127.0.0.1";
            $db_handle = mysql_connect($server, $user_name, $pass_word);
            $db_found = mysql_select_db("otms", $db_handle);
            if ($db_found)
            {    
              
              $SQL1 = "SELECT * FROM  `enrolled` WHERE C_id = '".$var." 'AND E_id ='".$id."';";
              $result1 = mysql_query($SQL1);
              $count=0.0;
              $mean=0.0;
              while($db_feild=mysql_fetch_assoc($result1))
              { 
                $a=substr($db_feild['S_id'], 5);
                $count++;
                array_push($regno,(int)$a);
                if( strcmp($db_feild['Attempt'], "Available") or strcmp($db_feild['Attempt'], "Not Available"))
                  {array_push($mark,(floatval($db_feild['Attempt'])));
                  
                  $mean=$mean+(floatval($db_feild['Attempt']));}
                else
                  array_push($mark,0);


              }
              $mean=$mean/$count;
              mysql_close($db_handle);
              $mean=round($mean,3);
              $sd1=round(sd($mark),3);
            }

          
          $_SESSION['subject']=$_POST['subject'];
          echo '<center>'.'Graph of '.$_POST['subject'].'<br><img src="retrievechartdata.php" name="myImage" padding-left ="100" width="700" height="200" />';


          echo '<br> Class mean ='.$mean.'<br> class Standard Deviation ='.$sd1.'</center>';

        }
          
    }


?>



</body>
</html>