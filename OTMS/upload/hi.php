
<html>
<head>

</head>

<body>
<?php
$dateFormat = "d F Y -- g:i a";
$targetDate = time() + (1*60);//Change the 25 to however many minutes you want to countdown
$actualDate = time();
$secondsDiff = $targetDate - $actualDate;
$remainingDay	 = floor($secondsDiff/60/60/24);
$remainingHour	= floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
$remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
$remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));
$dateFormat1 = "d F Y";
$actualDateDisplay = date($dateFormat1,$actualDate);
$targetDateDisplay = date($dateFormat1,$targetDate);
?>

<script type="text/javascript">
  var days = <?php echo $remainingDay; ?>  
  var hours = <?php echo $remainingHour; ?>  
  var minutes = <?php echo $remainingMinutes; ?>  
  var seconds = <?php echo $remainingSeconds; ?> 
function setCountDown ()
{
  seconds--;
  if (seconds < 0){
	  minutes--;
	  seconds = 59
  }
  if (minutes < 0){
	  hours--;
	  minutes = 59
  }
  if (hours < 0){
	  days--;
	  hours = 23
  }
  document.getElementById("remain").innerHTML =minutes+" minutes, "+seconds+" seconds";
  SD=window.setTimeout( "setCountDown()", 1000 );
  if (minutes == '00' && seconds == '00') { seconds = "00"; window.clearTimeout(SD);
   		//window.alert("Time is up. Press OK to continue."); // change timeout message as required
		  window.location = "result.php" // Add your redirect url
 	} 

}

</script>
</head>
<body onload="setCountDown();">

 Date: <?php echo $actualDateDisplay; ?><br />
 
 <div id="remain"><?php echo "$remainingMinutes minutes, $remainingSeconds seconds";?></div>

   
</body>
</html>
								else if($_POST['submit1']
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



