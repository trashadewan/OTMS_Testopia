
<?php
 
 session_start();
if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) 
{
	header ("Location: Index.php");
}
else 
{

		$id = $_SESSION['id'];
		$var = $_SESSION['subject'];
		//$var='CSE101';
		if(!isset($var))
		{
			header ("Location:stats.php");
		}
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
		
			while($db_feild=mysql_fetch_assoc($result1))
			{	
				$a=substr($db_feild['S_id'], 5);
				
				array_push($regno,(int)$a);
				if( strcmp($db_feild['Attempt'], "Available") or strcmp($db_feild['Attempt'], "Not Available"))
					{array_push($mark,(floatval($db_feild['Attempt'])));
					
					}
				else
					array_push($mark,0);


			}
			$mean=$mean/$count;
			mysql_close($db_handle);
			$_SESSION['regno']=$regno;
			$_SESSION['mark']=$mark;


		}
		 header('location:chart.php');
		
  
 }
?>  

	   

