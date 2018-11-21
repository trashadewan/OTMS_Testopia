
<?PHP
session_start();
if(isset($_SESSION['adid']))
{
unset($_SESSION);
session_destroy();
header('Location:../index.html');
}
?>
