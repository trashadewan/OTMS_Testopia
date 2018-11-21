<html>
<head>
<title>Change password</title>
<?PHP
session_start();
$id = $_SESSION['id'];
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
<body bgcolor="Grey">
<FORM NAME ="form1" METHOD ="POST" ACTION ="">
Old password :    <INPUT TYPE = 'PASSWORD' Name ='opassword' value="" maxlength="16"><br>
new password:     <INPUT TYPE = 'PASSWORD' Name ='npassword' value="" maxlength="16"><br>
confirm password: <INPUT TYPE = 'PASSWORD' Name ='cpassword' value="" maxlength="16"><br>
<br>
<P align = center>
<INPUT TYPE = "Submit" Name = "Update1"  VALUE = "CHANGE">
</P>
</FORM>
</body>
</html>