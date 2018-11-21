
<?PHP
session_start();
if(isset($_SESSION['stid']))
{
unset($_SESSION);
session_destroy();
header('Location:../index.html');
}
?>
